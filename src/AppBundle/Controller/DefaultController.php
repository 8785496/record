<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        //$request->get

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/balda", name="balda")
     */
    public function baldaAction(Request $request)
    {
        return new Response('Balda');
    }
}
