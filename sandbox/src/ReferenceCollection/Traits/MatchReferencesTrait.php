<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\MatchReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait MatchReferencesTrait
{
    /**
     * @var Collection
     */
    private $matchReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getMatchReferencesFromStore()
    {
        $matchReferences = $this->matchReferences;
        if (null === $matchReferences) {
            $matchReferences = new ArrayCollection();
            $this->matchReferences = $matchReferences;
        }

        return $matchReferences;
    }

    /**
     * Get the MatchReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getMatchReferences()
    {
        $matchReferences = $this->getMatchReferencesFromStore();

        return new ReadOnlyCollectionWrapper($matchReferences);
    }

    private function assertMatchReferenceNotExists(MatchReferrersInterface $reference) {
        if ($this->hasMatchReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteMatchReferrer(MatchReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a MatchReferrersInterface.
     *
     * @param MatchReferrersInterface
     *
     * @return self
     */
    public function addMatchReference(MatchReferrersInterface $reference)
    {
        $this->assertMatchReferenceNotExists($reference);

        $references = $this->getMatchReferencesFromStore();
        $references->add($reference);

        $this->setRemoteMatchReferrer($reference);

        return $this;
    }

    private function unsetRemoteMatchReferrer(MatchReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a MatchReferrersInterface.
     *
     * @param MatchReferrersInterface
     *
     * @return self
     */
    public function removeMatchReference(MatchReferrersInterface $reference)
    {
        if ($this->hasMatchReference($reference)) {
            $references = $this->getMatchReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemoteMatchReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a MatchReferrersInterface exists.
     *
     * @param MatchReferrersInterface
     *
     * @return bool
     */
    public function hasMatchReference(MatchReferrersInterface $reference)
    {
        $references = $this->getMatchReferencesFromStore();

        return $references->contains($reference);
    }
}
