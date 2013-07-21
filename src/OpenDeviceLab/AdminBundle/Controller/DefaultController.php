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

class DefaultController extends Controller { 
	
	public function indexAction() {
	}

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

	public function logoutAction () { 
	}
}
