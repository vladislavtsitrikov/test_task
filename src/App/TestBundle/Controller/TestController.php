<?php

namespace App\TestBundle\Controller;

use App\TestBundle\Entity\Test;
use App\TestBundle\TestBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    /**
     * @Route("/{page}", name="_listTests", methods={"GET"}, requirements={"page"="\d+"}, defaults={"page"=1})
     * @param Request $request
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $page)
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
        $em = $this->getDoctrine()->getManager();

        $test = $em->getRepository('TestBundle:Test')->find($id);
        if(!$test)
            throw $this->createNotFoundException('Test not found');

        $questions = $test->getQuestions();



        return $this->render('TestBundle:Test:result.html.twig', array(
            'test' => $test
        ));
    }
}