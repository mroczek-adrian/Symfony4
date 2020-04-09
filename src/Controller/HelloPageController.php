<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloPageController extends AbstractController
{

    public function index()
    {
        return $this->render('hello_page.html.twig', [
            'controller_name' => 'HelloPageController',
        ]);
    }
}
