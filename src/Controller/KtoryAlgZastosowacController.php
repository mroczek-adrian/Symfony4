<?php

namespace App\Controller;

//2 klasy do algorytmu z ktorych bede pobieral dane
use App\Entity\GodzinyPracyUczelni;
use App\Entity\Teachers;
use App\Entity\Zajecia;
////////////////////
use App\Entity\WynikAlgUczelnie;
use App\Entity\KtoryAlgZastosowac;
use App\Form\KtoryAlgZastosowacType;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class KtoryAlgZastosowacController extends AbstractController
{
    /**
     * @Route("/ktory/alg/zastosowac", name="ktory_alg_zastosowac")
     */

    /**
     * @var Integer $flaga
     * @var Integer $ilosc_niezapisanych
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(EntityManagerInterface $em, Request $request,&$flaga=0,&$ilosc_niezapisanych=0)
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
          if($data['Do_you_want_to_use_algorithm'])
          {
              //akcja

              //proba usuniecia wszystkich danych z
              $zajecia= $this->getDoctrine()->getRepository(WynikAlgUczelnie::class)->findAll();
              foreach ($zajecia as $zajecie) {
                  $em->remove($zajecie);
              }
              //usuwam
              $em->flush();

              //pobranie danych nauczycieli
              $nauczyciele= $this->getDoctrine()->getRepository(Teachers::class)->findAll();

              //SORTOWANIE
              //po pobraniu chce postortowac rosnaco zajecia i godziny uczelni aby wzrosla efektywnosc alg
              //tzn kiedy idzie po kolei to dodaje zajecia 1h do blokow 8h w szkole a zostawia ptem blok 1h pusty....
              //select sort - przez wybor

                //pobieram dane z klas
              $zajecia= $this->getDoctrine()->getRepository(Zajecia::class)->findAll();

              //ilosc elementow w tabeli
              $n=0;
              foreach ($zajecia as $zaj){
                  $n=$n+1;
              }

              //tworze tablice z danymi nieposortowanymi ktore potem beda posortowane
              foreach ($zajecia as $zaj){
                  $nieposortowane_zajecia[]=array($zaj->getOkres(),$zaj->getNazwa());
              }
              // ALGORYTM sortowania zajec przez wybor-selection sort
                //pamietajmy, ze indeks w tabeli rozpoczyna sie od 0 a konczy na n-1 
              for($i=0;$i<$n;$i++){//petla glowna
                  $min=$i;
                  for($j=$i;$j<$n;$j++){//petla wewnetrzna
                      if($nieposortowane_zajecia[$j][0]<$nieposortowane_zajecia[$min][0]) $min=$j;//szukanie wartosci min.
                  }
                //po wykonaniu petli wewnetrznej nastepuje zamiana elementow:
                  $tmp=$nieposortowane_zajecia[$i][0];
                  $tmp1=$nieposortowane_zajecia[$i][1];
                  $nieposortowane_zajecia[$i][0]=$nieposortowane_zajecia[$min][0];
                  $nieposortowane_zajecia[$i][1]=$nieposortowane_zajecia[$min][1];
                  $nieposortowane_zajecia[$min][0]=$tmp;
                  $nieposortowane_zajecia[$min][1]=$tmp1;
              }

              //deklaracje do ALGORYTM SORTOWANIA- po godzinach uczelni
              $godziny_pracy_uczelni= $this->getDoctrine()->getRepository(GodzinyPracyUczelni::class)->findAll();

              //ilosc elementow w tabeli
              $n=0;
              foreach ($godziny_pracy_uczelni as $god){
                  $n=$n+1;
              }

              //tworze tablice z danymi nieposortowanymi
              foreach ($godziny_pracy_uczelni as $god){
                  $nieposortowane_godzinypracyucz[]=array($god->getGodziny(),$god->getDzien());
              }
              // ALGORYTM sortowania
              //pamietajmy, ze indeks w tabeli rozpoczyna sie od 0
              //a konczy na n-1
              for($i=0;$i<$n;$i++){//petla glowna
                  $min=$i;
                  for($j=$i;$j<$n;$j++){//petla wewnetrzna
                      if($nieposortowane_godzinypracyucz[$j][0]<$nieposortowane_godzinypracyucz[$min][0]) $min=$j;//szukanie wartosci min.
                  }

                  //po wykonaniu petli wewnetrznej nastepuje zamiana:
                  $tmp=$nieposortowane_godzinypracyucz[$i][0];
                  $tmp1=$nieposortowane_godzinypracyucz[$i][1];
                  $nieposortowane_godzinypracyucz[$i][0]=$nieposortowane_godzinypracyucz[$min][0];
                  $nieposortowane_godzinypracyucz[$i][1]=$nieposortowane_godzinypracyucz[$min][1];
                  $nieposortowane_godzinypracyucz[$min][0]=$tmp;
                  $nieposortowane_godzinypracyucz[$min][1]=$tmp1;
              }

              //ZACZYNAMY GLOWNE PRZYPISANIA DO WYNIKOW
              //tablica pamieta ile godzin zostalo dancych dni
              $myArray =[];
              //przechowuje wyniki
              $rozwiazania= array();

              //rozdzielam kazdy dzien na godziny  dysponujac posortowanymi_godzinami
              foreach ($nieposortowane_godzinypracyucz as $gpu)
              {
                  //zapamietuje dzien tygodnia
                  $dzien=$gpu[1];
                  //pobiera ilosc godzin danego dnia -> mozna modyfikowac
                  $godz1dnia=$gpu[0];
                  //pobieram 1 z zajec
                  foreach ($nieposortowane_zajecia as $zaj)
                  {
                      //if($godz1dnia>=$zaj->getOkres() && ($godz1dnia-$zaj->getOkres())>=0   )
                      //jesli godziny z dnia uczelni maja miejsce na zajecia .

                      //szukam nauczyciela ktory jest przypisany do zajec

                      foreach ($nauczyciele as $naucz)
                      {
                          //szukam mojego nauczyciela, oraz czy ma wtedy wolne , jesli tak to idzie do dodanie tego zajecia w ten dzien
                          if($naucz->getSubject() == $zaj[1] && ($gpu[1] == $naucz->getDay1() || $gpu[1] == $naucz->getDay2() || $gpu[1] == $naucz->getDay3()))
                          {
                              goto a;
                          }
                      }

                      if($godz1dnia>=$zaj[0] )
                      {
                          //sprawdzam czy w tablicy rozwizan juz nie ma tego zajecia
                          foreach($rozwiazania as $rozwiazanie){
                              if ($rozwiazanie[1]==$zaj[1])
                              {
                                  goto a;
                              }
                            }
                          //miesci sie i chce zapamietac to aby potem wyslac do bazy wynik
                          $rozwiazania[]=array($dzien,$zaj[1]);
                          $godz1dnia=$godz1dnia-$zaj[0];
                      }else{
                          //zmienna pamieta ile godzin zostalo ostatniego dnia i przechodze do innego zajecia
                          $myArray[  ] = $godz1dnia;
                          a:

                      }
                  }
              }



              //zapis elementow do bazy
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


        //weryfikacja czy wprowadzono do grafiku wszystkie przedmioty
        $zajecia= $this->getDoctrine()->getRepository(Zajecia::class)->findAll();
        $zapisane1=0;
        $rozwiazania1=0;
        foreach ($zajecia as $zaj){
            $zapisane1=$zapisane1+1;
        }
        foreach($wynikiAlgorytmuUczelnie as $rozwiazanie){
            $rozwiazania1=$rozwiazania1+1;
        }
        if($zapisane1==$rozwiazania1){
            $flaga=0;
        }else{
            $flaga=1;
            $ilosc_niezapisanych=$zapisane1-$rozwiazania1;
        }

        //wyrenderowanie szablonu widoku
        return $this->render('ktory_alg_zastosowac/index.html.twig', [
            'algForm' => $form->createView(),
            'wynikiAlgorytmuUczelnie' => $wynikiAlgorytmuUczelnie,
            'FLAGA'=>$flaga,
            'ilosc_niezapisanych'=>$ilosc_niezapisanych,
        ]);
    }


}
