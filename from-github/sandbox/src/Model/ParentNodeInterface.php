<?php

namespace App\Model;

use App\Collections\ComposedCollectionInterface;

interface ParentNodeInterface extends NodeInterface, ComposedCollectionInterface
{
}
