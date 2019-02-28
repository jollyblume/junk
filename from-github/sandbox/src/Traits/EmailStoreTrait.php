<?php

namespace App\Traits;
use App\Model\EmailInterface;
use App\Model\EmailStoreInterface;
use App\Document\EmailBag;

trait EmailStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return EmailStoreInterface
     */
    abstract protected function getEmailBagFromStore();

    abstract protected function setEmailBagToStore(EmailStoreInterface $bag);

    private function getOrCreateEmailBag() {
        $bag = $this->getEmailBagFromStore();
        if (null === $bag) {
            $newBag = new EmailBag();
            $newBag->setNodename($newBag->getSemanticNodeType());
            $this->setEmailNodes($newBag);
            $bag = $this->getEmailBagFromStore();
        }
        return $bag;
    }

    public function getEmailNodes() {
        return $this->getOrCreateEmailBag();
    }

    public function setEmailNodes(EmailStoreInterface $bag) {
        $this->setEmailBagToStore($bag);
        return $this;
    }

    public function addEmailNode(EmailInterface $node) {
        $bag = $this->getOrCreateEmailBag();
        return $bag->addEmailNode($node);
    }

    public function hasEmailNode(EmailInterface $node) {
        $bag = $this->getOrCreateEmailBag();
        return $bag->hasEmailNode($node);
    }

    public function hasEmailName(string $nodename) {
        $bag = $this->getOrCreateEmailBag();
        return $bag->hasEmailName($nodename);
    }

    public function removeEmailNode(EmailInterface $node) {
        $bag = $this->getOrCreateEmailBag();
        return $bag->removeEmailNode($node);
    }

    public function removeEmailName(string $nodename) {
        $bag = $this->getOrCreateEmailBag();
        return $bag->removeEmailName($nodename);
    }

    public function getEmailNode(string $nodename) {
        $bag = $this->getOrCreateEmailBag();
        return $bag->getEmailNode($nodename);
    }

    public function setEmailNode(string $nodename, EmailInterface $node) {
        $bag = $this->getOrCreateEmailBag();
        return $bag->setEmailNode($nodename, $node);
    }
}
