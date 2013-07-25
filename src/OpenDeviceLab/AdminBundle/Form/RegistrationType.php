<?php 
namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface; 
use Symfony\Component\Validator\Contraints as Assert;

class RegistrationType extends AbstractType { 

	public function getName() { 
		return 'registration';
	}

	public function buildForm(FormBuilderInterface $form, array $options) { 
		$builder->add('username', 'text', array(
			'contraints' => new Assert\NotBlank()
		))->add('email', 'email', array(
			'contraints' => new Assert\NotBlank()
		))
		->add('password', 'repeated', array(
			'first_name' => 'password', 
			'second_name' => 'confirm',
			'type' => 'password',
			'contraints' => new Assert\NotBlank()
		));

	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) { 
		$resolver->setDefaults(array(
			'data_class' => 'OpenDeviceLab\ApplicationBundle\Entity\User'
		));
	}
}
