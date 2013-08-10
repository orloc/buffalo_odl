<?php
namespace OpenDeviceLab\ApplicationBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\ORM\Mapping as ORM;

/**
 * This Entity is responsible for devices
 *
 * @ORM\Entity(repositoryClass="OpenDeviceLab\ApplicationBundle\Repository\DeviceRepository")
 * @ORM\Table(name="devices")
 */
class Device {

	const STATUS_AVAILABLE = 1,
		  STATUS_IN_USE = 2,
		  STATUS_WANTED = 3,
		  STATUS_DISABLED = 4;

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	
	/**
	* @ORM\Column(type="string")
	*/
	protected $manufacturer;

	/**
	* @ORM\Column(type="string")
	*/
	protected $model;

	/**
	* @ORM\Column(type="string")
	*/
	protected $operating_system;

	/**
	* @ORM\Column(type="string")
	*/
	protected $donated_by;

	/**
	* @ORM\Column(type="datetime")
	*/
	protected $created_at;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $status;


	public function __construct() { 
		$this->setCreatedAt(new \Datetime());
	}

	public function getNiceStatus(){ 
		switch($this->getStatus()){
			case 1: return 'Available';
			case 2: return 'In Use';
			case 3: return 'Wanted';
			case 4: return 'Disabled';
			default: return;
		}
	}

	//------------------------------------------------

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
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return Device
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    
        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Device
     */
    public function setModel($model)
    {
        $this->model = $model;
    
        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set operating_system
     *
     * @param string $operatingSystem
     * @return Device
     */
    public function setOperatingSystem($operatingSystem)
    {
        $this->operating_system = $operatingSystem;
    
        return $this;
    }

    /**
     * Get operating_system
     *
     * @return string 
     */
    public function getOperatingSystem()
    {
        return $this->operating_system;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Device
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Device
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set donated_by
     *
     * @param string $donatedBy
     * @return Device
     */
    public function setDonatedBy($donatedBy)
    {
        $this->donated_by = $donatedBy;
    
        return $this;
    }

    /**
     * Get donated_by
     *
     * @return string 
     */
    public function getDonatedBy()
    {
        return $this->donated_by;
    }
}