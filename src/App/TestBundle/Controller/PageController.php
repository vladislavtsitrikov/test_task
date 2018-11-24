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
}
