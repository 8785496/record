<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $email = new Email();

        $form = $this->createFormBuilder($email)
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class, ['required' => false])
            ->add('message', TextareaType::class)
            //->add('send', SubmitType::class, ['label' => 'Send Message'])
            ->getForm();

        return $this->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/balda", name="balda")
     */
    public function baldaAction(Request $request)
    {
        return new Response('Balda');
    }
}
