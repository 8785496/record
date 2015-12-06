<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Record;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="get")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $content = $request->getContent();
        //var_dump($content);
        return new JsonResponse([
            'hellp' => 'world!'
        ]);
    }
    
    /**
     * @Route("/", name="create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $content = $request->getContent();
        $response = json_decode($content, true);
        $record = new Record();
        $record->setScore($response['score']);
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($record);
        $em->flush();

        return new JsonResponse([
            'id' => $record->getId(),
            'score' => $record->getScore()
        ]);
    }
}
