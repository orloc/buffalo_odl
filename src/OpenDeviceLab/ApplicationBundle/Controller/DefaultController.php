<?php
namespace OpenDeviceLab\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use OpenDeviceLab\ApplicationBundle\Form;
use OpenDeviceLab\ApplicationBundle\Entity;

class DefaultController extends Controller { 
	
	/**
	* @Route("/", name="_landing")
	* @Method({"GET|POST"})
	*/
	public function indexAction(Request $request) { 
		$contactForm =	$this->createForm(new Form\ContactType()); 
		
		$em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('OpenDeviceLabApplicationBundle:Device');
		
		$devices = $repo->getAvailable();
		$wanted = $repo->getWanted();

		$contactForm->handleRequest($request);

		/* 
		* @TODO 
		* Clean this up and abstract out
		*/
		if ($contactForm->isValid()){
			$data = $contactForm->getData();	

			$message = \Swift_Message::newInstance()
				->setSubject('Contact')
				->setFrom($data['email'])
				->setTo('buffodl@gmail.com')
				->setBody("${data['first_name']} - ${data['last_name']} \n\n
						   ${data['message']}"
				);

			$sent = $this->get('mailer')->send($message);
		}

		if (isset($sent))
			var_dump($sent);

		return $this->render('OpenDeviceLabApplicationBundle:Site:landing.html.twig', array ( 
			'contact' => $contactForm->createView(),
			'available' => $devices,
			'wanted' => $wanted,
			'sent' => isset($sent) ? $sent : null 
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
            $entities = $donateForm->getData();    
            $em = $this->getDoctrine()->getManager(); 
            
            if ($entities['device'] instanceof Entity\Device) { 
                $entities['device']->setDonatedBy($entities['user']->getFullName())
                    ->setStatus(Entity\Device::STATUS_DONATED);
            }

            foreach ($entities as $e) {
                $em->persist($e);
            }
            $em->flush();
        }

        return $this->render('OpenDeviceLabApplicationBundle:Site:donate.html.twig', array (
            'form' => $donateForm->createView()
        ));  
    }
}
