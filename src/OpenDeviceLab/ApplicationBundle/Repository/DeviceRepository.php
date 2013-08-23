<?php

namespace OpenDeviceLab\ApplicationBundle\Repository;


use \Doctrine\ORM\EntityRepository;
use OpenDeviceLab\ApplicationBundle\Entity\Device;

class DeviceRepository extends EntityRepository { 

	public function getAvailable($alias='d'){

		$qb =  $this->createQueryBuilder($alias);

		return $qb->where("$alias.status != :s AND $alias.status != :s0 and $alias.status != :s1")
			->setParameter('s', Device::STATUS_WANTED)
			->setParameter('s0', Device::STATUS_DISABLED)
			->setParameter('s1', Device::STATUS_DONATED);
	}

	public function getWanted ($alias='d') { 

		$qb =  $this->createQueryBuilder($alias);

		return $qb->where("$alias.status = :s")
			->setParameter('s', Device::STATUS_WANTED);
	}
}
