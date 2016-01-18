<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Record;
use AppBundle\Entity\User;

class RecordController extends Controller
{
    /**
     * @Route("/record", name="getRecords")
     * @Method("GET")
     */
    public function getRecordsAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Record');
        $records = $repository->getFirst10();

        return new JsonResponse($records);
    }

    /**
     * @Route("/record/{userName}", name="getMyRecords")
     * @Method("GET")
     */
    public function getMyRecordsAction($userName)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Record');
        $records = $repository->getMyFirst10($userName);

        return new JsonResponse($records);
    }

    /**
     * @Route("/record", name="createRecord")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $content = $request->getContent();
        $response = json_decode($content, true);
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $repository->findOneByUsername($response['user']['username']);

        //if ($user != null && $user->getPassword() == $response['user']['password']) {
        if ($user != null && $user->verifyPassword($response['user']['password'])) {

            // если у юзера сохранен рекорд >= score
            $repRecord = $this->getDoctrine()->getRepository('AppBundle:Record');
            //dump($repRecord);
            $maxScore = $repRecord->getMaxRecord($user->getId());
            dump($maxScore);
            if ($maxScore >= $response['score']) {
                return new JsonResponse([
                    'code' => 2,
                    'message' => 'score less max score',
                    'score' => $maxScore
                ]);
            }

            $record = new Record();
            $record->setScore($response['score']);
            $record->setUserId($user->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($record);
            $em->flush();
            return new JsonResponse([
                'code' => 1,
                'record' => [
                    'id' => $record->getId(),
                    'score' => $record->getScore(),
                    'userId' => $record->getUserId()
                ]
            ]);
        } else {
            return new JsonResponse([
                'code' => 0,
                'message' => 'user not valid'
            ]);
        }
    }

    /**
     * @Route("/record/anonymous", name="createRecordAnonymously")
     * @Method("POST")
     */
    public function createAnonymouslyAction(Request $request)
    {
        // user anonymous
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $count = $repository->count();
        $username = 'Player' . dechex($count);
        $password = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));
        $user = new User();
        $user->setUsername($username);
        $user->setPassword(md5($password));
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // record
        $content = $request->getContent();
        $response = json_decode($content, true);
        if ($user != null) {
            $record = new Record();
            $record->setScore($response['score']);
            $record->setUserId($user->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($record);
            $em->flush();
            return new JsonResponse([
                'code' => 1,
                'record' => [
                    'id' => $record->getId(),
                    'score' => $record->getScore(),
                    'userId' => $record->getUserId()
                ],
                'user' => [
                    'username' => $user->getUsername(),
                    'password' => $password
                ]
            ]);
        } else {
            return new JsonResponse([
                'code' => 0,
                'message' => 'record not save'
            ]);
        }
    }
}
