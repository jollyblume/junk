<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\TeamReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TeamReferrersTrait
{
    /**
     * @var Collection
     */
    private $teamReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getTeamReferrersFromStore()
    {
        $teamReferrers = $this->teamReferrers;
        if (null === $teamReferrers) {
            $teamReferrers = new ArrayCollection();
            $this->teamReferrers = $teamReferrers;
        }

        return $teamReferrers;
    }

    /**
     * Get the TeamReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getTeamReferrers()
    {
        $teamReferrers = $this->getTeamReferrersFromStore();

        return new ReadOnlyCollectionWrapper($teamReferrers);
    }

    private function assertTeamReferrerNotExists(TeamReferencesInterface $referrer) {
        if ($this->hasTeamReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteTeamReference(TeamReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a TeamReferencesInterface.
     *
     * @param TeamReferencesInterface
     *
     * @throws TeamReferencesInterface
     *
     * @return self
     */
    public function addTeamReferrer(TeamReferencesInterface $referrer)
    {
        $this->assertTeamReferrerNotExists($referrer);

        $teamReferrers = $this->getTeamReferrersFromStore();
        $teamReferrers->add($referrer);

        $this->setRemoteTeamReference($referrer);

        return $this;
    }

    private function unsetRemoteTeamReference(TeamReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a TeamReferencesInterface.
     *
     * @param TeamReferencesInterface
     *
     * @return self
     */
    public function removeTeamReferrer(TeamReferencesInterface $referrer)
    {
        if ($this->hasTeamReferrer($referrer)) {
            $teamReferrers = $this->getTeamReferrersFromStore();
            $teamReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemoteTeamReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a TeamReferencesInterface exists.
     *
     * @param TeamReferencesInterface
     *
     * @return bool
     */
    public function hasTeamReferrer(TeamReferencesInterface $referrer)
    {
        $teamReferrers = $this->getTeamReferrersFromStore();

        return $teamReferrers->contains($referrer);
    }
}
