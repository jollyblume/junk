<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrReferencableTrait;

class PhpcrReferencableTraitTest extends TestCase
{
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(PhpcrReferencableTrait::class);
        return $trait;
    }

    public function testGetUuidIfNull()
    {
        $trait = $this->buildMockForTrait();
        $this->assertNull($trait->getUuid());
    }

    public function testGetUuidIfSet()
    {
        $this->markTestSkipped('Uuid can only be set on the backend');
    }
}
