<?php

namespace Tests\Collection\User;

use Tests\Collection\User\CollectableStringTarget;

/**
 * CollectableStringTarget testSuite
 */
class CollectableStringTargetTest extends \PHPUnit\Framework\TestCase
{
    public function testStringTargetGetCollectableTargetKeyEmitString()
    {
        $target = new CollectableStringTarget('testKey');
        $this->assertEquals(
            'testKey',
            $target->getCollectableTargetKey(),
            'getCollectableTargetKey() must emit string, when targetKey set to string'
        );
    }

    public function testStringTargetToStringEmitString()
    {
        $target = new CollectableStringTarget('testKey');
        $this->assertEquals(
            'testKey',
            $target->getCollectableTargetKey(),
            '__toString() must emit "1", when targetKey set to (int) 1'
        );
    }
}
