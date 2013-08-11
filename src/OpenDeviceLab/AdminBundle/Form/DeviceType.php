<?php

namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

use OpenDeviceLab\ApplicationBundle\Entity\Device;

class DeviceType extends BaseDeviceType { 
	
	public function getName() { 
		return 'devices';
	}

	public function buildForm(FormBuilderInterface $builder, array $options) { 

        parent::buildForm($builder, $options);
		
        $builder->add('donated_by', 'text', array (
                'constraints' => new Assert\NotBlank()
            ))
            ->add('status', 'choice', array (
			'choices' => array (
				Device::STATUS_AVAILABLE => 'Available',
				Device::STATUS_IN_USE => 'In Use',
				Device::STATUS_WANTED => 'Wanted',
				Device::STATUS_DISABLED => 'Disabled'
			),
			'constraints' => new Assert\NotBlank()
		));
	}

}
