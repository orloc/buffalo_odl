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

	/**
	* @Route("/devices/create", name="admin_device_create")
	* @Method({"GET|POST"})
	*/
	public function createAction(Request $request) { 

		$form = $this->createForm(new Form\DeviceType());

		$form->handleRequest($request);

		if ($form->isValid()){ 
			$entity = $form->getData();
			$em = $this->getDoctrine()->getManager();

			$em->persist($entity);
			$em->flush();

			$this->get('session')->getFlashBag()->add('success', sprintf('Device %s has been added successfully', $entity->getModel()));

			return $this->redirect($this->generateUrl('admin_device_list'));
		}
		return $this->render('OpenDeviceLabAdminBundle:Devices:detail.html.twig', array ( 
			'form' => $form->createView()
		));

	}

	public function editAction() { 

	}
		
	public function deleteAction() { 

	}
	
}
