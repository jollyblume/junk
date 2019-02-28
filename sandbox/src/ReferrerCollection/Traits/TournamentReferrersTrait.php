<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\TournamentReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TournamentReferrersTrait
{
    /**
     * @var Collection
     */
    private $tournamentReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getTournamentReferrersFromStore()
    {
        $tournamentReferrers = $this->tournamentReferrers;
        if (null === $tournamentReferrers) {
            $tournamentReferrers = new ArrayCollection();
            $this->tournamentReferrers = $tournamentReferrers;
        }

        return $tournamentReferrers;
    }

    /**
     * Get the TournamentReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getTournamentReferrers()
    {
        $tournamentReferrers = $this->getTournamentReferrersFromStore();

        return new ReadOnlyCollectionWrapper($tournamentReferrers);
    }

    private function assertTournamentReferrerNotExists(TournamentReferencesInterface $referrer) {
        if ($this->hasTournamentReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteTournamentReference(TournamentReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a TournamentReferencesInterface.
     *
     * @param TournamentReferencesInterface
     *
     * @throws TournamentReferencesInterface
     *
     * @return self
     */
    public function addTournamentReferrer(TournamentReferencesInterface $referrer)
    {
        $this->assertTournamentReferrerNotExists($referrer);

        $tournamentReferrers = $this->getTournamentReferrersFromStore();
        $tournamentReferrers->add($referrer);

        $this->setRemoteTournamentReference($referrer);

        return $this;
    }

    private function unsetRemoteTournamentReference(TournamentReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a TournamentReferencesInterface.
     *
     * @param TournamentReferencesInterface
     *
     * @return self
     */
    public function removeTournamentReferrer(TournamentReferencesInterface $referrer)
    {
        if ($this->hasTournamentReferrer($referrer)) {
            $tournamentReferrers = $this->getTournamentReferrersFromStore();
            $tournamentReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemoteTournamentReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a TournamentReferencesInterface exists.
     *
     * @param TournamentReferencesInterface
     *
     * @return bool
     */
    public function hasTournamentReferrer(TournamentReferencesInterface $referrer)
    {
        $tournamentReferrers = $this->getTournamentReferrersFromStore();

        return $tournamentReferrers->contains($referrer);
    }
}
