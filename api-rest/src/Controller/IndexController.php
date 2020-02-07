<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller {

    /**
     * @Route("/")
     */
    public function index(){
        echo 'Olá Index!';
        exit(); // Finalizando execução
    }
}