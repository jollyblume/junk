<?php

namespace Jollyblume\Bundle\GraphBundle\Node;

trait ReferencableTrait
{
    /**
     * @var string $uuid
     */
    private $uuid;

    /**
     * @return string The UUID
     */
    public function getUuid() : string
    {
        $uuid = $this->uuid;
        return is_string($uuid) ? $uuid : '';
    }
}
