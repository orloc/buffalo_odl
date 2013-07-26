<?php
namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType { 

	public function getName() {
		return 'user';
	}

	public function buildForm(FormBuilderInterface $builder) {

		$builder->add('username', 'text', array(
				'contraints' => new Assert\NotBlank()
			))
			->add('first_name', 'text', array(
				'constraints' => new Assert\NotBlack()
			))
			->add('last_name', 'text', array(
				'constraints' => new Assert\NotBlank()
			))
			->add('email', 'email', array(
				'contraints' => new Assert\NotBlank()
			))
			->add('roles', 'choice', array(
				'choices' => array(
					'ROLE_USER',
					'ROLE_ADMIN',
					'ROLE_SUPER_ADMIN'
				),
				'constraints' => new Assert\NotBlank()
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
