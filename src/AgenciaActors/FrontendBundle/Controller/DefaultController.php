<?php

namespace AgenciaActors\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$films = $this->getDoctrine()->getRepository('AgenciaActorsFrontendBundle:Film')->findAll();
    	
        return $this->render('AgenciaActorsFrontendBundle:Default:index.html.twig', array(
        	'films' => $films));
    }
}
