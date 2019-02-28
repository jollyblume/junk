<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    NodeInterface,
    HiddenChildInterface,
    RootNodeInterface,
    ArcNodeInterface,
    BranchNodeInterface
};
use PHPUnit\Framework\
{
    TestCase
};

abstract class TraitTestBase extends TestCase
{
    private $tempFileNames;
    private $rootNodes;

    protected function setup()
    {
        $this->tempFileNames = [];
        $this->rootNodes = [];
    }

    protected function teardown()
    {
        $tempFileNames = $this->tempFileNames;
        foreach ($tempFileNames as $tempFileName) {
            unlink($tempFileName);
        }

        $this->tempFileNames = null;
        $this->rootNodes = null;
    }

    /**
     * Creates and loads a mock class for testing interface and trait combinations
     * without requiring a concrete implementation.
     */
    protected function loadConcreteImplementation(array $interfaces, array $implements, array $traits, array $constructors, array $constructArgs): string
    {
        // Create a temporary file name
        $tempFileName = tempnam(sys_get_temp_dir(), 'ConcreteTrait.php');

        // Store temporary file name for teardown() to delete
        $this->tempFileNames[] = $tempFileName;

        // Remove '/tmp/Concrete.php' from temp file name (get unique string)
        $uniquePostfix = ltrim($tempFileName, sys_get_temp_dir() . 'ConcreteTrait.php');

        // Create unique class name
        $className = 'ConcreteTrait' . $uniquePostfix;

        // wtf heredoc syntax throwing php fatal?
        $classBody = "<?php";
        $classBody .= PHP_EOL . '';
        $classBody .= PHP_EOL . 'namespace YoYogaBear\Bundle\PhpcrBundle\Temp;';
        $classBody .= PHP_EOL . '';
        $classBody .= PHP_EOL . 'use YoYogaBear\Bundle\PhpcrBundle\Model\\';
        $classBody .= PHP_EOL . '{';
        $classBody .= PHP_EOL . sprintf('    %s', implode(',' . PHP_EOL . '    ', $interfaces));
        $classBody .= PHP_EOL . '};';
        $classBody .= PHP_EOL . 'use YoYogaBear\Bundle\PhpcrBundle\Traits\\';
        $classBody .= PHP_EOL . '{';
        $classBody .= PHP_EOL . sprintf('    %s', implode(',' . PHP_EOL . '    ', $traits));
        $classBody .= PHP_EOL . '};';
        $classBody .= PHP_EOL . '';
        $classBody .= PHP_EOL . sprintf('class %s implements %s', $className, implode(', ', $implements));
        $classBody .= PHP_EOL . '{';
        $classBody .= PHP_EOL . sprintf('    use %s;', implode(', ', $traits));
        $classBody .= PHP_EOL . '';
        $classBody .= PHP_EOL . sprintf('    public function __construct(%s)', implode(', ', $constructArgs));
        $classBody .= PHP_EOL . '    {';
        $classBody .= PHP_EOL . sprintf('        $this->%s;', implode(';' . PHP_EOL . '        $this->', $constructors));
        $classBody .= PHP_EOL . '    }';
        $classBody .= PHP_EOL . '}';

        // Write the class body to the temporary file
        $handle = fopen($tempFileName, 'w');
        fwrite($handle, $classBody);
        fclose($handle);

        // Include the class
        require_once $tempFileName;

        // Return the fully qualified class name
        $className = 'YoYogaBear\Bundle\PhpcrBundle\Temp\\' . $className;
        return $className;
    }

    protected function getRootNodeImplementation(string $identifier): RootNodeInterface
    {
        // Root nodes are singletons
        if (!array_key_exists($identifier, $this->rootNodes)) {
            // Interfaces used by a root node
            $interfaces = [
                'RootNodeInterface',
                'BranchNodeInterface',
                'LinkNodesInterface',
                'LinkableInterface',
            ];

            // Interfaces implemented by a root node
            $implements = [
                'RootNodeInterface',
                'LinkNodesInterface',
                'LinkableInterface',
            ];

            // Traits used by a root node
            $traits = [
                'RootNodeInterfaceTrait',
                'ChildNodesInterfaceTrait',
                'LinkNodesInterfaceTrait',
                'LinkableInterfaceTrait',
            ];

            // Trait constructors needing execution during __construct
            $constructors = [
                'nodeConstruct($identifier)',
                'childNodesConstruct()',
                'linkNodesConstruct()',
            ];

            // __construct arguments
            $constructArgs = [
                'string $identifier',
            ];

            // Load a concrete implementation of a root node
            $rootNodeClass = $this->loadConcreteImplementation($interfaces, $implements, $traits, $constructors, $constructArgs);

            // Create a new root node
            $rootNode = new $rootNodeClass($identifier);

            // Root nodes are singletons
            $this->rootNodes[$identifier] = $rootNode;
        }

        return $this->rootNodes[$identifier];
    }

    protected function createNodeImplementation(BranchNodeInterface $parentNode, string $nodename): NodeInterface
    {
        // Interfaces used by a node
        $interfaces = [
            'NodeInterface',
            'BranchNodeInterface',
        ];

        // Interfaces implemented by a node
        $implements = [
            'NodeInterface',
        ];

        // Traits used by root node
        $traits = [
            'NodeInterfaceTrait',
        ];

        // Trait constructors needing execution during __construct
        $constructors = [
            'nodeConstruct($parentNode, $nodename)',
        ];

        // __construct arguments
        $constructArgs = [
            'BranchNodeInterface $parentNode',
            'string $nodename',
        ];

        // Load a concrete implementation of a node
        $nodeClass = $this->loadConcreteImplementation($interfaces, $implements, $traits, $constructors, $constructArgs);

        // Create a new node
        $node = new $nodeClass($parentNode, $nodename);

        return $node;
    }

    protected function createHiddenNodeImplementation(BranchNodeInterface $parentNode, string $nodename): NodeInterface
    {
        // Interfaces used by a node
        $interfaces = [
            'NodeInterface',
            'BranchNodeInterface',
            'HiddenChildInterface',
        ];

        // Interfaces implemented by a node
        $implements = [
            'NodeInterface',
            'HiddenChildInterface',
        ];

        // Traits used by root node
        $traits = [
            'NodeInterfaceTrait',
        ];

        // Trait constructors needing execution during __construct
        $constructors = [
            'nodeConstruct($parentNode, $nodename)',
        ];

        // __construct arguments
        $constructArgs = [
            'BranchNodeInterface $parentNode',
            'string $nodename',
        ];

        // Load a concrete implementation of a node
        $nodeClass = $this->loadConcreteImplementation($interfaces, $implements, $traits, $constructors, $constructArgs);

        // Create a new node
        $node = new $nodeClass($parentNode, $nodename);

        return $node;
    }

    protected function createArcNodeImplementation(BranchNodeInterface $parentNode, string $nodename): ArcNodeInterface
    {
        // Interfaces used by an arc node
        $interfaces = [
            'ArcNodeInterface',
            'BranchNodeInterface',
            'RootNodeInterface',
        ];

        // Interfaces implemented by an arc node
        $implements = [
            'ArcNodeInterface',
        ];

        // Traits used by an arc node
        $traits = [
            'NodeInterfaceTrait',
            'LinkedRootNodeInterfaceTrait',
            'LinkableInterfaceTrait',
        ];

        // Trait constructors needing execution during __construct
        $constructors = [
            'nodeConstruct($parentNode, $nodename)',
        ];

        // __construct arguments
        $constructArgs = [
            'BranchNodeInterface $parentNode',
            'string $nodename',
        ];

        // Load a concrete implementation of an arc node
        $arcNodeClass = $this->loadConcreteImplementation($interfaces, $implements, $traits, $constructors, $constructArgs);

        // Create a new root node
        $arcNode = new $arcNodeClass($parentNode, $nodename);

        return $arcNode;
    }
}
