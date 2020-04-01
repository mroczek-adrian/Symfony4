<?php

namespace App\Controller;

use App\Entity\Uczelnie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index()
    {
        $uczelnie= $this->getDoctrine()->getRepository(Uczelnie::class)->findAll();
        return $this->render('welcome/index.html.twig', array('uczelnie' => $uczelnie));
    }


}
