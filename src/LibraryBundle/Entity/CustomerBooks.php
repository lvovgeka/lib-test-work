<?php

namespace Lv\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lv\LibraryBundle\Entity\Traits\SoftDeleteableTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use Lv\LibraryBundle\Entity\Traits\TimestampableTrait;
use JMS\Serializer\Annotation as Serializer;

/**
 * CustomerBooks
 *
 * @ORM\Table(name="CustomerBooks")
 * @ORM\Entity(repositoryClass="Lv\LibraryBundle\Repository\CustomerBooksRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class CustomerBooks
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
     * @ORM\ManyToOne(targetEntity="Lv\LibraryBundle\Entity\Customer", inversedBy="books")
     * @ORM\JoinColumn(name="customerId", referencedColumnName="id")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="Lv\LibraryBundle\Entity\LibraryBooks")
     * @ORM\JoinColumn(name="libBookId", referencedColumnName="id")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     * @Serializer\SerializedName("libBook")
     *
     */
    private $libBook;

    /**
     * @ORM\Column(name="readedAt", type="datetime", nullable=true)
     * @Serializer\Groups({
     *     "details",
     *     "list",
     * })
     *
     */
    private $readedAt = null;


    /////////////////////////////////////////////////////////


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
     * Set readedAt
     *
     * @param \DateTime $readedAt
     *
     * @return CustomerBooks
     */
    public function setReadedAt($readedAt)
    {
        $this->readedAt = $readedAt;

        return $this;
    }

    /**
     * Get readedAt
     *
     * @return \DateTime
     */
    public function getReadedAt()
    {
        return $this->readedAt;
    }

    /**
     * Set customer
     *
     * @param \Lv\LibraryBundle\Entity\Customer $customer
     *
     * @return CustomerBooks
     */
    public function setCustomer(\Lv\LibraryBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Lv\LibraryBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set libBook
     *
     * @param \Lv\LibraryBundle\Entity\LibraryBooks $libBook
     *
     * @return CustomerBooks
     */
    public function setLibBook(\Lv\LibraryBundle\Entity\LibraryBooks $libBook = null)
    {
        $this->libBook = $libBook;

        return $this;
    }

    /**
     * Get libBook
     *
     * @return \Lv\LibraryBundle\Entity\LibraryBooks
     */
    public function getLibBook()
    {
        return $this->libBook;
    }
}
