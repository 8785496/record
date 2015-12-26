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
     * @Route("/user", name="createUser")
     * @Method("POST")
     */
    public function createUserAction(Request $request)
    {
        $content = $request->getContent();
        $response = json_decode($content, true);
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $repository->findOneByUsername($response['username']);
        if (!$user) {
            $user = new User();
            $user->setUsername($response['username']);
            $user->setPassword($response['password']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new JsonResponse([
                'code' => 1,
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword()
                ]
            ]);
        } else {
            return new JsonResponse([
                'code' => 0,
                'message' => 'User exists'
            ]);
        }
    }

    /**
     * @Route("/user/anonymous", name="createUserAnonymous")
     * @Method("POST")
     */
    public function createUserAnonymous()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $count = $repository->count();
        $username = 'Player' . dechex($count);
        $password = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse([
            'code' => 1,
            'user' => [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'password' => $user->getPassword()
            ]
        ]);
    }
}
