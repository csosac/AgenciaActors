<?php
namespace AgenciaActors\BackendBundle\Controller;

use AgenciaActors\BackendBundle\Entity\UserType;
use AgenciaActors\BackendBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    public function indexAction()
    {   
        return $this->render('AgenciaActorsBackendBundle:Default:register.html.twig', array(
            'titol' => 'Llistat de Roles',
            array('form' => $form->createView())));
    }

    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            //return $this->redirectToRoute('agencia_actors_backend_homepage');
            return $this->render('AgenciaActorsBackendBundle:Default:objecteAdded.html.twig', array(
            'titol' => 'Usuari registrat',
            'name' => $user->getUsername()));
        }

        return $this->render(
            'AgenciaActorsBackendBundle:Default:register.html.twig',
            array('form' => $form->createView())
        );
    }
}