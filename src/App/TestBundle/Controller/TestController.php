<?php

namespace App\TestBundle\Controller;

use App\TestBundle\Entity\Attempt;
use App\TestBundle\Entity\Test;
use App\TestBundle\TestBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Symfony\Component\Validator\Constraints\Collection;

class TestController extends Controller
{
    /**
     * @Route("/{page}", name="_listTests", methods={"GET"}, requirements={"page"="\d+"}, defaults={"page"=1})
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT t FROM TestBundle:Test t');
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query,
            $page,
            10
        );

        return $this->render('TestBundle:ListTests:index.html.twig',array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/test/{id}", name="_showTest", methods={"GET"}, requirements={"id"="\d+"})
     * @param Test $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testAction(Test $id)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('TestBundle:Test')->find($id);

        if(!$test)
            throw $this->createNotFoundException('Test not found');

        return $this->render('TestBundle:Test:show.html.twig', array(
            'test' => $test,
            'types' => TestBundle::$questionType
        ));
    }

    /**
     * @Route("/test/{id}/result", name="_resultTest", methods={"POST"}, requirements={"id"="\d+"})
     * @param Test $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultTestAction(Test $id, Request $request)
    {
        $session = $request->getSession();
        $session->start();
        $token = $request->request->get('csrf_token');

        if (!$this->isCsrfTokenValid('attempt_csrf', $token)) {
            $session->getFlashBag()->add('error', 'CSRF-token is not valid');
            return $this->redirectToRoute('_showTest', array('id' => $id->getId()));
        }

        $session->remove('_csrf/attempt_csrf');
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('TestBundle:Test')->find($id);

        if (!$test) {
            $session->getFlashBag()->add('error', 'Test not available');
            return $this->redirectToRoute('_listTests');
        }

        $input = $request->get('question');
        if(!$input) {
            $session->getFlashBag()->add('error', 'Not all fields are filled in correctly');
            return $this->redirectToRoute('_showTest', array('id' => $id->getId()));
        }

        $questions = $test->getQuestions();
        $countAnswers = 0;
        $countCorrectAnswers = 0;
        $result = array(
            'selected' => array(),
            'correct' => array(),
            'texts' => array()
        );

        try {
            foreach ($questions as $question) {
                $idQuestion = $question->getId();
                $answers = $question->getAnswers();

                if ($question->getType() == TestBundle::$questionType['text']) {
                    $answer = $answers[0];
                    $countAnswers++;
                    array_push($result['selected'], $answer->getId());

                    if (trim(mb_strtolower($input[$idQuestion][0]), 'utf-8') === trim(mb_strtolower($answer->getText()), 'utf-8')) {
                        array_push($result['correct'], $answer->getId());
                        array_push($result['texts'], array(
                            'answer' => $answer->getId(),
                            'text' => $answer->getText()
                        ));
                        $countCorrectAnswers++;
                    } else {
                        array_push($result['texts'], array(
                            'answer' => $answer->getId(),
                            'text' => $input[$idQuestion][0] . ' (correct: ' . $answer->getText() . ')'
                        ));
                    }
                } else {
                    foreach ($answers as $answer) {
                        if (in_array($answer->getId(), $input[$idQuestion])) {
                            array_push($result['selected'], $answer->getId());

                            if (!$answer->getCorrect())
                                $countCorrectAnswers--;
                        }

                        if ($answer->getCorrect()) {
                            array_push($result['correct'], $answer->getId());
                            $countAnswers++;
                        }

                        if (in_array($answer->getId(), $input[$idQuestion]) && $answer->getCorrect())
                            $countCorrectAnswers++;
                    }
                }
            }
        }catch (\Exception $ex){
            $session->getFlashBag()->add('error', 'Item not found');
            return $this->redirectToRoute('_showTest', array('id' => $id->getId()));
        }

        $attempt = new Attempt();
        $attempt->setCorrect($countCorrectAnswers < 1 ? 0 : $countCorrectAnswers );
        $attempt->setTotal($countAnswers);
        $attempt->setTestname($test->getName());
        if ($this->getUser())
            $attempt->setUser($this->getUser());

        $em->persist($attempt);
        $em->flush();

        return $this->render('TestBundle:Test:result.html.twig', array(
            'test' => $test,
            'types' => TestBundle::$questionType,
            'result' => $result
        ));
    }
}