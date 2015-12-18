<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\User;


class UserController extends Controller
{
    /**
     * @Route("/user/", name="createUser")
     * @Method("POST")
     */
    public function indexCreateUser(Request $request)
    {
        $content = $request->getContent();
        $response = json_decode($content, true);

        if (isset($response['username'])) {

            return new JsonResponse([
                'status' => 1,
                'user' => [
                    'id' => 1,
                    'username' => $response['username'],
                    'password' => $response['password']
                ]
            ]);
        } else {
            return new JsonResponse([
                'status' => 1,
                'user' => [
                    'id' => 1,
                    'username' => 'John',
                    'password' => 'Doe'
                ]
            ]);
        }
    }
}
