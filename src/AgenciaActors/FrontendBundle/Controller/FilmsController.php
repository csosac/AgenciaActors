<?php

namespace AgenciaActors\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FilmsController extends Controller
{
    public function indexAction()
    {
    	$films = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->findAll();

        return $this->render('AgenciaActorsFrontendBundle:Default:films.html.twig', array(
        	'films' => $films));
    }

    public function artistAction($id)
    {   
        $films = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->findById($id);

        if (!$films) {
            /*throw $this->createNotFoundException(
                'No s\'ha trobat films per la id '.$id
            );*/
            $response = $this -> render('AgenciaActorsFrontendBundle:Default:404.html.twig', array(
                'message'   => 'No s\'ha trobat pelicules per la id '.$id
            ));

            $response -> setStatusCode(404);    

            return $response;
        }

        return $this->render('AgenciaActorsFrontendBundle:Default:films.html.twig', array(
            'titol' => 'Nom de les pelicules',
            'films' => $films));
    }
}
