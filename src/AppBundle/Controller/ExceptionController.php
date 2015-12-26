<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController as EController;
use Symfony\Component\Debug\DebugClassLoader;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends Controller
{
    /**
     * @param Request              $request   The request
     * @param FlattenException     $exception A FlattenException instance
     * @param DebugLoggerInterface $logger    A DebugLoggerInterface instance
     *
     * @return Response
     */
    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null)
    {
        $status = $exception->getStatusCode();
        $message = $exception->getMessage();
        $previousUrl = $request->headers->get('referer');

        if ($request->getFormat($request->getAcceptableContentTypes()[0]) == 'json') {
            return new JsonResponse([
                'status' => $status,
                'message' => $message
            ]);
        } else {
            return $this->render('exception/404.html.twig', [
                'status' => $status,
                'message' => $message,
                'previousUrl' => $previousUrl
            ]);
        }
    }
}
