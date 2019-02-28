<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\PlayerReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait PlayerReferencesTrait
{
    /**
     * @var Collection
     */
    private $playerReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getPlayerReferencesFromStore()
    {
        $playerReferences = $this->playerReferences;
        if (null === $playerReferences) {
            $playerReferences = new ArrayCollection();
            $this->playerReferences = $playerReferences;
        }

        return $playerReferences;
    }

    /**
     * Get the PlayerReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getPlayerReferences()
    {
        $playerReferences = $this->getPlayerReferencesFromStore();

        return new ReadOnlyCollectionWrapper($playerReferences);
    }

    private function assertPlayerReferenceNotExists(PlayerReferrersInterface $reference) {
        if ($this->hasPlayerReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemotePlayerReferrer(PlayerReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a PlayerReferrersInterface.
     *
     * @param PlayerReferrersInterface
     *
     * @return self
     */
    public function addPlayerReference(PlayerReferrersInterface $reference)
    {
        $this->assertPlayerReferenceNotExists($reference);

        $references = $this->getPlayerReferencesFromStore();
        $references->add($reference);

        $this->setRemotePlayerReferrer($reference);

        return $this;
    }

    private function unsetRemotePlayerReferrer(PlayerReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a PlayerReferrersInterface.
     *
     * @param PlayerReferrersInterface
     *
     * @return self
     */
    public function removePlayerReference(PlayerReferrersInterface $reference)
    {
        if ($this->hasPlayerReference($reference)) {
            $references = $this->getPlayerReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemotePlayerReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a PlayerReferrersInterface exists.
     *
     * @param PlayerReferrersInterface
     *
     * @return bool
     */
    public function hasPlayerReference(PlayerReferrersInterface $reference)
    {
        $references = $this->getPlayerReferencesFromStore();

        return $references->contains($reference);
    }
}
