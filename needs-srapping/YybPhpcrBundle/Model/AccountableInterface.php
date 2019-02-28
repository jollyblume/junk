<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Model;

interface AccountableInterface
{
    /**
     * Get the document creation date
     *
     * @return \DateTime Document creation datetime
     */
    public function getCreated();

    /**
     * Set the document creation date
     *
     * @param \DateTime $created Document creation datetime
     * @return self
     */
    public function setCreated(\DateTime $created);

    /**
     * Get the document's creator
     *
     * @return string Document's creator
     */
    public function getCreatedBy ();

    /**
     * Set the document's creator
     *
     * @param string $createdBy Document's creator
     * @return self
     */
    public function setCreatedBy($createdBy);

    /**
     * Get the document's last modified date
     *
     * @return \DateTime Document's last modified datetime
     */
    public function getLastModified();

    /**
     * Set the document's last modified date
     *
     * @param \DateTime $lastModified Document's last modified datetime
     * @return self
     */
    public function setLastModified(\DateTime $lastModified);

    /**
     * Get the user who last modified the document
     *
     * @return string
     */
    public function getLastModifiedBy();

    /**
     * Set the user who last modified the document
     *
     * @param type $lastModifiedBy User who last modified the document
     * @return self
     */
    public function setLastModifiedBy($lastModifiedBy);
}
