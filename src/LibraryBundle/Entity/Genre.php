<?php

namespace Lv\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Genre
 *
 * @ORM\Table(name="Genre")
 * @ORM\Entity(repositoryClass="Lv\LibraryBundle\Repository\GenreRepository")
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $name;

    /**
     * @ORM\Column(name="alias", type="string")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $alias;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Genre
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

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Genre
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
