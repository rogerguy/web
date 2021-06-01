<?php

namespace App\Controller;
use App\Entity\Reunion;
use App\Entity\User;
use App\Form\ReunionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\All;

/**
 * @Route("/reunion")
 */
class ReunionController extends AbstractController
{
    /**
     * @Route("/", name="reunion_index", methods={"GET"})
     */
    public function index(): Response
    {
        $reunions = $this->getDoctrine()
            ->getRepository(Reunion::class)
            ->findAll();

        return $this->render('reunion/index.html.twig', [
            'reunions' => $reunions,
        ]);
    }

     /**
     * @Route("/interface", name="reunion_interface", methods={"GET"})
     */
    public function interface(): Response
    {
        $reunions = $this->getDoctrine()
            ->getRepository(Reunion::class)
            ->findAll();
        return $this->render('reunion/interface.html.twig', [
            'reunions' => $reunions,
        ]);
    }

    //cette function permet de rechercher les utilisateurs les utilisateurs par leur id 
    public function finbymember($value): string {

        $userid = $this->getDoctrine()
            ->getRepository(User::class)
            ->findby(array('id'=>$value));
            foreach($userid as $usernameall){
                $usernamepresent[] = $usernameall->getUsername();             
             }
        $username = implode(',' ,$usernamepresent);  
        return  $username; 
    }
     

    /**
     * @Route("/new", name="reunion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
      
        $reunion = new Reunion();
        $form = $this->createForm(ReunionType::class, $reunion);
        $form->handleRequest($request);
 
        if ($form->isSubmitted()) {
            $quest = $request->request->all();
           //verification de la presence d'un membre  
            if(isset($quest['reunion']['membrepresent'])){
                $membrepresent= $quest['reunion']['membrepresent'];
                $usernamepresent = $this->finbymember($membrepresent);
                $reunion->setMembrepresent($usernamepresent);

                if( isset($quest['reunion']['membreabsent'])){
                    $membreabsent= $quest['reunion']['membreabsent'];
                //verification si un membre est présent ou absent     
                    $result =  array_intersect($membrepresent, $membreabsent);
                    if($result){
                      //variable permettant de génerer l'alerte   
                        $identique = 0;
                        return $this->render('reunion/new.html.twig', [
                            'reunion' => $reunion,
                            'identique'=>$identique,
                            'form' => $form->createView(),
                        ]);
                    }
                    $usernameabsent = $this->finbymember($membreabsent);
                    $reunion->setMembreabsent($usernameabsent);
                }
                else{
                    $reunion->setMembreabsent('');
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($reunion);
                $entityManager->flush();
                return $this->redirectToRoute('reunion_index');
            }
        else{
                //variable permettant de génerer l'alerte   
            $checkof = 0;
            return $this->render('reunion/new.html.twig', [
                'reunion' => $reunion,
                'checkof'=>$checkof,
                'form' => $form->createView(),
            ]);
            }
        }
        return $this->render('reunion/new.html.twig', [
            'reunion' => $reunion,
            'form' => $form->createView(),
        ]);
     
} 

    /**
     * @Route("/{id}", name="reunion_show", methods={"GET"})
     */
    public function show(Reunion $reunion): Response
    {
        return $this->render('reunion/show.html.twig', [
            'reunion' => $reunion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reunion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reunion $reunion): Response
    {
        $form = $this->createForm(ReunionType::class, $reunion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reunion_index');
        }

        return $this->render('reunion/edit.html.twig', [
            'reunion' => $reunion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reunion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reunion $reunion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reunion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reunion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reunion_index');
    }
}
