<?php

namespace OldApp\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\AbstractBag;
use Doctrine\Common\Collections\Selectable;

class AbstractBagTest extends TestCase
{
    public function testIsBagTrash() {
        $bag = $this->getMockForAbstractClass(AbstractBag::class);
        $this->assertFalse($bag->isBagTrash());
    }
}
