<?php

namespace App\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends Controller
{
    /**
     * @Route("/main", name="_mainDefaultPage", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('TestBundle:Page:index.html.twig');
    }

    /**
     * @Route("/info", name="_infoPage", methods={"GET"})
     */
    public function infoAction()
    {
        return $this->render('TestBundle:Page:info.html.twig');
    }

    /**
     * @Route("/pass/{page}", name="_results", methods={"GET"}, requirements={"page"="\d+"}, defaults={"page"=1})
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function attemptsAction($page)
    {
        if(!$this->getUser())
            throw $this->createNotFoundException('Not loginned');

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('a')
            ->from('TestBundle:Attempt', 'a')
            ->where('a.user = :user_id')
            ->setParameter('user_id', $this->getUser()->getId())
            ->getQuery();

        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query,
            $page,
            10
        );

        return $this->render('TestBundle:Page:results.html.twig',array(
            'pagination' => $pagination
        ));
    }
}
