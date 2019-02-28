<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Registry;

use YoYogaBear\Bundle\PhpcrBundle\Exception\
{
    YybPhpcrException
};

class RootNodeDefinition
{
    /**
     * @var string $classname
     */
    private $classname;

    /**
     * @var string $identifier
     */
    private $identifier;

    public function __construct(string $identifier, string $classname)
    {
        $reflectionClass = new \ReflectionClass($classname);
        if (!$reflectionClass->implementsInterface('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface')) {
            throw new YybPhpcrException(sprintf(
                '"%s" must implement "%s" in "%s"',
                $classname,
                'YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface',
                __METHOD__
            ));
        }

        $this->identifier = $identifier;
        $this->classname = $classname;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getClassName()
    {
        return $this->classname;
    }
}
