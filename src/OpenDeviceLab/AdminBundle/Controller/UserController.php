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

class UserController extends Controller { 
	
	/**
	* @Route("/users", name="admin_user_list")
	* @Method({"GET"})
	*/
	public function listAction () {
		
		$form = $this->createFormBuilder()
			->setMethod('DELETE')
			->add('delete', 'submit')
			->getForm();

		$em = $this->getDoctrine()->getManager();

		$users = $em->getRepository('OpenDeviceLabApplicationBundle:User')->findAll();

		return $this->render('OpenDeviceLabAdminBundle:Users:list.html.twig', array(
			'users' => $users,
			'form'	=> $form->createView()
		));
	}

	/**
	* @Route("/users/{id}", name="admin_user_detail")
	* @Method({"GET|POST"})
	*/
	public function editAction(Request $request, $id) { 

		$em = $this->getDoctrine()->getManager();

		$user = $em->getRepository('OpenDeviceLabApplicationBundle:User')->find($id);

		$form = $this->createForm(new Form\UserType(), $user);

		$form->handleRequest($request);

		if ($form->isValid()){ 
			$entity = $form->getData();

			if ($entity->getPassword()){
				$factory = $this->get('security.encoder_factory');
				$encoder = $factory->getEncoder($entity);
				
				$entity->setPassword(
					$encoder->encodePassword(
						$entity->getPassword(), 
						$entity->getSalt()
				));
			}

			$em->persist($entity);
			$em->flush();
			
			$this->get('session')->getFlashBag()->add('success', sprintf('User with id: %s was successfully updated', $id));

			return $this->redirect($this->generateUrl('admin_user_list'));
		}

		return $this->render('OpenDeviceLabAdminBundle:Users:detail.html.twig', array (
			'user' => $user,
			'form' => $form->createView()
		));
	}

	/**
	* @Route("/users/create", name="admin_user_create")
	* @Method({"GET|POST"})
	*/
	public function createAction(Request $request) {

		$form = $this->createForm(new Form\UserType());
		
		$form->handleRequest($request);

		if ($form->isValid()){ 
			$entity = $form->getData();	

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

			$this->get('session')->getFlashBag()->add('success', sprintf('User with id: %s was successfully created', $id));
		}
	}

	/**
	* @Route("/users/delete/{id}", name="admin_user_delete")
	* @Method({"DELETE"}) 
	*/
	public function deleteAction(Request $request, $id){ 

		
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('OpenDeviceLabApplicationBundle:User')->find($id);

		if ($user) { 
			$em->remove($user);
			$em->flush();

			$this->get('session')->getFlashBag()->add('success', sprintf('User with id: %s was successfully removed', $id));
		} else { 
			$this->get('session')->getFlashBag()->add('warning', 'User not found');
		}

		return $this->redirect($this->generateUrl('admin_user_list'));
	}
}
