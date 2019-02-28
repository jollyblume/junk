<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
<<<<<<< HEAD
use App\Document\RootNode;
use App\Document\EmailTree;
use App\Document\PlayerBag;
use App\Document\PlayerNode;
=======
>>>>>>> move-collection-to-children
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
}
