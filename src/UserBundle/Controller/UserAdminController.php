<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\adminUserEditForm;
use UserBundle\Form\registerForm;

/**
 * @Route("/admin/user")
 */
class UserAdminController extends Controller
{
    /**
     * @Route("/list",name="admin_user_list")
     */
    public function listAction()
    {

        /** @var User $users */
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)
            ->findAll();
        return $this->render('@User/admin/adminUserList.html.twig',[
            'users'=>$users,
        ]);
    }

    /**
     * @Route("/add",name="admin_user_add")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(registerForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var User $data */
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('@User/security/register.html.twig',[
            'form'=>$form->createView(),
            'pageTitle'=>'Create User',
        ]);
    }

    /**
     * @Route("/edit/{id}",name="admin_user_edit")
     */
    public function editAction(Request $request, $id)
    {
        /** @var User $user */
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
        $form = $this->createForm(adminUserEditForm::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var User $data */
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('@User/security/register.html.twig',[
            'form'=>$form->createView(),
            'pageTitle'=>'Create User',
        ]);
    }

    /**
     * @Route("/delete/{id}",name="admin_user_delete")
     */
    public function deleteAction($id)
        {
            $em = $this->getDoctrine()->getmanager();
            $user = $em->getRepository(User::class)->find($id);

            $em->remove($user);
            $em->flush();
            return $this->redirectToRoute('admin_user_list');
        }
}
