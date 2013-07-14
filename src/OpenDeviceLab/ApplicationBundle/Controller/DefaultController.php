<?php
namespace OpenDeviceLab\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller { 
	
	/**
	* @Route("/", name="_landing")
	* @Method({"GET"})
	*/
	public function indexAction(Request $request) { 

		return $this->render('OpenDeviceLabApplicationBundle:Site:landing.html.twig');
	}
}
