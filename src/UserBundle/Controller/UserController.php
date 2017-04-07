<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\editUserForm;

/**
 * @Security("has_role('ROLE_USER')")
 */
class UserController extends Controller
{
	/**
	 * @Route("/profile",name="user_profile")
	 */
	public function userProfileAction(Request $request)
    {

        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(editUserForm::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }
		return $this->render('@User/user/profile.html.twig',[
		    'form'=>$form->createView(),
        ]);
    }


}
