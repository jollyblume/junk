<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\PlayerReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait PlayerReferrersTrait
{
    /**
     * @var Collection
     */
    private $playerReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getPlayerReferrersFromStore()
    {
        $playerReferrers = $this->playerReferrers;
        if (null === $playerReferrers) {
            $playerReferrers = new ArrayCollection();
            $this->playerReferrers = $playerReferrers;
        }

        return $playerReferrers;
    }

    /**
     * Get the PlayerReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getPlayerReferrers()
    {
        $playerReferrers = $this->getPlayerReferrersFromStore();

        return new ReadOnlyCollectionWrapper($playerReferrers);
    }

    private function assertPlayerReferrerNotExists(PlayerReferencesInterface $referrer) {
        if ($this->hasPlayerReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemotePlayerReference(PlayerReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a PlayerReferencesInterface.
     *
     * @param PlayerReferencesInterface
     *
     * @throws PlayerReferencesInterface
     *
     * @return self
     */
    public function addPlayerReferrer(PlayerReferencesInterface $referrer)
    {
        $this->assertPlayerReferrerNotExists($referrer);

        $playerReferrers = $this->getPlayerReferrersFromStore();
        $playerReferrers->add($referrer);

        $this->setRemotePlayerReference($referrer);

        return $this;
    }

    private function unsetRemotePlayerReference(PlayerReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a PlayerReferencesInterface.
     *
     * @param PlayerReferencesInterface
     *
     * @return self
     */
    public function removePlayerReferrer(PlayerReferencesInterface $referrer)
    {
        if ($this->hasPlayerReferrer($referrer)) {
            $playerReferrers = $this->getPlayerReferrersFromStore();
            $playerReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemotePlayerReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a PlayerReferencesInterface exists.
     *
     * @param PlayerReferencesInterface
     *
     * @return bool
     */
    public function hasPlayerReferrer(PlayerReferencesInterface $referrer)
    {
        $playerReferrers = $this->getPlayerReferrersFromStore();

        return $playerReferrers->contains($referrer);
    }
}
