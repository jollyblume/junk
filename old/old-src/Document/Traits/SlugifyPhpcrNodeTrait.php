<?php

namespace OldApp\Document\Traits;

use Cocur\Slugify\Slugify;

/**
 * PhpcrNodeTrait.
 *
 * Implements PhpcrNodeInterface setters.
 *
 * This implementation slugifies the Nodename when being set.
 */
trait SlugifyPhpcrNodeTrait
{
    use PrivateNodeTrait;

    /**
     * Set the Phpcr Nodename.
     *
     * The Nodename is slugified before being set.
     *
     * @throws PropImmutableException If Nodename or Id all ready set
     *
     * @return self
     */
    public function setNodename(string $nodename)
    {
        $slugger = new Slugify();
        $slug = $slugger->slugify($nodename);

        return $this->innerSetNodename($slug);
    }

    /**
     * Set the Phpcr Id.
     *
     * The Nodename portion of the Id is slugified before being set.
     *
     * @throws PropImmutableException If any sibling properties are set
     *
     * @return self
     */
    public function setId(string $identifier)
    {
        $parentId = $this->getParentFromId($identifier);
        $nodename = $this->getNodenameFromId($identifier);
        $slugger = new Slugify();
        $sluggedNodename = $slugger->slugify($nodename);
        $sluggedIdentifier = sprintf('%s/%s', $parentId, $sluggedNodename);

        return $this->innerSetId($sluggedIdentifier);
    }
}
