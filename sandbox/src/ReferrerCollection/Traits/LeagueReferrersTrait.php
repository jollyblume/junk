<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\LeagueReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait LeagueReferrersTrait
{
    /**
     * @var Collection
     */
    private $leagueReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getLeagueReferrersFromStore()
    {
        $leagueReferrers = $this->leagueReferrers;
        if (null === $leagueReferrers) {
            $leagueReferrers = new ArrayCollection();
            $this->leagueReferrers = $leagueReferrers;
        }

        return $leagueReferrers;
    }

    /**
     * Get the LeagueReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getLeagueReferrers()
    {
        $leagueReferrers = $this->getLeagueReferrersFromStore();

        return new ReadOnlyCollectionWrapper($leagueReferrers);
    }

    private function assertLeagueReferrerNotExists(LeagueReferencesInterface $referrer) {
        if ($this->hasLeagueReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteLeagueReference(LeagueReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a LeagueReferencesInterface.
     *
     * @param LeagueReferencesInterface
     *
     * @throws LeagueReferencesInterface
     *
     * @return self
     */
    public function addLeagueReferrer(LeagueReferencesInterface $referrer)
    {
        $this->assertLeagueReferrerNotExists($referrer);

        $leagueReferrers = $this->getLeagueReferrersFromStore();
        $leagueReferrers->add($referrer);

        $this->setRemoteLeagueReference($referrer);

        return $this;
    }

    private function unsetRemoteLeagueReference(LeagueReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a LeagueReferencesInterface.
     *
     * @param LeagueReferencesInterface
     *
     * @return self
     */
    public function removeLeagueReferrer(LeagueReferencesInterface $referrer)
    {
        if ($this->hasLeagueReferrer($referrer)) {
            $leagueReferrers = $this->getLeagueReferrersFromStore();
            $leagueReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemoteLeagueReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a LeagueReferencesInterface exists.
     *
     * @param LeagueReferencesInterface
     *
     * @return bool
     */
    public function hasLeagueReferrer(LeagueReferencesInterface $referrer)
    {
        $leagueReferrers = $this->getLeagueReferrersFromStore();

        return $leagueReferrers->contains($referrer);
    }
}
