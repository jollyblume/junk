<?php

namespace OldApp\Util;

use Cocur\Slugify\Slugify;

class StringSlugger
{
    /**
     * Slugger.
     *
     * @var Slugify;
     */
    private $slugger;

    public function __construct()
    {
        $this->slugger = new Slugify();
    }

    /**
     * Slugify a string.
     *
     * @param string $needsSlugging
     *
     * @return string Slugified string
     */
    public function slugify(string $needsSlugging)
    {
        return $this->slugger->slugify($needsSlugging);
    }
}
