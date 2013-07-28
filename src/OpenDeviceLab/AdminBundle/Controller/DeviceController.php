<?php
namespace OpenDeviceLab\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use OpenDeviceLab\AdminBundle\Form;

class DeviceController extends Controller { 
	/**
	* @Route("/devices", name="admin_device_list")
	* @Method({"GET"})
	*/
	public function listAction() { 

		$em = $this->getDoctrine()->getManager();

		$devices = $em->getRepository('OpenDeviceLabApplicationBundle:Device')->findAll();

		return $this->render('OpenDeviceLabAdminBundle:Devices:list.html.twig', array (
			'devices' => $devices
		));

	}

	public function createAction() { 

	}

	public function editAction() { 

	}
		
	public function deleteAction() { 

	}
	
}
