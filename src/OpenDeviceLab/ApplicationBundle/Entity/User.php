<?php

namespace OpenDeviceLab\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * This Entity is responsible for devices
 *
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User implements UserInterface { 
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;

	/**
	* @ORM\Column(type="string", length=32)
	*/
	private $first_name;

	/**
	* @ORM\Column(type="string", length=32)
	*/
	private $last_name;

	/**
	* @ORM\Column(type="string", length=32, unique=true)
	*/
	private $username;

	/**
	* @ORM\Column(type="string", length=60)
	*/
	private $password;
	
	/**
	* @ORM\Column(type="string", length=60, unique=true)
	*/
	private $email;

	/** 
	* @ORM\Column(type="array") 
	*/
	private $roles;

	private $contributed_devices; 

    /**
    * @ORM\OneToMany(targetEntity="Appointment", mappedBy="user")
    */
    private $appointments;

	/**
	* @ORM\Column(type="boolean", nullable=true)
	*/
	private $is_active;
	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appointments = new \Doctrine\Common\Collections\ArrayCollection();
    }

	public function getUsername() { 
		return $this->username;
	}

	public function getSalt() { 
		return null;
	}

	public function getPassword() { 
		return $this->password;
	}

	public function getRoles() { 
		return is_array($this->roles) ? $this->roles : array();

	}

	public function eraseCredentials() { 
	}


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    
        return $this;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    
        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }
    
    /**
     * Add appointments
     *
     * @param \OpenDeviceLab\ApplicationBundle\Entity\Appointment $appointments
     * @return User
     */
    public function addAppointment(\OpenDeviceLab\ApplicationBundle\Entity\Appointment $appointments)
    {
        $this->appointments[] = $appointments;
    
        return $this;
    }

    /**
     * Remove appointments
     *
     * @param \OpenDeviceLab\ApplicationBundle\Entity\Appointment $appointments
     */
    public function removeAppointment(\OpenDeviceLab\ApplicationBundle\Entity\Appointment $appointments)
    {
        $this->appointments->removeElement($appointments);
    }

    /**
     * Get appointments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppointments()
    {
        return $this->appointments;
    }
}
