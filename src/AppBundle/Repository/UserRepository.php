<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    function findOneByUsername($username){
        return $this->findOneBy([
            'username' => $username
        ]);
    }

    function count(){
        $qb = $this->createQueryBuilder('u')->select('COUNT(u.id)');
        return $qb->getQuery()->getSingleScalarResult();
    }
}
