<?php

namespace Lv\LibraryBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Gedmo\Mapping\Annotation as Gedmo;

trait SoftDeleteableTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     * @Serializer\SerializedName("deletedAt")
     * @Serializer\Groups({
     *     "topicsTree",
     *     "delete"
     * })
     */
    protected $deletedAt;

    /**
     * Sets $deletedAt.
     *
     * @param \Datetime|null $deletedAt
     *
     * @return $this
     */
    public function setDeletedAt(\DateTime $deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Returns deletedAt.
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Is deleted?
     *
     * @return bool
     */
    public function isDeleted()
    {
        return null !== $this->deletedAt;
    }

}
