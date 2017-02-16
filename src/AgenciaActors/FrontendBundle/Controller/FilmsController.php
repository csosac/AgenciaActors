<?php

namespace AgenciaActors\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FilmsController extends Controller
{
    public function indexAction()
    {
    	$films = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->findAll();
        $roles = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Role')->findAll();

        return $this->render('AgenciaActorsFrontendBundle:Default:films.html.twig', array(
        	'films' => $films, 'roles' => $roles));
    }

    public function filmAction($id)
    {   
        $films = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->findById($id);


        if (!$films) {

            /*throw $this->createNotFoundException(
                'No s\'ha trobat films per la id '.$id
            );*/
            $response = $this -> render('AgenciaActorsFrontendBundle:Default:404.html.twig', array(
                'message'   => 'No s\'ha trobat la pelicula'
            ));

            $response -> setStatusCode(404);    

            return $response;
        }

        $roles = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Role')->findAll();

        $finalRoles = array();
        foreach ($roles as $value) {
            if ( $value->getFilm()->getId() == $id){
                array_push($finalRoles, $value);
            }
        }

        return $this->render('AgenciaActorsFrontendBundle:Default:film.html.twig', array(
            'titol' => 'Nom de la pelicula',
            'films' => $films,
            'roles' => $finalRoles));
    }


}
