<?php
/**
 * Website repository.
 */
namespace AppBundle\Repository;

use AppBundle\Entity\Website;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

/**
 * Class WebsiteRepository.
 *
 * @package AppBundle\Repository
 */
class WebsiteRepository extends EntityRepository
{
    /**
     * Gets all records paginated.
     *
     * @param int $page Page number
     *
     * @return \Pagerfanta\Pagerfanta Result
     */
    public function findAllPaginated($page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->queryAll(), false));
        $paginator->setMaxPerPage(Website::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    /**
     * Query all entities.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function queryAll()
    {
        return $this->createQueryBuilder('website');
    }

    /**
     * Save entity.
     *
     * @param Website $website Website entity
     */
    public function save(Website $website)
    {
        $this->_em->persist($website);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Website $website Website entity
     */
    public function delete(Website $website)
    {
        $this->_em->remove($website);
        $this->_em->flush();
    }

    /**
     * Get 10 lastest Website
     *
     * @param null
     * @return array
     */
    public function getLatestWebsites()
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->addOrderBy('b.id', 'DESC')
            ->setMaxResults(10);

        return $qb->getQuery()
            ->getResult();
    }


}