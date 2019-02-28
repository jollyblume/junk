<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrReferencableNodeTrait;

class PhpcrReferencableNodeTraitTest extends TestCase {
    use PhpcrReferencableNodeTrait;

    public function testGetUuid() {
        $this->assertNull($this->getUuid());
    }
}
