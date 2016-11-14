<?php

namespace Lv\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lv\LibraryBundle\Entity\Traits\SoftDeleteableTrait;
use Lv\LibraryBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Author
 *
 * @ORM\Table(name="Author")
 * @ORM\Entity(repositoryClass="Lv\LibraryBundle\Repository\AuthorRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Author
{
    use SoftDeleteableTrait;
    use TimestampableTrait;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;


    /////////////////////////////////////////////////////////


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
     * @return Author
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
