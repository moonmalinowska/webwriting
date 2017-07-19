<?php
/**
 * Created by PhpStorm.
 * User: monika
 * Date: 16.07.17
 * Time: 18:48
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Rating;
use Doctrine\ORM\EntityRepository;

/**
 * Class RatingRepository
 *
 * @package AppBundle\Repository
 *
 */
class RatingRepository extends EntityRepository
{
    /**
     * Query all entities.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function queryAll()
    {
        return $this->createQueryBuilder('rating');
    }

    /**
     * Save rating.
     *
     * @param Rating $rating Rating entity
     */
    public function save(Rating $rating)
    {
        $this->_em->persist($rating);
        $this->_em->flush();
    }

    /**
     * Delete Rating.
     *
     * @param Rating $rating Rating entity
     */
    public function delete(Rating $rating)
    {
        $this->_em->remove($rating);
        $this->_em->flush();
    }

}