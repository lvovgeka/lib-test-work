<?php

namespace Lv\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lv\LibraryBundle\Entity\Traits\SoftDeleteableTrait;
use Lv\LibraryBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * LibraryBooks
 *
 * @ORM\Table(name="LibraryBooks")
 * @ORM\Entity(repositoryClass="Lv\LibraryBundle\Repository\LibraryBooksRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class LibraryBooks
{
    use SoftDeleteableTrait;
    use TimestampableTrait;

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
     * @ORM\ManyToOne(targetEntity="Lv\LibraryBundle\Entity\Book")
     * @ORM\JoinColumn(name="bookId", referencedColumnName="id")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="Lv\LibraryBundle\Entity\Library", inversedBy="books")
     * @ORM\JoinColumn(name="libraryId", referencedColumnName="id")
     */
    private $library;

    /**
     * @ORM\Column(name="count", type="integer", options={"unsigned"=true})
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $count = 0;

    ////////////////////////////////////////
    

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
     * Set count
     *
     * @param integer $count
     *
     * @return LibraryBooks
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set book
     *
     * @param \Lv\LibraryBundle\Entity\Book $book
     *
     * @return LibraryBooks
     */
    public function setBook(\Lv\LibraryBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \Lv\LibraryBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set library
     *
     * @param \Lv\LibraryBundle\Entity\Library $library
     *
     * @return LibraryBooks
     */
    public function setLibrary(\Lv\LibraryBundle\Entity\Library $library = null)
    {
        $this->library = $library;

        return $this;
    }

    /**
     * Get library
     *
     * @return \Lv\LibraryBundle\Entity\Library
     */
    public function getLibrary()
    {
        return $this->library;
    }
}
