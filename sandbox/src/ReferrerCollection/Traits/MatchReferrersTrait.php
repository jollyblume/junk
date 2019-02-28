<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\MatchReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait MatchReferrersTrait
{
    /**
     * @var Collection
     */
    private $matchReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getMatchReferrersFromStore()
    {
        $matchReferrers = $this->matchReferrers;
        if (null === $matchReferrers) {
            $matchReferrers = new ArrayCollection();
            $this->matchReferrers = $matchReferrers;
        }

        return $matchReferrers;
    }

    /**
     * Get the MatchReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getMatchReferrers()
    {
        $matchReferrers = $this->getMatchReferrersFromStore();

        return new ReadOnlyCollectionWrapper($matchReferrers);
    }

    private function assertMatchReferrerNotExists(MatchReferencesInterface $referrer) {
        if ($this->hasMatchReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteMatchReference(MatchReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a MatchReferencesInterface.
     *
     * @param MatchReferencesInterface
     *
     * @throws MatchReferencesInterface
     *
     * @return self
     */
    public function addMatchReferrer(MatchReferencesInterface $referrer)
    {
        $this->assertMatchReferrerNotExists($referrer);

        $matchReferrers = $this->getMatchReferrersFromStore();
        $matchReferrers->add($referrer);

        $this->setRemoteMatchReference($referrer);

        return $this;
    }

    private function unsetRemoteMatchReference(MatchReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a MatchReferencesInterface.
     *
     * @param MatchReferencesInterface
     *
     * @return self
     */
    public function removeMatchReferrer(MatchReferencesInterface $referrer)
    {
        if ($this->hasMatchReferrer($referrer)) {
            $matchReferrers = $this->getMatchReferrersFromStore();
            $matchReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemoteMatchReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a MatchReferencesInterface exists.
     *
     * @param MatchReferencesInterface
     *
     * @return bool
     */
    public function hasMatchReferrer(MatchReferencesInterface $referrer)
    {
        $matchReferrers = $this->getMatchReferrersFromStore();

        return $matchReferrers->contains($referrer);
    }
}
