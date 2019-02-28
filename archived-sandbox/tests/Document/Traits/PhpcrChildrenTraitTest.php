<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrChildrenTrait;
use App\Document\PhpcrNodeInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PhpcrChildrenTraitTest extends TestCase
{
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(PhpcrChildrenTrait::class);
        return $trait;
    }

    public function testGetChildren()
    {
        $trait = $this->buildMockForTrait();
        $this->assertInstanceOf(ArrayCollection::class, $trait->getChildren());
    }
}
