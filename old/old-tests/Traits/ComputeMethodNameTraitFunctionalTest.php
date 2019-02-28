<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\CalendarBag;

class ComputeMethodNameTraitFunctionalTest extends TestCase
{
    /**
     * @expectedException   \App\Exception\OutOfScopeException
     */
    public function testComputeMethodNameThrowsForInvalidTemplateName() {
        $bag = new CalendarBag();
        $bag->computeMethodName('notatemplatename');
    }

    public function testComputeMethodName() {
        $bag = new CalendarBag();
        $methodName = $bag->computeMethodName('addChild');
        $this->assertEquals('addCalendarNode', $methodName);
    }
}
