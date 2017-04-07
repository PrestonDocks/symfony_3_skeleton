<?php

namespace HomeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 */
class HomeController extends Controller
{
    /**
     * @Route("/secure/home",name="home")
     */
    public function homeAction()
    {

    }
}
