<?php
/**
 * Created by PhpStorm.
 * User: monika
 * Date: 16.07.17
 * Time: 18:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Repository\RatingRepository;

/**
 * Class Rating.
 *
 * @package AppBundle\Rating
 *
 * @ORM\Table(
 *     name="ratings"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\RatingRepository"
 * )
 */
class Rating
{
    /**
     * Primary key.
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(
     *     name="created",
     *     type="datetime",
     *     nullable=false
     * )
     * @var \DateTime $created Created
     */
    protected $created;

    /**
     * Name.
     *
     * @var integer $name
     *
     * @ORM\Column(
     *     name="name",
     *     type="integer",
     *     nullable=false,
     * )
     * @Assert\NotBlank(groups={"rating-default"}, message = "Pole nie może zostać puste.")
     */
    protected $name;

    /**
     * Label.
     *
     * @var integer $label
     *
     * @ORM\Column(
     *     name="label",
     *     type="integer",
     *     nullable=false,
     * )
     * @Assert\NotBlank(groups={"rating-default"}, message = "Pole nie może zostać puste.")
     */
    protected $label;

    /**
     * Heading.
     *
     * @var integer $heading
     *
     * @ORM\Column(
     *     name="heading",
     *     type="integer",
     *     nullable=false,
     * )
     * @Assert\NotBlank(groups={"rating-default"}, message = "Pole nie może zostać puste.")
     */
    protected $heading;

    /**
     * Paragraph.
     *
     * @var integer $paragraph
     *
     * @ORM\Column(
     *     name="paragraph",
     *     type="integer",
     *     nullable=false,
     * )
     * @Assert\NotBlank(groups={"rating-default"}, message = "Pole nie może zostać puste.")
     */
    protected $paragraph;

    /**
     * Keyword.
     *
     * @var integer $keyword
     *
     * @ORM\Column(
     *     name="keyword",
     *     type="integer",
     *     nullable=false,
     * )
     * @Assert\NotBlank(groups={"rating-default"}, message = "Pole nie może zostać puste.")
     */
    protected $keyword;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->created= new \DateTime();
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
     * @param integer $name
     * @return Rating
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return integer
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set label
     *
     * @param integer $label
     * @return Rating
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return integer
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set heading
     *
     * @param integer $heading
     * @return Rating
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get heading
     *
     * @return integer
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set paragraph
     *
     * @param integer $paragraph
     * @return Rating
     */
    public function setParagraph($paragraph)
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    /**
     * Get paragraph
     *
     * @return integer
     */
    public function getParagraph()
    {
        return $this->paragraph;
    }

    /**
     * Set keyword
     *
     * @param integer $keyword
     * @return Rating
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return integer
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}