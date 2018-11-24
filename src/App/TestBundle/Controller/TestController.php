<?php

namespace App\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    /**
     * @Route("/{page}", name="_listTests", methods={"GET"}, requirements={"page"="\d+"}, defaults={"page"=1})
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
}