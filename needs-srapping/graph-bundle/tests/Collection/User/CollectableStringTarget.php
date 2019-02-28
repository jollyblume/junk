<?php

namespace Tests\Collection\User;

use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;

class CollectableStringTarget implements CollectableTargetInterface
{
    /**
     * @var string $targetKey
     */
    private $targetKey;

    public function __construct(string $targetKey)
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
