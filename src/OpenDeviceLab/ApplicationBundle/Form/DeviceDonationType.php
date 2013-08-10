<?php

namespace OpenDeviceLab\ApplicationBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints as Assert;

class DeviceDonationType extends ContactType { 

    public function getName() { 
        return 'devicedonation';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) { 
        
        parent::buildForm($builder, $options);

        $builder->remove('message')
            ->add('device_name', 'text', array ( 
                'constraints' => new Assert\NotBlank(), 
                'label' => 'Device Name'
            ))
            ->add('operating_system', 'text', array ( 
                'constraints' => new Assert\NotBlank(), 
                'label' => 'Operating System'
            ))
            ->add('manufacturer', 'text', array (
                'constraints' => new Assert\NotBlank(), 
                'label' => 'Manufacturer'
            ))
            ->add('organization', 'text', array ( 
                'required' => false
            ))
            ->add('comment', 'textarea', array ( 
                'label' => 'Comments',
                'required' => false
            ));
    }
}
