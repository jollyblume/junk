<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\LeagueReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait LeagueReferencesTrait
{
    /**
     * @var Collection
     */
    private $leagueReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getLeagueReferencesFromStore()
    {
        $leagueReferences = $this->leagueReferences;
        if (null === $leagueReferences) {
            $leagueReferences = new ArrayCollection();
            $this->leagueReferences = $leagueReferences;
        }

        return $leagueReferences;
    }

    /**
     * Get the LeagueReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getLeagueReferences()
    {
        $leagueReferences = $this->getLeagueReferencesFromStore();

        return new ReadOnlyCollectionWrapper($leagueReferences);
    }

    private function assertLeagueReferenceNotExists(LeagueReferrersInterface $reference) {
        if ($this->hasLeagueReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteLeagueReferrer(LeagueReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a LeagueReferrersInterface.
     *
     * @param LeagueReferrersInterface
     *
     * @return self
     */
    public function addLeagueReference(LeagueReferrersInterface $reference)
    {
        $this->assertLeagueReferenceNotExists($reference);

        $references = $this->getLeagueReferencesFromStore();
        $references->add($reference);

        $this->setRemoteLeagueReferrer($reference);

        return $this;
    }

    private function unsetRemoteLeagueReferrer(LeagueReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a LeagueReferrersInterface.
     *
     * @param LeagueReferrersInterface
     *
     * @return self
     */
    public function removeLeagueReference(LeagueReferrersInterface $reference)
    {
        if ($this->hasLeagueReference($reference)) {
            $references = $this->getLeagueReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemoteLeagueReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a LeagueReferrersInterface exists.
     *
     * @param LeagueReferrersInterface
     *
     * @return bool
     */
    public function hasLeagueReference(LeagueReferrersInterface $reference)
    {
        $references = $this->getLeagueReferencesFromStore();

        return $references->contains($reference);
    }
}
