<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\EmailStoreTrait;
use App\Collections\SemanticCollectioInterface;
use App\Model\EmailStoreInterface;
use App\Document\EmailBag;

trait PhpcrEmailStoreTrait {
    use EmailStoreTrait;

    /**
     * @var EmailStoreInterface
     * @PHPCR\Child
     */
    private $composedEmailBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return EmailStoreInterface
     */
    private function getEmailBagFromStore() {
        $bag = $this->composedEmailBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @return EmailStoreInterface
     */
    private function setEmailBagToStore(EmailStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedEmailBag = $bag;
        return $this;
    }
}
