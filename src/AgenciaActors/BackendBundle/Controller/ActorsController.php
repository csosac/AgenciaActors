<?php

namespace AgenciaActors\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AgenciaActors\FrontendBundle\Entity\Actor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActorsController extends Controller
{
    public function indexAction()
    {   
        $actors = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Actor')->findAll();

        return $this->render('AgenciaActorsBackendBundle:Default:actors.html.twig', array(
            'titol' => 'Llistat de Actors',
            'actors' => $actors));
    }

    
    public function addActorAction(Request $request)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $actor = new Actor();
        // $category->setName('tato');
 
        $form = $this->createFormBuilder($actor)
            ->add('nif', TextType::class, array('label' => 'NIF'))
            ->add('name', TextType::class, array('label' => 'Nom'))
            ->add('lastname', TextType::class, array('label' => 'Cognom'))
            ->add('genre', ChoiceType::class, array('choices'=> array('Dona' => 'female', 'Home' => 'male'),'label' => 'Sexe'))
            ->add('save', SubmitType::class, array('label' => 'Crear Actor'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $actor = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($actor);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Nou Actor afegit',
            'name' => $actor->getName()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Afegir Actor',
            'form' => $form->createView(),
        ));
    }

        public function updateActorAction(Request $request, $id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $actor = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Actor')->find($id);

 
        $form = $this->createFormBuilder($actor)
            ->add('nif', TextType::class, array('label' => 'NIF'))
            ->add('name', TextType::class, array('label' => 'Nom'))
            ->add('lastname', TextType::class, array('label' => 'Cognom'))
            ->add('genre', ChoiceType::class, array('choices'=> array('Dona' => 'female', 'Home' => 'male'),'label' => 'Sexe'))
            ->add('save', SubmitType::class, array('label' => 'Modificar Actor'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $actor = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Actor is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Actor modificat',
            'name' => $actor->getName()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Modificar Actor',
            'form' => $form->createView(),
        ));
    }

            public function deleteActorAction($id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $actor = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Actor')->find($id);

        if ($actor) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actor);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Actor eliminat',
            'name' => $actor->getName()));
        }
 
    }

}