<?php

namespace App\Model;
use App\Model\StoreInterface;

interface LocationStoreInterface extends StoreInterface {
    public function addLocationNode(LocationInterface $node);

    public function hasLocationNode(LocationInterface $node);

    public function hasLocationName(string $nodename);

    public function removeLocationNode(LocationInterface $node);

    public function removeLocationName(string $nodename);

    public function getLocationNode(string $nodename);

    public function setLocationNode(string $nodename, LocationInterface $node);
}
