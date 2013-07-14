<?php

namespace OpenDeviceLab\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType { 
	
	public function getName() { 
		return 'contacttype';
	}

	public function buildForm(FormBuilderInterface $builder, array $options) { 

		$builder->add('first_name', 'text', array (
					'trim' => true, 
					'constraints' => new Assert\NotBlank(),
					'label' => 'First Name:'
				))
				->add('last_name', 'text', array ( 
					'trim' => true, 
					'constraints' => new Assert\NotBlank(),
					'label' => 'Last Name:'
				))
				->add('email', 'email', array (
					'trim' => true,
					'constraints' => new Assert\NotBlank(),
					'label' => 'E-mail Address:'
				))
				->add('message', 'textarea', array ( 
					'trim' => true,
					'constraints' => new Assert\NotBlank(),
					'label' => 'Message:'
				));
	}
}
