<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class FirstPageController extends AbstractController
{
    /**
     * @Route("/recapitulatif", name="acceuil")
     */
    public function index(): Response
    {
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();
     
//recuparation de toute les dates d'inscription des utilisateurs 
        foreach($user as $users){
         $alldate [] = $users->getcreated()->format('M-Y');
        }
//recherche date unique et le nombre d'occurence dans la liste des users 
        $dateunique  = array_count_values($alldate);
        foreach($dateunique as $toutedate => $key ){
            $keyall[] = $key;
            $valeurdate[] =  $toutedate;        
        }
        
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'IndexController',
            'nombreuser'=>$keyall ,
            'dateinscription'=>$valeurdate
        ]);
    }

    /**
     * @Route("/memberlist", name="listedesmemebres")
     */

     public function memberlist (): Response 
     {
        $alluser = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();
     
        return $this->render('utilisateur/listemembre.html.twig', [
            'alluser' => $alluser         
        ]);

     }

     /** 
     * @Route("/{id}/profil", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('utilisateur/profil.html.twig', [
            'user' => $user,
        ]);
    }


}
