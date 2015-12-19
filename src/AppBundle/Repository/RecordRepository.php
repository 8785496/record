<?php

namespace AppBundle\Repository;

/**
 * RecordRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecordRepository extends \Doctrine\ORM\EntityRepository
{
    public function getFirst10(){
        $qb = $this->createQueryBuilder('r')
            ->setMaxResults(10)
            ->orderBy('r.score', 'DESC');
        return $qb->getQuery()->getArrayResult();
    }

    public function getMyFirst10($username){
        $qb = $this->createQueryBuilder('r')
            ->join('AppBundle:User', 'u', 'WITH', 'u.id = r.userId')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->setMaxResults(10)
            ->orderBy('r.score', 'DESC');
        return$qb->getQuery()->getArrayResult();
    }
}
