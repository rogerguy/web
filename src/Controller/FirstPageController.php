<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FirstPageController extends AbstractController
{
    /**
     * @Route("/recapitulatif", name="acceuil")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
