<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Mailer\MailerInterface;

class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function index(Request $request)
    {
        
    $setme= $this->get('swiftmailer.mailer.default.transport.real')->getusername();
        
        $data = $request->request;
    if ($txtMsg= $data->get('txtMsg'))  {
        $name =$data->get('txtName');
        $email =$data->get('txtEmail');
        $phone=$data->get('txtPhone');
        $objet =$data->get('Objet');
        $txtMsg= $data->get('txtMsg');
        $message = (new \Swift_Message($objet))
                   ->setFrom(array($email=>$email))
                   ->setReplyTo($email)
                   ->setTo($setme)
                   ->setBody($txtMsg . nl2br("\r"). nl2br('numero de téléphone:'.$phone)."<br/> Envoyé par : $email</h1>", 'text/html');
       
    $this->get('mailer')->send($message);
    
    return $this->render('utilisateur/mail.html.twig',['send'=>1,"name"=>$name]);
                }  
     
        return $this->render('utilisateur/mail.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
