<?php

namespace Tests\Collection\User;

use Tests\Collection\User\CollectableIntTarget;

/**
 * CollectableIntTarget testSuite
 */
class CollectableIntTargetTest extends \PHPUnit\Framework\TestCase
{
    public function testIntTargetGetCollectableTargetKeyEmitInt()
    {
        $target = new CollectableIntTarget(1);
        $this->assertEquals(
            1,
            $target->getCollectableTargetKey(),
            'getCollectableTargetKey() must emit (int) 1, when targetKey set to (int) 1'
        );
    }

    public function testIntTargetToStringEmitString()
    {
        $target = new CollectableIntTarget(1);
        $this->assertEquals(
            '1',
            $target->getCollectableTargetKey(),
            '__toString() must emit "1", when targetKey set to (int) 1'
        );
    }
}
