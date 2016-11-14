<?php

namespace Lv\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lv\LibraryBundle\Entity\Traits\SoftDeleteableTrait;
use Lv\LibraryBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Book
 *
 * @ORM\Table(name="Book")
 * @ORM\Entity(repositoryClass="Lv\LibraryBundle\Repository\BookRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Book
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
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Lv\LibraryBundle\Entity\Author")
     * @ORM\JoinColumn(name="authorId", referencedColumnName="id",unique=false)
     */
    private $author;


    /**
     * @var int
     *
     * @ORM\Column(name="countPages", type="integer")
     *
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $countPages;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="smallint")
     *
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $year;


    /**
     * @ORM\ManyToMany(targetEntity="Lv\LibraryBundle\Entity\Genre")
     * @ORM\JoinTable(name="BookGenres",
     *      joinColumns={@ORM\JoinColumn(name="bookId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="genreId", referencedColumnName="id", unique=false)}
     *      )
     */
    private $bookGenres;

    /////////////////////////////////////////////////////////


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookGenres = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Book
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
     * Set countPages
     *
     * @param integer $countPages
     *
     * @return Book
     */
    public function setCountPages($countPages)
    {
        $this->countPages = $countPages;

        return $this;
    }

    /**
     * Get countPages
     *
     * @return integer
     */
    public function getCountPages()
    {
        return $this->countPages;
    }

    /**
     * Set dateWriting
     *
     * @param integer $dateWriting
     *
     * @return Book
     */
    public function setDateWriting($dateWriting)
    {
        $this->dateWriting = $dateWriting;

        return $this;
    }

    /**
     * Get dateWriting
     *
     * @return integer
     */
    public function getDateWriting()
    {
        return $this->dateWriting;
    }

    /**
     * Set author
     *
     * @param \Lv\LibraryBundle\Entity\Author $author
     *
     * @return Book
     */
    public function setAuthor(\Lv\LibraryBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Lv\LibraryBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add bookGenre
     *
     * @param \Lv\LibraryBundle\Entity\Genre $bookGenre
     *
     * @return Book
     */
    public function addBookGenre(\Lv\LibraryBundle\Entity\Genre $bookGenre)
    {
        $this->bookGenres[] = $bookGenre;

        return $this;
    }

    /**
     * Remove bookGenre
     *
     * @param \Lv\LibraryBundle\Entity\Genre $bookGenre
     */
    public function removeBookGenre(\Lv\LibraryBundle\Entity\Genre $bookGenre)
    {
        $this->bookGenres->removeElement($bookGenre);
    }

    /**
     * Get bookGenres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookGenres()
    {
        return $this->bookGenres;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }
}
