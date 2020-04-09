<?php

namespace App\Controller;

//2 klasy do algorytmu z ktorych bede pobieral dane
use App\Entity\GodzinyPracyUczelni;
use App\Entity\Zajecia;
////////////////////
use App\Entity\WynikAlgUczelnie;
use App\Entity\KtoryAlgZastosowac;
use App\Form\KtoryAlgZastosowacType;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class KtoryAlgZastosowacController extends AbstractController
{
    /**
     * @Route("/ktory/alg/zastosowac", name="ktory_alg_zastosowac")
     */
    public function index(EntityManagerInterface $em,Request $request)
    {
        //pobieram dane po zaladowaniu algorytmu we wczesniejsze akcji
        $wynikiAlgorytmuUczelnie= $this->getDoctrine()->getRepository(WynikAlgUczelnie::class)->findAll();







        //tworze formularz
        $form = $this->createForm(KtoryAlgZastosowacType::class);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // ew uzyc dump
            //  dd($form ->getData());

            //pobieram dane z formularza
            $data = $form->getData();


            //jesli prawda jest ze chce uzyc algorytmu uczelni
          if($data['Which_algorythm_should_i_use'])
          {
              //akcja

              //proba usuniecia wszystkich danych z
              $zajecia= $this->getDoctrine()->getRepository(WynikAlgUczelnie::class)->findAll();
              foreach ($zajecia as $zajecie) {
                  $em->remove($zajecie);
              }
              //usuwam
              $em->flush();



              //pobieram dane z klas
              $zajecia= $this->getDoctrine()->getRepository(Zajecia::class)->findAll();
              $godziny_pracy_uczelni= $this->getDoctrine()->getRepository(GodzinyPracyUczelni::class)->findAll();


              //tablica pamieta ile godzin zostalo dancych dni
              $myArray =[];
              //przechowuje wyniki
              $rozwiazania= array();
              foreach ($godziny_pracy_uczelni as $gpu)
              {
                  //zapamietuje dzien tygodnia
                  $dzien=$gpu->getDzien();



                  //pobiera ilosc godzin danego dnia -> mozna modyfikowac
                  $godz1dnia=$gpu->getGodziny();

                  foreach ($zajecia as $zaj)
                  {



                      //if($godz1dnia>=$zaj->getOkres() && ($godz1dnia-$zaj->getOkres())>=0   )
                      //jesli godziny z dnia uczelni maja miejsce na zajecia .

                      if($godz1dnia>=$zaj->getOkres() )
                      {


                          foreach($rozwiazania as $rozwiazanie){

                              if ($rozwiazanie[1]==$zaj->getNazwa())
                              {

                                  goto a;
                              }
                            }
                          //miesci sie i chce zapamietac to aby potem wyslac do bazy wynik
                          $rozwiazania[]=array($dzien,$zaj->getNazwa());


                          $godz1dnia=$godz1dnia-$zaj->getOkres();


                      }else{
                          //zmienna pamieta ile godzin zostalo ostatniego dnia
                          $myArray[  ] = $godz1dnia;
                          a:

                      }
                  }
              }
              //musi ustawiac to kilka razy jesli zajcdzie potrzeba np 3 zajecia w 1 dzien
              //przyklad///  $nazwa_algorytmu->setNazwaAlgorytmu($data['nazwa_algorytmu']);
              foreach($rozwiazania as $rozwiazanie){
                  $wynik_algorytmu_uczelnie = new  WynikAlgUczelnie();
                  $wynik_algorytmu_uczelnie->setNumerDnia($rozwiazanie[0]);
                  $wynik_algorytmu_uczelnie->setNazwaZajec($rozwiazanie[1]);
                  $em->persist($wynik_algorytmu_uczelnie);
              }
              //laduje do bazy wynik
              //pomysl jak wladowac kilka rekordow kilka persist
              $em->flush();
              return $this->redirectToRoute('algorytm');
          }else{
              //proba usuniecia wszystkich danych z aby nic nie wyswietlilo z wyn alg ucz  po ostatnim dodaniu
              $zajecia= $this->getDoctrine()->getRepository(WynikAlgUczelnie::class)->findAll();
              foreach ($zajecia as $zajecie) {
                  $em->remove($zajecie);
              }
              //usuwam
              $em->flush();
          }

        }
        return $this->render('ktory_alg_zastosowac/index.html.twig', [
            'algForm' => $form->createView(),
            'wynikiAlgorytmuUczelnie' => $wynikiAlgorytmuUczelnie,
        ]);
    }












}
