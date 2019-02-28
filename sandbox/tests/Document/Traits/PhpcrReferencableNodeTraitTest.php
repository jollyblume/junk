<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrReferenceableNodeTrait;

class PhpcrReferenceableNodeTraitTest extends TestCase {
    use PhpcrReferenceableNodeTrait;

    public function testGetUuid() {
        $this->assertNull($this->getUuid());
    }
}
