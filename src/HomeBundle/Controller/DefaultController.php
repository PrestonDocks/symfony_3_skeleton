<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        if(count($users) == 0){
            $createAdminUserLink = true;
        }else{
            $createAdminUserLink = false;
        }
        return $this->render('HomeBundle:Default:index.html.twig',[
            'createAdminUserLink'=>$createAdminUserLink
        ]);
    }
}
