<?php

namespace OpenDeviceLab\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints as Assert;

use OpenDeviceLab\AdminBundle\Form as AdminForms;

class DeviceDonationType extends AbstractType { 

    public function getName() { 
        return 'devicedonation';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) { 

       $builder->add('user', new AdminForms\BaseUserType()) 
            ->add('device', new AdminForms\BaseDeviceType());
    }
}
