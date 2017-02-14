<?php

namespace AgenciaActors\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AgenciaActors\FrontendBundle\Entity\Director;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DirectorsController extends Controller
{
    public function indexAction()
    {   
        $directors = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Director')->findAll();

        return $this->render('AgenciaActorsBackendBundle:Default:directors.html.twig', array(
            'titol' => 'Llistat de Directors',
            'directors' => $directors));
    }
    
    public function addDirectorAction(Request $request)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $director = new Director();
        // $category->setName('tato');
 
        $form = $this->createFormBuilder($director)
            ->add('nif', TextType::class, array('label' => 'NIF'))
            ->add('name', TextType::class, array('label' => 'Nom'))
            ->add('lastname', TextType::class, array('label' => 'Cognom'))
            ->add('save', SubmitType::class, array('label' => 'Crear Director'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $director = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($director);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Nou Director afegit',
            'name' => $director->getName()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Afegir Director',
            'form' => $form->createView(),
        ));
    }

        public function updateDirectorAction(Request $request, $id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $director = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Director')->find($id);

 
        $form = $this->createFormBuilder($director)
            ->add('nif', TextType::class, array('label' => 'NIF'))
            ->add('name', TextType::class, array('label' => 'Nom'))
            ->add('lastname', TextType::class, array('label' => 'Cognom'))
            ->add('save', SubmitType::class, array('label' => 'Modificar Director'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $director = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Director is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Director modificat',
            'name' => $director->getName()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Modificar Director',
            'form' => $form->createView(),
        ));
    }

            public function deleteDirectorAction($id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $director = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Director')->find($id);

        if ($director) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($director);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Director eliminat',
            'name' => $director->getName()));
        }
 
    }

}