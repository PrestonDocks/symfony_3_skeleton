<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class UserController extends Controller
{
	/**
	 * @Route("/secure/profile",name="user_profile")
	 */
	public function userProfileAction( )
    {
		return $this->render('@User/user/profile.html.twig');
    }


}
