<?php

namespace Jollyblume\Component\Graphing\Node;

use Jollyblume\Component\Graphing\Node\NodeInterface;
use Jollyblume\Component\Graphing\ArcType\MetadataTrait;
use Jollyblume\Component\Graphing\Resolver\FilterResolverTrait;

class Node implements NodeInterface
{
    use MetadataTrait, FilterResolverTrait;

    /**
     * @var string $nodename
     */
    private $nodename;

    /**
     * Constructor
     *
     * @param string $nodename
     * @return void
     */
    public function __construct(string $nodename)
    {
        $this->nodename = $nodename;
    }

    /**
     * @return string
     */
    public function getNodename() : string
    {
        return $this->nodename;
    }
}
