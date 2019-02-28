<?php

namespace Jollyblume\Bundle\GraphBundle\Node;

use Jollyblume\Bundle\GraphBundle\Node\SourceNodeInterface;
use Jollyblume\Bundle\GraphBundle\Node\SinkNodeInterface;
use Jollyblume\Bundle\GraphBundle\Metadata\ArcTypeMetadataInterface;
use Jollyblume\Bundle\GraphBundle\Collection\CollectableTargetInterface;

interface NodeInterface extends CollectableTargetInterface, SourceNodeInterface, SinkNodeInterface, ArcTypeMetadataInterface
{
    public function getNodename() : string;
}
