<?php
/**
 * Category repository.
 */
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CategoryRepository
 *
 * @package AppBundle\Repository
 * 
 */
class CategoryRepository extends EntityRepository
{
    /**
     * Query all entities.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function queryAll()
    {
        return $this->createQueryBuilder('category');
    }

    /**
     * Save entity.
     *
     * @param Category $category Category entity
     */
    public function save(Category $category)
    {
        $this->_em->persist($category);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Category $category Category entity
     */
    public function delete(Category $category)
    {
        $this->_em->remove($category);
        $this->_em->flush();
    }

    /**
     * Find Website By Category
     *
     * @param $website
     * @return array
     */
    public function getWebsitesByCategory($website){
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.website = :website_id')
            ->addOrderBy('c.name')
            ->setParameter('website_id', $website->getId());


        return $qb->getQuery()
            ->getResult();
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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



}
