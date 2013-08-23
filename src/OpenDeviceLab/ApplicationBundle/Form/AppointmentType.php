<?php

namespace OpenDeviceLab\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;

use OpenDeviceLab\ApplicationBundle\Entity\Device;

class AppointmentType extends AbstractType { 

    public function getName() { 
        return 'appointmenttype';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) { 

        $builder->add('devices', 'entity', array (
            'class' => 'OpenDeviceLab\ApplicationBundle\Entity\Device',
            'query_builder' => function (EntityRepository $er) { 
                    return $er->getAvailable()
						->andWhere("d.status != :in_use")
						->setParameter('in_use', Device::STATUS_IN_USE);
            },
            'property' => 'model', 
            'label' => 'Device', 
            'required' => true, 
            'multiple' => true, 
            'constraints' => new Assert\NotBlank(), 
        ))
        ->add('start_time', 'datetime', array ( 
			'date_widget' => 'single_text',
			'time_widget' => 'single_text',
            'input' => 'datetime',
            'constraints' => new Assert\NotBlank()
        ))
        ->add('end_time', 'time', array(
			'widget' => 'single_text',
            'input' => 'datetime',
            'constraints' => new Assert\NotBlank()
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) { 
        $resolver->setDefaults(array(
            'data_class' => 'OpenDeviceLab\ApplicationBundle\Entity\Appointment'
        ));
    }
}
