<?php
namespace OpenDeviceLab\AdminBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends BaseUserType { 

	public function getName() {
		return 'user';
	}

	public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder, $options);

        $builder->add('username', 'text', array(
				'constraints' => new Assert\NotBlank()
			))
            ->add('roles', 'choice', array(
				'choices' => array(
					'ROLE_USER' => 'User',
					'ROLE_ADMIN' => 'Admin',
					'ROLE_SUPER_ADMIN' => 'Super Admin'
				),
				'constraints' => new Assert\NotBlank(),
				'data' => 'ROLE_USER'
			))
			->add('password', 'repeated', array(
				'first_name' => 'password', 
				'second_name' => 'confirm',
				'type' => 'password',
				'required' => false,
			));
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) { 
		$resolver->setDefaults(array(
			'data_class' => 'OpenDeviceLab\ApplicationBundle\Entity\User'
		));
	}
}
