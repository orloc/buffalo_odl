<?php
namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class BaseUserType extends AbstractType { 

    public function getName() { 
       return 'user'; 
    }

	public function buildForm(FormBuilderInterface $builder, array $options) {

		$builder->add('username', 'text', array(
				'constraints' => new Assert\NotBlank()
			))
			->add('first_name', 'text', array(
				'constraints' => new Assert\NotBlank()
			))
			->add('last_name', 'text', array(
				'constraints' => new Assert\NotBlank()
			))
			->add('email', 'email', array(
				'constraints' => new Assert\NotBlank()
			))
			->add('organization', 'text', array(
				'constraints' => new Assert\NotBlank()
			));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) { 
		$resolver->setDefaults(array(
			'data_class' => 'OpenDeviceLab\ApplicationBundle\Entity\User'
		));
	}
}
