<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\LoginForm;
use UserBundle\Form\registerForm;
use UserBundle\Form\resetPasswordForm;

class SecurityController extends Controller
{
	/**
	 * @Route("/login",name="security_login")
	 */
	public function loginAction() {
		$authenticationUtils = $this->get('security.authentication_utils');

		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		$form = $this->createForm(LoginForm::class,[
			'_username'=>$lastUsername,
		]);

		return $this->render('@User/security/login.html.twig', array(
			'error'         => $error,
			'form'          => $form->createView(),
		));
    }

    /**
     * @Route("/logout",name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('Error, Logout method should not be reachable');
    }

    /**
     * @Route("/register",name="security_register")
     */
    public function registerAction(Request $request)
    {

        $form = $this->createForm(registerForm::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('security_login');
        }
        return $this->render('@User/security/register.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/add_admin_user",name="admin_user_add_admin")
     */
    public function addAdminAction()
    {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        if(count($users) > 0){
            return $this->redirectToRoute('home');
        }

        $user = new User();
        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->setEmail('admin@example.com');
        $user->setFirstName('admin');
        $user->setLastName('admin');
        $user->setPhoneNumber('123');
        $user->setMobileNumber('123');
        $user->setRoles(['ROLE_ADMIN']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('security_login');
    }

    /**
     * @Route("/forgot_password",name="security_forgot_password")
     */
    public function forgotPasswordAction(Request $request)
    {
        if($request->isMethod('POST')){
            $email = $request->get('email');

            $em = $this->getDoctrine()->getManager();

            /** @var User $user */
            $user = $em->getRepository(User::class)->findOneBy(['email'=>$email]);
            if($user) {
                $user->setPasswordResetCode(uniqid());

                $em->persist($user);

                $em->flush();
            }

            return $this->redirectToRoute('security_login');
        }

        return $this->render('@User/security/forgotPassword.html.twig');
    }

    /**
     * @Route("/reset_password/{reset_code}",name="security_reset_password")
     */
    public function resetAction(Request $request, $reset_code)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $em->getRepository(User::class)->findOneBy(['passwordResetCode'=>$reset_code]);
        if($user){

        }
    }

    /**
     * @Route("/choose_password",name="security_choose_password")
     */
    public function choosePasswordAction(Request $request, $resetCode = null)
    {

        $form = $this->createForm(resetPasswordForm::class,['data'=>['reset_code'=>$resetCode]]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

        }

        return $this->render('@User/security/resetPassword.html.twig',[
            'resetCode'=>$resetCode,
        ]);

    }
}
