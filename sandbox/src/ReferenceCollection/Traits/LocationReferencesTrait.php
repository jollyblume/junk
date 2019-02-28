<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\LocationReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait LocationReferencesTrait
{
    /**
     * @var Collection
     */
    private $locationReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getLocationReferencesFromStore()
    {
        $locationReferences = $this->locationReferences;
        if (null === $locationReferences) {
            $locationReferences = new ArrayCollection();
            $this->locationReferences = $locationReferences;
        }

        return $locationReferences;
    }

    /**
     * Get the LocationReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getLocationReferences()
    {
        $locationReferences = $this->getLocationReferencesFromStore();

        return new ReadOnlyCollectionWrapper($locationReferences);
    }

    private function assertLocationReferenceNotExists(LocationReferrersInterface $reference) {
        if ($this->hasLocationReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteLocationReferrer(LocationReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a LocationReferrersInterface.
     *
     * @param LocationReferrersInterface
     *
     * @return self
     */
    public function addLocationReference(LocationReferrersInterface $reference)
    {
        $this->assertLocationReferenceNotExists($reference);

        $references = $this->getLocationReferencesFromStore();
        $references->add($reference);

        $this->setRemoteLocationReferrer($reference);

        return $this;
    }

    private function unsetRemoteLocationReferrer(LocationReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a LocationReferrersInterface.
     *
     * @param LocationReferrersInterface
     *
     * @return self
     */
    public function removeLocationReference(LocationReferrersInterface $reference)
    {
        if ($this->hasLocationReference($reference)) {
            $references = $this->getLocationReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemoteLocationReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a LocationReferrersInterface exists.
     *
     * @param LocationReferrersInterface
     *
     * @return bool
     */
    public function hasLocationReference(LocationReferrersInterface $reference)
    {
        $references = $this->getLocationReferencesFromStore();

        return $references->contains($reference);
    }
}
