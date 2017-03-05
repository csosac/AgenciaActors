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
            ->add('name', 
                TextType::class, 
                array('label' => 'Nom',
                    'label_attr'=> array('class' => 'label_text spaceTop'), 
                    'attr' => array('class' => 'form-control')))



            ->add('description', TextType::class, array('label' => 'Descripcio',
                    'label_attr'=> array('class' => 'label_text spaceTop'), 
                    'attr' => array('class' => 'form-control')))
            ->add('type', TextType::class, array('label' => 'Tipo',
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('startDate', DateType::class, array(
                    'label' => 'Data Inici',
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                    'attr' => ['class' => 'js-datepicker form-control'],
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('endDate', DateType::class, array(
                    'label' =>'Data final',
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                    'attr' => ['class' => 'js-datepicker form-control'],
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('photoURL', TextType::class, array('label' => 'Url de la foto',
                    'label_attr'=> array('class' => 'label_text spaceTop'), 
                    'attr' => array('class' => 'form-control')))
            ->add('director', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Director',
                'choice_label' => 'name',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Crear Film','attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
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
            ->add('name', TextType::class, array('label' => 'Nom',
                    'label_attr'=> array('class' => 'label_text spaceTop'), 
                    'attr' => array('class' => 'form-control')))
            ->add('description', TextType::class, array('label' => 'Descripcio',
                    'label_attr'=> array('class' => 'label_text spaceTop'), 
                    'attr' => array('class' => 'form-control')))
            ->add('type', TextType::class, array('label' => 'Tipo',
                    'label_attr'=> array('class' => 'label_text spaceTop'), 
                    'attr' => array('class' => 'form-control')))
            ->add('startDate', DateType::class, array(
                    'label' => 'Data Inici',
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                    'attr' => ['class' => 'js-datepicker form-control'],
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('endDate', DateType::class, array(
                    'label' =>'Data final',
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                    'attr' => ['class' => 'js-datepicker form-control'],
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('photoURL', TextType::class, array('label' => 'Url de la foto',
                    'label_attr'=> array('class' => 'label_text spaceTop'), 
                    'attr' => array('class' => 'form-control')))
            ->add('director', EntityType::class, array(
                'class' => 'AgenciaActorsFrontendBundle:Director',
                'choice_label' => 'name',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Modificar Film','attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
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