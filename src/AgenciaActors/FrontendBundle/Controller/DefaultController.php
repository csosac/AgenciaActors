<?php

namespace AgenciaActors\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$films = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->findAll();
    	$ratingRandom = array();
    	for ($i=0; $i < count($films); $i++) { 
    		$rating = random_int(0,5);
    		array_push($ratingRandom, $rating);
    	}
        return $this->render('AgenciaActorsFrontendBundle:Default:index.html.twig', array(
        	'films' => $films, 'rating'=>$ratingRandom));
    }
}
