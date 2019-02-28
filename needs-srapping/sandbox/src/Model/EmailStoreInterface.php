<?php

namespace App\Model;
use App\Model\StoreInterface;

interface EmailStoreInterface extends StoreInterface {
    public function addEmailNode(EmailInterface $node);

    public function hasEmailNode(EmailInterface $node);

    public function hasEmailName(string $nodename);

    public function removeEmailNode(EmailInterface $node);

    public function removeEmailName(string $nodename);

    public function getEmailNode(string $nodename);

    public function setEmailNode(string $nodename, EmailInterface $node);
}
