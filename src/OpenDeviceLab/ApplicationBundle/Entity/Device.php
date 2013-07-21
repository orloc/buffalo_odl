<?php
namespace OpenDeviceLab\ApplicationBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\ORM\Mapping as ORM;

/**
 * This Entity is responsible for devices
 *
 * @ORM\Entity()
 * @ORM\Table(name="addresses")
 */
class Device {

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

	protected $donated_by;

	/**
	* @ORM\Column(type="datetime")
	*/
	protected $created_at;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $status;
}
