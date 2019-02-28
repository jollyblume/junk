<?php

namespace App\Document;

use App\Exception\PropImmutableException;

/**
 * PhpcrNodeInterface.
 *
 * Defines basic Phpcr Node requirements:
 *   - Nodename accessors
 *   - Id accessors
 *   - Parent accessors
 *
 * When a property is null, getters must return an acceptable value from an
 * appropriate sibling property.
 *
 * Similarly, setters must use sibling properties to constrain what value it
 * can set. Any value that can not be set due to a sibling constraint should
 * throw PropImmutableException.
 *
 * This behaviour allows the Node classes to function properly before being
 * persisted.
 *
 * NOTE: I often use "Node" and "Document" interchangably.
 */
interface PhpcrNodeInterface
{
    /**
     * Get the Phpcr Nodename.
     *
     * If Nodename is null, getNodename() returns a value generated from Id.
     *
     * If both Nodename and Id are null, getNodeName() returns ''.
     *
     * @return string TBest attempt Nodename
     */
    public function getNodename();

    /**
     * Get the Phpcr Id.
     *
     * If Id is null, getId() returns a value generated from Nodename
     * and Parent Id. sprintf('%s/%s', Nodename|'', ParentId|'')
     *
     * If all the sibliing properties are null, getId() returns '/'.
     *
     * @return string Best attempt Phpcr Id
     */
    public function getId();

    /**
     * Get the Parent Node.
     *
     * @return null|PhpcrNodeInterface
     */
    public function getParent();

    /**
     * Get the Id of the Phpcr Parent Node.
     *
     * If Parent is null, getParentId() returns a value generated from Id.
     *
     * @return string Phpcr Parent Node Id or ''
     */
    public function getParentId();

    /**
     * Set the Phpcr Nodename.
     *
     * @throws PropImmutableException If Nodename or Id all ready set
     *
     * @return self
     */
    public function setNodename(string $nodename);

    /**
     * Set the Phpcr Id.
     *
     * @throws PropImmutableException If any sibling properties are set
     *
     * @return self
     */
    public function setId(string $identifier);

    /**
     * Set the Phpcr Parent.
     *
     * @throws PropImmutableException If Parent or Id all ready set
     *
     * @return self
     */
    public function setParent(PhpcrNodeInterface $parentNode);

    /**
     * Move Node to another Child and/or rename Node.
     *
     * @param PhpcrChildrenInterface
     * @param string
     *
     * @return self
     */
    public function moveNode(?PhpcrChildrenInterface $newParent = null, ?string $newNodename = null);
}
