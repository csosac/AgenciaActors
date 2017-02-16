<?php

namespace AgenciaActors\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AgenciaActors\FrontendBundle\Entity\Film;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FilmsController extends Controller
{
    public function indexAction()
    {   
        $films = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->findAll();

        return $this->render('AgenciaActorsBackendBundle:Default:films.html.twig', array(
            'titol' => 'Llistat de Films',
            'films' => $films));
    }
    
    public function addFilmAction(Request $request)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $film = new Film();

        $form = $this->createFormBuilder($film)
            ->add('name', TextType::class, array('label' => 'Nom'))
            ->add('description', TextType::class, array('label' => 'Descripcio'))
            ->add('type', TextType::class, array('label' => 'Tipo'))
            ->add('startDate', DateType::class, array('placeholder' => array('label' => 'Data d\'inici','year' => 'Any', 'month' => 'Mes', 'dia' => 'Day'),'label' =>'Data d\'inici'))
            ->add('endDate', DateType::class, array('label' =>'Data final','placeholder' => array('year' => 'Any', 'month' => 'Mes', 'dia' => 'Day')))
            ->add('photoURL', TextType::class, array('label' => 'Url de la foto'))
            ->add('director', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Director',
                'choice_label' => 'name',
                'multiple' => FALSE
            ))
            ->add('save', SubmitType::class, array('label' => 'Crear Film'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $film = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Nou Film afegit',
            'name' => $film->getName()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Afegir Film',
            'form' => $form->createView(),
        ));
    }

        public function updateFilmAction(Request $request, $id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $film = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->find($id);
 
        $form = $this->createFormBuilder($film)
            ->add('name', TextType::class, array('label' => 'Nom'))
            ->add('description', TextType::class, array('label' => 'Descripcio'))
            ->add('type', TextType::class, array('label' => 'Tipo'))
            ->add('startDate', DateType::class, array('placeholder' => array('label' => 'Data d\'inici','year' => 'Any', 'month' => 'Mes', 'dia' => 'Day'),'label' =>'Data d\'inici'))
            ->add('endDate', DateType::class, array('placeholder' => array('year' => 'Any', 'month' => 'Mes', 'dia' => 'Day'),'label' =>'Data final'))
            ->add('photoURL', TextType::class, array('label' => 'Url de la foto'))
            ->add('director', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Director',
                'choice_label' => 'name',
                'multiple' => FALSE
            ))
            ->add('save', SubmitType::class, array('label' => 'Modificar Film'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $film = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Film is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Film modificat',
            'name' => $film->getName()));
        }
 
        return $this->render('AgenciaActorsBackendBundle:Default:crudObjecte.html.twig', array(
            'titol' => 'Modificar Film',
            'form' => $form->createView(),
        ));
    }

            public function deleteFilmAction($id)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo

        $film = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->find($id);

        if ($film) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();

            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Film eliminat',
            'name' => $film->getName()));
        }
 
    }

}