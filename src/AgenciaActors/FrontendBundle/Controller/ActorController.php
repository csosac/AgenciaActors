<?php

namespace AgenciaActors\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ActorController extends Controller
{
    public function indexAction()
    {
    	$actors = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Actor')->findAll();

        return $this->render('AgenciaActorsFrontendBundle:Default:actors.html.twig', array(
        	'actors' => $actors));
    }

    public function artistAction($id)
    {   
        $actors = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Actor')->findById($id);

        if (!$actors) {
            /*throw $this->createNotFoundException(
                'No s\'ha trobat actors per la id '.$id
            );*/
            $response = $this -> render('AgenciaActorsFrontendBundle:Default:404.html.twig', array(
                'message'   => 'No s\'ha trobat actors per la id '.$id
            ));

            $response -> setStatusCode(404);    

            return $response;
        }

        return $this->render('AgenciaActorsFrontendBundle:Default:actors.html.twig', array(
            'titol' => 'Nom de l\'actor',
            'actor' => $actors));
    }
}
