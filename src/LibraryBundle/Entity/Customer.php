<?php

namespace Lv\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lv\LibraryBundle\Entity\Traits\SoftDeleteableTrait;
use Lv\LibraryBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * Customer
 *
 * @ORM\Table(
 *     name="Customer",
 *     indexes={
 *          @ORM\Index(name="search", columns={"firstName", "lastName", "middleName"}, flags={"fulltext"}),
 *     }
 * )
 * @ORM\Entity(repositoryClass="Lv\LibraryBundle\Repository\CustomerRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Customer
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
     * @ORM\Column(name="firstName", type="string")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     * @Serializer\SerializedName("firstName")
     */
    private $firstName;

    /**
     * @ORM\Column(name="lastName", type="string", nullable=true)
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     * @Serializer\SerializedName("lastName")
     */
    private $lastName;

    /**
     * @ORM\Column(name="middleName", type="string", nullable=true)
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     * @Serializer\SerializedName("middleName")
     */
    private $middleName;


    /**
     * @ORM\OneToMany(targetEntity="Lv\LibraryBundle\Entity\CustomerBooks", mappedBy="customer")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $books;

    /**
     * @ORM\ManyToOne(targetEntity="Lv\LibraryBundle\Entity\Library", inversedBy="customers")
     * @ORM\JoinColumn(name="libraryId", referencedColumnName="id")
     */
    private $library;

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("name")
     * @Serializer\Groups({
     *     "details",
     *     "list"
     * })
     */
    public function getName(){
        return $this->getFirstName() . ' ' . $this->getLastName() . ' ' . $this->getMiddleName();
    }


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
     * Constructor
     */
    public function __construct()
    {
        $this->custumer = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add custumer
     *
     * @param \Lv\LibraryBundle\Entity\Customer $custumer
     *
     * @return Customer
     */
    public function addCustumer(\Lv\LibraryBundle\Entity\Customer $custumer)
    {
        $this->custumer[] = $custumer;

        return $this;
    }

    /**
     * Remove custumer
     *
     * @param \Lv\LibraryBundle\Entity\Customer $custumer
     */
    public function removeCustumer(\Lv\LibraryBundle\Entity\Customer $custumer)
    {
        $this->custumer->removeElement($custumer);
    }

    /**
     * Get custumer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustumer()
    {
        return $this->custumer;
    }

    /**
     * Add book
     *
     * @param \Lv\LibraryBundle\Entity\CustomerBooks $book
     *
     * @return Customer
     */
    public function addBook(\Lv\LibraryBundle\Entity\CustomerBooks $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \Lv\LibraryBundle\Entity\CustomerBooks $book
     */
    public function removeBook(\Lv\LibraryBundle\Entity\CustomerBooks $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * Set library
     *
     * @param \Lv\LibraryBundle\Entity\Library $library
     *
     * @return Customer
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

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * Set middleName
     *
     * @param string $middleName
     *
     * @return Customer
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }
}
