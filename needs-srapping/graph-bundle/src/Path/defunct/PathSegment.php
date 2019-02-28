
<?php
namespace Jollyblume\Bundle\GraphBundle\Path;

use Jollyblume\Bundle\GraphBundle\Model\PathSegmentInterface;
use Jollyblume\Bundle\GraphBundle\Model\PathInterface;
use Jollyblume\Bundle\GraphBundle\Model\PathTargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Model\PathCollection;
use Jollyblume\Bundle\GraphBundle\Model\NodeInterface;
use Jollyblume\Bundle\GraphBundle\Traits\ErrorsTrait;

class PathSegment implements PathSegmentInterface
{
    use ErrorsTrait;

    /**
     * @var PathInterface $parentPath
     */
    private $parentPath;

    /**
     * @var int $segmentIndex
     */
    private $segmentIndex;

    /**
     * @var string $segmentFilter
     */
    private $segmentFilter;

    /**
     * @var PathTargetCollectionInterface $segmentPaths
     */
    private $segmentPaths;

    /**
     * @param PathInterface $parentPath
     * @param int $segmentPathsIndex
     */
    public function __construct(PathInterface $parentPath, int $segmentIndex, string $segmentFilter)
    {
        $this->parentPath = $parentPath;
        $this->segmentIndex = $segmentIndex;
        $this->segmentFilter = $segmentFilter;

        $this->segmentPaths = new PathCollection();
    }

    /**
    * @return PathInterface The original parentPath
    */
    public function getParentPath() : PathInterface
    {
        $parentPath = $this->parentPath;
        return $parentPath;
    }

    /**
     * @return int Original pathSegment index from the parentPath
     */
    public function getSegmentIndex() : int
    {
        $segmentIndex = $this->segmentIndex;
        return $segmentIndex;
    }

    /**
    * @return string Original pathSegment filter from the parentPath
    */
    public function getSegmentFilter() : string
    {
        $segmentFilter = $this->segmentFilter;
        return $segmentFilter;
    }

    /**
     * @return PathTargetCollectionInterface Internal transformation results
     */
    public function getSegmentPaths() : PathTargetCollectionInterface
    {
        $segmentPaths = $this->segmentPaths;
        return $segmentPaths;
    }

    /**
     * @return NodeInterface|NULL Previous pathSegment's sinkNode or NULL if unknown
     */
    public function getSegmentSourceNode() : ?NodeInterface
    {
        $parentPath = $this->getParentPath();
        $prevPathSegmentIndex = $this->getSegmentIndex() - 1;
        $prevPathSegment = $parentPath->getPathSegment($prevPathSegmentIndex);
        $sourceNode = $prevPathSegment->getSegmentSinkNode();

        return $sourceNode;
    }

    /**
     * @return NodeInterface|NULL Next pathSegment's sourceNode or NULL if unknown
     */
    public function getSegmentSinkNode() : ?NodeInterface
    {
        $segmentPaths = $this->getSegmentPaths();

        $isValid = $this->isValid();
        $hasSinkNode = 1 === count($segmentPaths);
        if (!$isValid || !$hasSinkNode) {
            return null;
        }

        /** todo: find the sinkNode in the segment data (if single path in collection, path[-1]->getPathSinkNode()) */

        $lastPathSegment = $segmentPaths[-1];
        return $lastPathSegment->getSegmentSinkNode();
    }

    /**
     * @return True if pathSegment is valid (fully transformed)
     */
    public function isValid()
    {
        $errors = $this->getErrors();
        if (!empty($errors)) {
            return false;
        }

        $segmentPaths = $this->getSegmentPaths();
        foreach ($segmentPaths as $path) {
            if (!$path->isValid()) {
                return false;
            }
        }

        return true;
    }

    //
    // \Countable
    //

    /**
     * @return int count of elements in getPathCollection()
     */
    public function count() : int
    {
        $segmentPaths = $this->getSegmentPaths();
        return count($segmentPaths);
    }

    //
    // \ArrayAccess
    //

    /**
     * @param mixed $offset
     * @return bool getPathCollection()->offsetExists()
     */
    public function offsetExists($offset) : bool
    {
        $segmentPaths = $this->getSegmentPaths();
        return $segmentPaths->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed getPathCollection()->offsetGet()
     */
    public function offsetGet($offset)
    {
        $segmentPaths = $this->getSegmentPaths();
        return $segmentPaths->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return mixed getPathCollection()->offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        $segmentPaths = $this->getSegmentPaths();
        return $segmentPaths->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return mixed getPathCollection()->offsetUnset()
     */
    public function offsetUnset($offset)
    {
        $segmentPaths = $this->getSegmentPaths();
        return $segmentPaths->offsetUnset($offset);
    }

    //
    // \IteratorAggregate
    //

    /**
     * @return \Traversable
     */
    public function getIterator() : \Traversable
    {
        $segmentPaths = $this->getSegmentPaths();
        return new \ArrayIterator($segmentPaths);
    }
}
