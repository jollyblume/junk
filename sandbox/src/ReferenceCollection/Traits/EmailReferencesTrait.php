<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\EmailReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait EmailReferencesTrait
{
    /**
     * @var Collection
     */
    private $emailReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getEmailReferencesFromStore()
    {
        $emailReferences = $this->emailReferences;
        if (null === $emailReferences) {
            $emailReferences = new ArrayCollection();
            $this->emailReferences = $emailReferences;
        }

        return $emailReferences;
    }

    /**
     * Get the EmailReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getEmailReferences()
    {
        $emailReferences = $this->getEmailReferencesFromStore();

        return new ReadOnlyCollectionWrapper($emailReferences);
    }

    private function assertEmailReferenceNotExists(EmailReferrersInterface $reference) {
        if ($this->hasEmailReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteEmailReferrer(EmailReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a EmailReferrersInterface.
     *
     * @param EmailReferrersInterface
     *
     * @return self
     */
    public function addEmailReference(EmailReferrersInterface $reference)
    {
        $this->assertEmailReferenceNotExists($reference);

        $references = $this->getEmailReferencesFromStore();
        $references->add($reference);

        $this->setRemoteEmailReferrer($reference);

        return $this;
    }

    private function unsetRemoteEmailReferrer(EmailReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a EmailReferrersInterface.
     *
     * @param EmailReferrersInterface
     *
     * @return self
     */
    public function removeEmailReference(EmailReferrersInterface $reference)
    {
        if ($this->hasEmailReference($reference)) {
            $references = $this->getEmailReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemoteEmailReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a EmailReferrersInterface exists.
     *
     * @param EmailReferrersInterface
     *
     * @return bool
     */
    public function hasEmailReference(EmailReferrersInterface $reference)
    {
        $references = $this->getEmailReferencesFromStore();

        return $references->contains($reference);
    }
}
