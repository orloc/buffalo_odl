<?php

namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

use OpenDeviceLab\ApplicationBundle\Entity\Device;

class BaseDeviceType extends AbstractType { 

    public function getName() { 
        return 'device';
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
        ->add('wear', 'choice', array ( 
            'constraints' => new Assert\NotBlank(),
            'choices' => array (
                Device::WEAR_NEW => 'New',
                Device::WEAR_USED => 'Used',
                Device::WEAR_WORN => 'Worn'
            )
        ));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) { 
		$resolver->setDefaults(array(
			'data_class' => 'OpenDeviceLab\ApplicationBundle\Entity\Device'
		));
	}
}
