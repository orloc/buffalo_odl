<?php
namespace OpenDeviceLab\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use OpenDeviceLab\ApplicationBundle\Form;

class DefaultController extends Controller { 
	
	/**
	* @Route("/", name="_landing")
	* @Method({"GET"})
	*/
	public function indexAction(Request $request) { 
		$contactForm =	$this->createForm(new Form\ContactType()); 
		
		$em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('OpenDeviceLabApplicationBundle:Device');

		$devices = $repo->getAvailable();
		$wanted = $repo->getWanted();

		#$available_devices = $em->getRepository('OpenDeviceLabApplicationBundle:Device')->
		return $this->render('OpenDeviceLabApplicationBundle:Site:landing.html.twig', array ( 
			'contact' => $contactForm->createView(),
			'available' => $devices,
			'wanted' => $wanted
		));
	}

    /**
     * @Route("/donate", name="_donate")
     * @Method({"GET|POST"})
     */
    public function donateAction (Request $request) { 
        
        $donateForm = $this->createForm(new Form\DeviceDonationType());

        $donateForm->handleRequest($request);

        if ($donateForm->isValid()){ 
            
        }

        return $this->render('OpenDeviceLabApplicationBundle:Site:donate.html.twig', array (
            'form' => $donateForm->createView()
        ));  
    }
}
