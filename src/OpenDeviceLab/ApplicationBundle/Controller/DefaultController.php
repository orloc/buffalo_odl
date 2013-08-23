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
		
		$devices = $repo->getAvailable()->getQuery()->getResult();
		$wanted = $repo->getWanted()->getQuery()->getResult();

		$contactForm->handleRequest($request);

		/* 
		* @TODO 
		* Clean this up and abstract out
		*/
		$sent = null;
		if ($contactForm->isValid()){
			$data = $contactForm->getData();	

			$message = \Swift_Message::newInstance()
				->setSubject('Contact')
				->setFrom($data['email'])
				->setTo('buffodl@gmail.com')
				->setBody("${data['first_name']} - ${data['last_name']} \n\n
						   ${data['message']}"
				);

			if ($this->get('mailer')->send($message)) {
				$this->get('session')->getFlashBag()->add('success', 'Thanks for getting in touch! We do our best to respond within 48 hours.');
			} else { 
				$this->get('session')->getFlashBag()->add('notice', 'We were unable to send your e-mail at this time, please try again later.');
			}
		}

		return $this->render('OpenDeviceLabApplicationBundle:Site:landing.html.twig', array ( 
			'contact' => $contactForm->createView(),
			'available' => $devices,
			'wanted' => $wanted,
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

			$this->get('session')->getFlashBag()->add('success', 'Your Donation Application has been submitted and we will be in touch to schedule an appointment, thank you for being awesome!');
        }

        return $this->render('OpenDeviceLabApplicationBundle:Site:donate.html.twig', array (
            'form' => $donateForm->createView()
        ));  
    }

    /**
     * @Route("/appointments", name="_appointment")
     * @Method({"GET|POST"})
     */
    public function appointmentAction (Request $request) { 
        
        $appointmentForm = $this->createForm(new Form\AppointmentType());

        $appointmentForm->handleRequest($request);

        if ($appointmentForm->isValid()){
            $entity = $appointmentForm->getData();
			var_dump($entity);die;
            $em = $this->getDoctrine()->getManager(); 

            $em->persist($e);
            $em->flush();
        }

        return $this->render('OpenDeviceLabApplicationBundle:Site:appointment.html.twig', array (
            'form' => $appointmentForm->createView()
        ));  
    }
}
