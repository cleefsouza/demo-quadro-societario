<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/")
     * @param Request $req
     * @return Response
     */
    public function index(Request $req): Response
    {
        return new JsonResponse(
            [
                "api" => "quadro-societario-api",
                "versao" => "0.1",
                "descicao" => "API Rest para cadastro de empresas e seu quadro de sócios de uma forma simples e prática.",
                "autor" => "Aryosvalldo Cleef de Souza",
                "repositorio" => "https://gitlab.com/cleefsouza/app-quadro-societario",
                "metodo" => $req->getMethod(),
                "url" => $req->getUri(),
                "content" => $req->getContentType()
            ]
        );
    }
}