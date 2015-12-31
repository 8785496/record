<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax/sendemail")
     * @Method("POST")
     */
    public function sendEmailAction(Request $request)
    {
        $data = $request->request->get('form');
        $email = new Email();
        $email->setName($data['name']);
        $email->setEmail($data['email']);
        $email->setPhone($data['phone']);
        $email->setMessage($data['message']);

        $validator = $this->get('validator');
        $_errors = $validator->validate($email);

        foreach ($_errors as $_error) {
            $errors[$_error->getPropertyPath()] = $_error->getMessage();
        }

        if (count($_errors) > 0) {
            return new JsonResponse([
                'code' => 0,
                'errors' => $errors
            ]);
        } else {
            $message = \Swift_Message::newInstance()
                ->setSubject('Letter from site')
                ->setFrom($email->getEmail())
                ->setTo('german.chernyshov@gmail.com')
                ->setBody($email->getMessage() . "\ntel." . $email->getPhone());
            $this->get('mailer')->send($message);
            return new JsonResponse([
                'code' => 1,
                'data' => $data
            ]);
        }
    }
}
