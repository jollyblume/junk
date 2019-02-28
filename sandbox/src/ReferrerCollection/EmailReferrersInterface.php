<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\EmailReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface EmailReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from EmailInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getEmailReferrers();

    /**
     * Add a referrer from a EmailReferencesInterface.
     *
     * @param EmailReferencesInterface
     *
     * @return self
     */
    public function addEmailReferrer(EmailReferencesInterface $node);

    /**
     * Remove a referrer from a EmailReferencesInterface.
     *
     * @param EmailReferencesInterface
     *
     * @return self
     */
    public function removeEmailReferrer(EmailReferencesInterface $node);

    /**
     * Test if a referrer from a EmailInterface exists.
     *
     * @param EmailInterface
     *
     * @return bool
     */
    public function hasEmailReferrer(EmailInterface $node);
}
