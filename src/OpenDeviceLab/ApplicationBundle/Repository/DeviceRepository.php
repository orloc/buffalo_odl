<?php

namespace OpenDeviceLab\ApplicationBundle\Repository;


use \Doctrine\ORM\EntityRepository;
use OpenDeviceLab\ApplicationBundle\Entity\Device;

class DeviceRepository extends EntityRepository { 

	public function getAvailable(){

		$qb =  $this->createQueryBuilder('d');

		return $qb->where('d.status != :s')
			->setParameter('s', Device::STATUS_WANTED)
			->getQuery()
			->getResult();
	}

	public function getWanted () { 

		$qb =  $this->createQueryBuilder('d');

		return $qb->where('d.status = :s')
			->setParameter('s', Device::STATUS_WANTED)
			->getQuery()
			->getResult();
	}
}
