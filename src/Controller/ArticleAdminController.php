<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\GodzinyPracyUczelni;
use App\Entity\Teachers;
use App\Entity\Zajecia;
use App\Form\ArticleFormType;
use App\Form\GodzinyPracyUczelniFormType;
use App\Entity\WynikAlgUczelnie;
use App\Form\TeachersFormType;
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
//1 form
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

       //koniec forma 1
           /////////////
           ///inny form




        $form2 = $this->createForm(GodzinyPracyUczelniFormType::class);

        $form2 -> handleRequest($request);
        ///
        ///
        //2 form
        if($form2->isSubmitted() && $form2->isValid()) {
            //  dd($form ->getData());
            $data = $form2->getData();
            $gpu = new GodzinyPracyUczelni();


//           $data = $form->getData();
//           $article = $form->getData();
            $gpu->setDzien($data['dzien']);
            $gpu->setGodziny($data['godziny']);
             $em->persist($gpu);
            //wyslanie
            $em->flush();

            return $this->redirectToRoute('dodanie_do_bazy');
        }

        //koniec forma 2
        /////////////
        ///inny form
        ///
        ///
        ///

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



//start form3

        $form3 = $this->createForm(TeachersFormType::class);
        $form3 -> handleRequest($request);
        if($form3->isSubmitted() && $form3->isValid()) {
            //  dd($form ->getData());
            $data = $form3->getData();
            $teacher = new Teachers();


//           $data = $form->getData();
//           $article = $form->getData();

            $teacher->setName($data['name']);
            $teacher->setSurname($data['surname']);
            $teacher->setSubject($data['subject']);
            $teacher->setDay1($data['day1']);
            $teacher->setDay2($data['day2']);
            $teacher->setDay3($data['day3']);

            $em->persist($teacher);
            //wyslanie
            $em->flush();

            return $this->redirectToRoute('dodanie_do_bazy');
        }

        //koniec forma 1
        /////////////
        ///inny form





        //pobieram dane
        $allZajecia= $this->getDoctrine()->getRepository(Zajecia::class)->findAll();
        $allDniUczelni= $this->getDoctrine()->getRepository(GodzinyPracyUczelni::class)->findAll();
        $allTeachers= $this->getDoctrine()->getRepository(Teachers::class)->findAll();
        return $this->render('article_admin/index.html.twig', [
            'articleForm' => $form->createView(),
            'zajeciaForm' => $form1->createView(),
            'gpuForm' => $form2->createView(),
            'teachersForm' =>$form3->createView(),
            'allZajecia' => $allZajecia,
            'allDniUczelni' =>$allDniUczelni,
            'allTeachers' => $allTeachers,
        ]);
    }


    /**
     * @Route("/article/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Zajecia::class)->find($id);
      //  $post = $em->getRepository('Zajecia')->find($id);

        if (!$post) {
            return $this->redirectToRoute('article_admin');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('article_admin');
    }

    /**
     * @Route("/article/delete/dni/uczelni/{id}", name="delete_uczelnie")
     */
    public function delete_uczelnieAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(GodzinyPracyUczelni::class)->find($id);
        //  $post = $em->getRepository('Zajecia')->find($id);

        if (!$post) {
            return $this->redirectToRoute('article_admin');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('article_admin');
    }

    /**
     * @Route("/article/delete/teachers/{id}", name="delete_teachers")
     */
    public function delete_teachersAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Teachers::class)->find($id);
        //  $post = $em->getRepository('Zajecia')->find($id);

        if (!$post) {
            return $this->redirectToRoute('article_admin');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('article_admin');
    }
}
