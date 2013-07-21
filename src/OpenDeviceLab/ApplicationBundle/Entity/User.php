<?php

namespace OpenDeviceLab\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * This Entity is responsible for devices
 *
 * @ORM\Entity()
 * @ORM\Table(name="addresses")
 */
class User implements UserInterface { 
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;

	/**
	* @ORM\Column(type="string, length=32, unique=true")
	*/
	private $username;

	/**
	* @ORM\Column(type="string, length=32")
	*/
	private $salt;
	
	/**
	* @ORM\Column(type="string, length=60, unique=true")
	*/
	private $email;

	private $devices; 

	/**
	* @ORM\Column(type="boolean")
	*/
	private $is_active;
	
	public function getUsername() { 
		return $this->username;
	}

	public function getSalt() { 
		return $this->salt;
	}

	public function getPassword() { 
		return $this->password;
	}

	public function getRoles() { 
		return array('ROLE_USER');
	}

	public function eraseCredentials() { 
	}

}
