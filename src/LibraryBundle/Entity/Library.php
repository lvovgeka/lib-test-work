<?php

namespace Lv\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Library
 *
 * @ORM\Table(name="Library")
 * @ORM\Entity(repositoryClass="Lv\LibraryBundle\Repository\LibraryRepository")
 */
class Library
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
     * @ORM\Column(name="url", type="string")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="Lv\LibraryBundle\Entity\City")
     * @ORM\JoinColumn(name="cityId", referencedColumnName="id")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="Lv\LibraryBundle\Entity\LibraryBooks", mappedBy="library")
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity="Lv\LibraryBundle\Entity\Customer", mappedBy="library")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     */
    private $customers;

################################################

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
        $this->customers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Library
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
     * Set city
     *
     * @param \Lv\LibraryBundle\Entity\City $city
     *
     * @return Library
     */
    public function setCity(\Lv\LibraryBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Lv\LibraryBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add book
     *
     * @param \Lv\LibraryBundle\Entity\LibraryBooks $book
     *
     * @return Library
     */
    public function addBook(\Lv\LibraryBundle\Entity\LibraryBooks $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \Lv\LibraryBundle\Entity\LibraryBooks $book
     */
    public function removeBook(\Lv\LibraryBundle\Entity\LibraryBooks $book)
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
     * Add customer
     *
     * @param \Lv\LibraryBundle\Entity\Customer $customer
     *
     * @return Library
     */
    public function addCustomer(\Lv\LibraryBundle\Entity\Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    /**
     * Remove customer
     *
     * @param \Lv\LibraryBundle\Entity\Customer $customer
     */
    public function removeCustomer(\Lv\LibraryBundle\Entity\Customer $customer)
    {
        $this->customers->removeElement($customer);
    }

    /**
     * Get customers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Library
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
