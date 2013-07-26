<?php 
namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Contraints as Assert;

class RegistrationType extends UserType { 

	public function getName() { 
		return 'registration';
	}

	public function buildForm(FormBuilderInterface $builder, array $options) { 
		parent::buildForm($builder, $options); 

		$builder->remove('roles');

	}

}
