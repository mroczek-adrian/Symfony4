<?php

namespace App\Controller;

use App\Entity\GodzinyPracyUczelni;
use App\Entity\Zajecia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StartUseraController extends AbstractController
{
    /**
     * @Route("/start/usera", name="start_usera")
     */

    public function index()
    {
        $zajecia= $this->getDoctrine()->getRepository(Zajecia::class)->findAll();
        $godziny_pracy_uczelni= $this->getDoctrine()->getRepository(GodzinyPracyUczelni::class)->findAll();
        return $this->render('start_usera/index.html.twig',[
                'zajecia' => $zajecia,
                'godziny_pracy_uczelni' => $godziny_pracy_uczelni,
            ]);

    }




}
