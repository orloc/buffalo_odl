<?php

namespace OpenDeviceLab\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This Entity is responsible for user appointments
 *
 * @ORM\Entity()
 * @ORM\Table(name="appointments")
 */

class Appointment { 
    
    const STATUS_CONFIRMED  = 1,
          STATUS_PENDING    = 2;   

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start_time;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end_time;

    /** 
     * @ORM\OneToMany(targetEntity="Device", mappedBy="reserved")
     */
    private $device;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="appointments")
     */
    private $user;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->device = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set status
     *
     * @param integer $status
     * @return Appointment
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
     * Set start_time
     *
     * @param \DateTime $startTime
     * @return Appointment
     */
    public function setStartTime($startTime)
    {
        $this->start_time = $startTime;
    
        return $this;
    }

    /**
     * Get start_time
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Set end_time
     *
     * @param \DateTime $endTime
     * @return Appointment
     */
    public function setEndTime($endTime)
    {
        $this->end_time = $endTime;
    
        return $this;
    }

    /**
     * Get end_time
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    
    /**
     * Set user
     *
     * @param \OpenDeviceLab\ApplicationBundle\Entity\User $user
     * @return Appointment
     */
    public function setUser(\OpenDeviceLab\ApplicationBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \OpenDeviceLab\ApplicationBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add device
     *
     * @param \OpenDeviceLab\ApplicationBundle\Entity\Device $device
     * @return Appointment
     */
    public function addDevice(\OpenDeviceLab\ApplicationBundle\Entity\Device $device)
    {
        $this->device[] = $device;
    
        return $this;
    }

    /**
     * Remove device
     *
     * @param \OpenDeviceLab\ApplicationBundle\Entity\Device $device
     */
    public function removeDevice(\OpenDeviceLab\ApplicationBundle\Entity\Device $device)
    {
        $this->device->removeElement($device);
    }

    /**
     * Get device
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDevices()
    {
        return $this->device;
    }
}
