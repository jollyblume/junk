<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\EmailReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface EmailReferencesInterface extends ReferencesInterface
{
    /**
     * Get the EmailReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getEmailReferences();

    /**
     * Add a reference.
     *
     * @param EmailReferrersInterface
     *
     * @return self
     */
    public function addEmailReference(EmailReferrersInterface $node);

    /**
     * Remove a reference.
     *
     * @param EmailReferrersInterface
     *
     * @return self
     */
    public function removeEmailReference(EmailReferrersInterface $node);

    /**
     * Test if a reference exists.
     *
     * @param EmailReferrersInterface
     *
     * @return bool
     */
    public function hasEmailReference(EmailReferrersInterface $node);
}
