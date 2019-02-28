<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\TeamReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TeamReferencesTrait
{
    /**
     * @var Collection
     */
    private $teamReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getTeamReferencesFromStore()
    {
        $teamReferences = $this->teamReferences;
        if (null === $teamReferences) {
            $teamReferences = new ArrayCollection();
            $this->teamReferences = $teamReferences;
        }

        return $teamReferences;
    }

    /**
     * Get the TeamReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getTeamReferences()
    {
        $teamReferences = $this->getTeamReferencesFromStore();

        return new ReadOnlyCollectionWrapper($teamReferences);
    }

    private function assertTeamReferenceNotExists(TeamReferrersInterface $reference) {
        if ($this->hasTeamReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteTeamReferrer(TeamReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a TeamReferrersInterface.
     *
     * @param TeamReferrersInterface
     *
     * @return self
     */
    public function addTeamReference(TeamReferrersInterface $reference)
    {
        $this->assertTeamReferenceNotExists($reference);

        $references = $this->getTeamReferencesFromStore();
        $references->add($reference);

        $this->setRemoteTeamReferrer($reference);

        return $this;
    }

    private function unsetRemoteTeamReferrer(TeamReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a TeamReferrersInterface.
     *
     * @param TeamReferrersInterface
     *
     * @return self
     */
    public function removeTeamReference(TeamReferrersInterface $reference)
    {
        if ($this->hasTeamReference($reference)) {
            $references = $this->getTeamReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemoteTeamReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a TeamReferrersInterface exists.
     *
     * @param TeamReferrersInterface
     *
     * @return bool
     */
    public function hasTeamReference(TeamReferrersInterface $reference)
    {
        $references = $this->getTeamReferencesFromStore();

        return $references->contains($reference);
    }
}
