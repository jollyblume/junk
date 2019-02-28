<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\TournamentReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TournamentReferencesTrait
{
    /**
     * @var Collection
     */
    private $tournamentReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getTournamentReferencesFromStore()
    {
        $tournamentReferences = $this->tournamentReferences;
        if (null === $tournamentReferences) {
            $tournamentReferences = new ArrayCollection();
            $this->tournamentReferences = $tournamentReferences;
        }

        return $tournamentReferences;
    }

    /**
     * Get the TournamentReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getTournamentReferences()
    {
        $tournamentReferences = $this->getTournamentReferencesFromStore();

        return new ReadOnlyCollectionWrapper($tournamentReferences);
    }

    private function assertTournamentReferenceNotExists(TournamentReferrersInterface $reference) {
        if ($this->hasTournamentReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteTournamentReferrer(TournamentReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a TournamentReferrersInterface.
     *
     * @param TournamentReferrersInterface
     *
     * @return self
     */
    public function addTournamentReference(TournamentReferrersInterface $reference)
    {
        $this->assertTournamentReferenceNotExists($reference);

        $references = $this->getTournamentReferencesFromStore();
        $references->add($reference);

        $this->setRemoteTournamentReferrer($reference);

        return $this;
    }

    private function unsetRemoteTournamentReferrer(TournamentReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a TournamentReferrersInterface.
     *
     * @param TournamentReferrersInterface
     *
     * @return self
     */
    public function removeTournamentReference(TournamentReferrersInterface $reference)
    {
        if ($this->hasTournamentReference($reference)) {
            $references = $this->getTournamentReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemoteTournamentReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a TournamentReferrersInterface exists.
     *
     * @param TournamentReferrersInterface
     *
     * @return bool
     */
    public function hasTournamentReference(TournamentReferrersInterface $reference)
    {
        $references = $this->getTournamentReferencesFromStore();

        return $references->contains($reference);
    }
}
