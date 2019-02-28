<?php

namespace Jollyblume\Bundle\GraphBundle\Node;

interface ReferencableInterface
{
    /**
     * @return string The UUID
     */
    public function getUuid() : string;
}
