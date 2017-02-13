<?php

namespace AgenciaActors\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DirectorsController extends Controller
{
    public function indexAction()
    {
    	$directors = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Director')->findAll();

        return $this->render('AgenciaActorsFrontendBundle:Default:director.html.twig', array(
        	'directors' => $directors));
    }

    public function direcotrAction($id)
    {   
        $director = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Director')->findById($id);

        if (!$director) {
            /*throw $this->createNotFoundException(
                'No s\'ha trobat director per la id '.$id
            );*/
            $response = $this -> render('AgenciaActorsFrontendBundle:Default:404.html.twig', array(
                'message'   => 'No s\'ha trobat director per la id '.$id
            ));

            $response -> setStatusCode(404);    

            return $response;
        }

        return $this->render('AgenciaActorsFrontendBundle:Default:director.html.twig', array(
            'titol' => 'Nom del director',
            'director' => $directors));
    }
}
