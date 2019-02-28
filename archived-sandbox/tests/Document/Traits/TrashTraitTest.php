<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\TrashTrait;

class TrashTraitTest extends TestCase
{
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(TrashTrait::class);
        return $trait;
    }

    public function testIsBagTrashTrue()
    {
        $trait = $this->buildMockForTrait();
        $this->assertTrue($trait->isBagTrash());
    }
}
