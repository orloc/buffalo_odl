<?php
namespace OpenDeviceLab\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use OpenDeviceLab\AdminBundle\Form;

class SecurityController extends Controller { 
	/**
	* @Route("/login", name="login")
	* @Method({"GET"})
	*/
	public function loginAction (Request $request) { 
		$session = $request->getSession();

		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)){ 
			$error = $request->attributes->get(
				SecurityContext::AUTHENTICATION_ERROR
			);
		} else { 
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

		return $this->render('OpenDeviceLabAdminBundle:Security:login.html.twig', array ( 
			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error' => $error
		));
	}

	/**
	* @Route("/admin/register", name="register")
	* @Method({"GET|POST"})
	*/
	public function registerAction (Request $request) { 
		
		$form = $this->createForm(new Form\RegistrationType()); 
		
		$form->handleRequest($request);

		if ($form->isValid()){ 
			$entity = $form->getData();	
			$entity->setRoles(array('ROLE_USER'));

			$factory = $this->get('security.encoder_factory');
			$encoder = $factory->getEncoder($entity);
			
			$entity->setPassword(
				$encoder->encodePassword(
					$entity->getPassword(), 
					$entity->getSalt()
			));


			$em = $this->getDoctrine()->getManager();

			$em->persist($entity);
			$em->flush();
		}

		return $this->render('OpenDeviceLabAdminBundle:Security:register.html.twig', array(
			'form' => $form->createView()
		));
	}

	public function logoutAction () { 
	}

}
