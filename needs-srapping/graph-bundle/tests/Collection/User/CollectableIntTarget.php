<?php

namespace Tests\Collection\User;

use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;

class CollectableIntTarget implements CollectableTargetInterface
{
    /**
     * @var int $targetKey
     */
    private $targetKey;

    public function __construct(int $targetKey)
    {
        $this->targetKey = $targetKey;
    }

    /**
     * @return string Key in a TargetCollectionInterface
     */
    public function getCollectableTargetKey()
    {
        return $this->targetKey;
    }

    /**
     * @return strval(getCollectableTargetKey())
     */
    public function __toString()
    {
        return strval($this->getCollectableTargetKey());
    }
}
