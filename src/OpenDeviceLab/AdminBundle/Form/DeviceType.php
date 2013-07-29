<?php

namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

use OpenDeviceLab\ApplicationBundle\Entity\Device;

class DeviceType extends AbstractType { 
	
	public function getName() { 
		return 'devices';
	}

	public function buildForm(FormBuilderInterface $builder, array $options) { 
		
		$builder->add('manufacturer', 'text', array ( 
			'constraints' =>  new Assert\NotBlank()
		))
		->add('model', 'text', array ( 
			'constraints' => new Assert\NotBlank()
		))
		->add('operating_system', 'text', array (
			'constraints' => new Assert\NotBlank()
		))
		->add('donated_by', 'text', array (
			'constraints' => new Assert\NotBlank()
		))
		->add('status', 'choice', array (
			'choices' => array (
				Device::STATUS_AVAILABLE => 'Available',
				Device::STATUS_IN_USE => 'In Use',
				Device::STATUS_WANTED => 'Wanted'
			),
			'constraints' => new Assert\NotBlank()
		));
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) { 
		$resolver->setDefaults(array(
			'data_class' => 'OpenDeviceLab\ApplicationBundle\Entity\Device'
		));
	}
}
