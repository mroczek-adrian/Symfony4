<?php

namespace App\Controller;
use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Entity\WynikAlgUczelnie;
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

       if($form->isSubmitted() && $form->isValid()){
         //  dd($form ->getData());
           $data = $form->getData();
           $article = new Article();


//           $data = $form->getData();
//           $article = $form->getData();
           $article->setTitle($data['title']);
           $article->setContent($data['content']);

           $em->persist($article);
           $em->flush();

           return $this->redirectToRoute('hello_page');
       }
        return $this->render('article_admin/index.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
}
