<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

/**
 * @Security("has_role('ROLE_USER')")
 */
class UserController extends Controller
{
	/**
	 * @Route("/profile",name="user_profile")
	 */
	public function userProfileAction( )
    {
		return $this->render('@User/user/profile.html.twig');
    }


}
