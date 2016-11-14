<?php

namespace Lv\LibraryBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass()
 */
trait TimestampableTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     * @Serializer\SerializedName("createdAt")
     * @Serializer\Groups({
     *     "details",
     *     "list",
     *     "topicsTree",
     *     "create"
     * })
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     * @Serializer\SerializedName("updatedAt")
     * @Serializer\Groups({
     *     "topicsTree",
     *     "update"
     * })
     */
    protected $updatedAt;

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
