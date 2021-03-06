<?php

namespace AppBundle\Repository;

/**
 * ModelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ModelRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param integer $brandId
     * @param array $columns
     * @return mixed
     */
    public function findByBrandWithColumns($brandId, array $columns)
    {
        array_walk($columns, function (&$key) {
            $key = "model." . $key;
        });

        return $this->createQueryBuilder('model')
            ->select($columns)
            ->where('model.brandId = :brandId')
            ->setParameter('brandId', $brandId)
            ->getQuery()
            ->execute();
    }
}
