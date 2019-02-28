<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\LocationReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait LocationReferrersTrait
{
    /**
     * @var Collection
     */
    private $locationReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getLocationReferrersFromStore()
    {
        $locationReferrers = $this->locationReferrers;
        if (null === $locationReferrers) {
            $locationReferrers = new ArrayCollection();
            $this->locationReferrers = $locationReferrers;
        }

        return $locationReferrers;
    }

    /**
     * Get the LocationReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getLocationReferrers()
    {
        $locationReferrers = $this->getLocationReferrersFromStore();

        return new ReadOnlyCollectionWrapper($locationReferrers);
    }

    private function assertLocationReferrerNotExists(LocationReferencesInterface $referrer) {
        if ($this->hasLocationReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteLocationReference(LocationReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a LocationReferencesInterface.
     *
     * @param LocationReferencesInterface
     *
     * @throws LocationReferencesInterface
     *
     * @return self
     */
    public function addLocationReferrer(LocationReferencesInterface $referrer)
    {
        $this->assertLocationReferrerNotExists($referrer);

        $locationReferrers = $this->getLocationReferrersFromStore();
        $locationReferrers->add($referrer);

        $this->setRemoteLocationReference($referrer);

        return $this;
    }

    private function unsetRemoteLocationReference(LocationReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a LocationReferencesInterface.
     *
     * @param LocationReferencesInterface
     *
     * @return self
     */
    public function removeLocationReferrer(LocationReferencesInterface $referrer)
    {
        if ($this->hasLocationReferrer($referrer)) {
            $locationReferrers = $this->getLocationReferrersFromStore();
            $locationReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemoteLocationReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a LocationReferencesInterface exists.
     *
     * @param LocationReferencesInterface
     *
     * @return bool
     */
    public function hasLocationReferrer(LocationReferencesInterface $referrer)
    {
        $locationReferrers = $this->getLocationReferrersFromStore();

        return $locationReferrers->contains($referrer);
    }
}
