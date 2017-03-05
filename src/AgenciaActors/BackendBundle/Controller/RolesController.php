<?php

namespace AgenciaActors\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AgenciaActors\FrontendBundle\Entity\Role;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RolesController extends Controller
{
    public function indexAction()
    {   
        $roles = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Role')->findAll();

        return $this->render('AgenciaActorsBackendBundle:Default:roles.html.twig', array(
            'titol' => 'Llistat de Roles',
            'roles' => $roles));
    }
    
    public function addRoleAction(Request $request)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $role = new Role();
        // $category->setName('tato');
 
        $form = $this->createFormBuilder($role)
            ->add('film', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Film',
                'choice_label' => 'name',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('role', TextType::class, array('label' => 'Nom del paper',
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('actor', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Actor',
                'choice_label' => 'name',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Crear Role','attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $role = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Nou Role afegit',
            'name' => $role->getRole()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Afegir Role',
            'form' => $form->createView(),
        ));
    }

        public function updateRoleAction(Request $request, $id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $role = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Role')->find($id);

 
        $form = $this->createFormBuilder($role)
            ->add('film', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Film',
                'choice_label' => 'name',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('role', TextType::class, array('label' => 'Nom del paper',
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('actor', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Actor',
                'choice_label' => 'name',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Modificar Role','attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $role = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Role is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Role modificat',
            'name' => $role->getName()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Modificar Role',
            'form' => $form->createView(),
        ));
    }

            public function deleteRoleAction($id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $role = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Role')->find($id);

        if ($role) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($role);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Role eliminat',
            'name' => $role->getName()));
        }
 
    }

}