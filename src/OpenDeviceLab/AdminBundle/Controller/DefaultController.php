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
	
	/**
	* @Route("/", name="admin_index")
	* @Method({"GET"})
	*/
	public function indexAction() {
		return $this->render('OpenDeviceLabAdminBundle:Panel:landing.html.twig');
	}

}
