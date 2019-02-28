<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\EmailReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait EmailReferrersTrait
{
    /**
     * @var Collection
     */
    private $emailReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getEmailReferrersFromStore()
    {
        $emailReferrers = $this->emailReferrers;
        if (null === $emailReferrers) {
            $emailReferrers = new ArrayCollection();
            $this->emailReferrers = $emailReferrers;
        }

        return $emailReferrers;
    }

    /**
     * Get the EmailReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getEmailReferrers()
    {
        $emailReferrers = $this->getEmailReferrersFromStore();

        return new ReadOnlyCollectionWrapper($emailReferrers);
    }

    private function assertEmailReferrerNotExists(EmailReferencesInterface $referrer) {
        if ($this->hasEmailReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteEmailReference(EmailReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a EmailReferencesInterface.
     *
     * @param EmailReferencesInterface
     *
     * @throws EmailReferencesInterface
     *
     * @return self
     */
    public function addEmailReferrer(EmailReferencesInterface $referrer)
    {
        $this->assertEmailReferrerNotExists($referrer);

        $emailReferrers = $this->getEmailReferrersFromStore();
        $emailReferrers->add($referrer);

        $this->setRemoteEmailReference($referrer);

        return $this;
    }

    private function unsetRemoteEmailReference(EmailReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a EmailReferencesInterface.
     *
     * @param EmailReferencesInterface
     *
     * @return self
     */
    public function removeEmailReferrer(EmailReferencesInterface $referrer)
    {
        if ($this->hasEmailReferrer($referrer)) {
            $emailReferrers = $this->getEmailReferrersFromStore();
            $emailReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemoteEmailReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a EmailReferencesInterface exists.
     *
     * @param EmailReferencesInterface
     *
     * @return bool
     */
    public function hasEmailReferrer(EmailReferencesInterface $referrer)
    {
        $emailReferrers = $this->getEmailReferrersFromStore();

        return $emailReferrers->contains($referrer);
    }
}
