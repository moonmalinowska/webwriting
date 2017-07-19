<?php
/**
 * Data fixtures for categories.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCategoryData.
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadCategoryData extends AbstractFixture implements ContainerAwareInterface
{
    /**
     * Service container.
     *
     * @var \Symfony\Component\DependencyInjection\ContainerInterface|null $container
     */
    protected $container = null;

    /**
     * Set container.
     *
     * @param ContainerInterface|null $container Service container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            'Sztuka',
            'Biznes i przemysł',
            'Kariera i edukacja',
            'Komputery i elektronika',
            'Hazard',
            'Gry',
            'Zdrowie i uroda',
            'Dom i ogród',
            'Internet i telekomunikacja',
            'Prawo i rząd',
            'Wiadomości i media',
            'Ludzie i społeczeństwo',
            'Hobby i rekreacja',
            'Nauka',
            'Zakupy',
            'Sport',
            'Podróże',
            'Dla dorosłych',
        ];

        foreach ($data as $item) {
            $category = new Category();
            $category>setName($item);
            $manager->persist($category);
        }
        $manager->flush();
    }

}