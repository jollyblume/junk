<?php

namespace App\Model;
use App\Model\StoreInterface;
use App\Model\ParentNodeInterface;
use App\Model\CookieStoreInterface;

interface StoreInterface extends ParentNodeInterface, CookieStoreInterface {

}
