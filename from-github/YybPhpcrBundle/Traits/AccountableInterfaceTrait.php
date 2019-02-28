<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};

trait AccountableInterfaceTrait
{
    /**
     * DateTime when the document was created
     *
     * @var \DateTime $created DateTime when the document was created
     * @PHPCR\Field(type="date", property="jcr:created")
     */
    private $created;

    /**
     * User who created the document
     *
     * This will always be admin (or the PHPCR connection's user)
     *
     * @var string $createdBy User who created the document
     * @PHPCR\Field(type="string", property="jcr:createdBy")
     */
    private $createdBy;

    /**
     * DateTime when document was modified
     *
     * @var \DateTime $lastModified DateTime when document was modified
     * @PHPCR\Field(type="date", property="jcr:lastModified")
     */
    private $lastModified;

    /**
     * User who last modified the document
     *
     * @var string $lastModifiedBy User who last modified the document
     * @PHPCR\Field(type="string", property="jcr:lastModifiedBy")
     */
    private $lastModifiedBy;

    /**
     * Get the document creation date
     *
     * @return \DateTime Document creation datetime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set the document creation date
     *
     * @param \DateTime $created Document creation datetime
     * @return self
     */
    public function setCreated(\DateTime $created) {
        $this->created = $created;
        return $this;
    }

    /**
     * Get the document's creator
     *
     * @return string Document's creator
     */
    public function getCreatedBy () {
        return $this->createdBy;
    }

    /**
     * Set the document's creator
     *
     * @param string $createdBy Document's creator
     * @return self
     */
    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get the document's last modified date
     *
     * @return \DateTime Document's last modified datetime
     */
    public function getLastModified() {
        return $this->lastModified;
    }

    /**
     * Set the document's last modified date
     *
     * @param \DateTime $lastModified Document's last modified datetime
     * @return self
     */
    public function setLastModified(\DateTime $lastModified) {
        $this->lastModified = $lastModified;
        return $this;
    }

    /**
     * Get the user who last modified the document
     *
     * @return string
     */
    public function getLastModifiedBy() {
        return $this->lastModifiedBy;
    }

    /**
     * Set the user who last modified the document
     *
     * @param type $lastModifiedBy User who last modified the document
     * @return self
     */
    public function setLastModifiedBy($lastModifiedBy) {
        $this->lastModifiedBy = $lastModifiedBy;
        return $this;
    }
}
