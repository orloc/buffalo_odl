<?php

namespace OpenDeviceLab\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;

class AppointmentType extends AbstractType { 

    public function getName() { 
        return 'appointmenttype';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) { 

        $builder->add('device', 'entity', array (
            'class' => 'OpenDeviceLab\ApplicationBundle\Entity\Device',
            'query_builder' => function (EntityRepository $er) { 
                    return $er->getAvailable();
            },
            'property' => 'model', 
            'label' => 'Device', 
            'required' => true, 
            'multiple' => false, 
            'constraints' => new Assert\NotBlank(), 
            'empty_value' => ' -- Select a Device -- '
        ))
        ->add('start_time', 'datetime', array ( 
            'input' => 'datetime',
            'constraints' => new Assert\NotBlank()
        ))
        ->add('end_time', 'datetime', array(
            'input' => 'datetime',
            'constraints' => new Assert\NotBlank()
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) { 
        $resolver->setDefaults(array(
            'data_class' => 'OpenDeviceLab\ApplicationBundle\Entity\User'
        ));
    }
}
