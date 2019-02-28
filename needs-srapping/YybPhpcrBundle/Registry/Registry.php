<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Registry;

use YoYogaBear\Bundle\PhpcrBundle\Registry\
{
    RootNodeDefinition
};
use Doctrine\Common\Collections\
{
    ArrayCollection
};

class Registry
{
    /**
     * List of root nodes
     *
     *   [<service_id> => <rootNodeDefinition_instance>, ...]
     *
     * @var ArrayCollection $rootNodeDefinitions;
     */
    private $rootNodeDefinitions;

    public function __construct()
    {
        $this->rootNodeDefinitions = new ArrayCollection();
    }

    public function getRootNodeDefinitions()
    {
        return $this->rootNodeDefinitions;
    }

    public function addRootNodeDefinition(RootNodeDefinition $rootNodeDefinition, string $serviceId): self
    {
        $this->rootNodeDefinitions->set($serviceId, $rootNodeDefinition);
        return $this;
    }
}
