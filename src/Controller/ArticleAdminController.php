<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Zajecia;
use App\Form\ArticleFormType;
use App\Entity\WynikAlgUczelnie;
use App\Form\ZajeciaFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article/admin", name="article_admin")
     */
    public function index(EntityManagerInterface $em,Request $request)
    {
       $form = $this->createForm(ArticleFormType::class);

       $form -> handleRequest($request);

       if($form->isSubmitted() && $form->isValid()) {
           //  dd($form ->getData());
           $data = $form->getData();
           $article = new Article();


//           $data = $form->getData();
//           $article = $form->getData();
           $article->setTitle($data['title']);
           $article->setContent($data['content']);

           $em->persist($article);
           //wyslanie
           $em->flush();

           return $this->redirectToRoute('dodanie_do_bazy');
       }
           /////////////
           ///inny form

           $form1 = $this->createForm(ZajeciaFormType::class);

           $form1 -> handleRequest($request);

           if($form1->isSubmitted() && $form1->isValid()) {
               //  dd($form ->getData());
               $data = $form1->getData();
               $zajecia = new Zajecia();


//           $data = $form->getData();
//           $article = $form->getData();
               $zajecia->setNazwa($data['nazwa']);
               $zajecia->setOkres($data['okres']);

               $em->persist($zajecia);

                //wyslanie
               $em->flush();

               return $this->redirectToRoute('dodanie_do_bazy');
           }


        return $this->render('article_admin/index.html.twig', [
            'articleForm' => $form->createView(),
            'zajeciaForm' => $form1->createView(),
        ]);
    }
}
