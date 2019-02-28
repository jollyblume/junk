<?php

namespace Tests\Collection\User;

use Tests\Collection\User\CollectableIntTarget;
use Tests\Collection\User\CollectableStringTarget;
use Tests\Collection\User\TargetCollection;

/**
 * TargetCollectionInterface estSuite
 */
class TargetCollectionTest extends \PHPUnit\Framework\TestCase
{
    private function getUnknownStringTarget()
    {
        return new CollectableStringTarget('keyUnknown');
    }

    private function getIntTargets()
    {
        $intTargets = [
            new CollectableIntTarget(1),
            new CollectableIntTarget(2),
            new CollectableIntTarget(3),
        ];
        return $intTargets;
    }

    private function getStringTargets()
    {
        $stringTargets = [
            new CollectableStringTarget('key3'),
            new CollectableStringTarget('key4'),
            new CollectableStringTarget('key5'),
        ];
        return $stringTargets;
    }

    private function getMixedTargetCollection()
    {
        $targetCollection = new TargetCollection();
        $targets = array_merge($this->getIntTargets(), $this->getStringTargets());
        $targetCollection->setCollectableTargets($targets);
        return $targetCollection;
    }

    public function testHasIntTarget()
    {
        $targetCollection = $this->getMixedTargetCollection();
        $this->assertTrue(
            $targetCollection->hasCollectableTarget(1),
            'hasCollectableTarget(1) must be TRUE when the intTarget exists in the collection'
        );
    }

    public function testHasStringTarget()
    {
        $targetCollection = $this->getMixedTargetCollection();
        $this->assertTrue(
            $targetCollection->hasCollectableTarget('key3'),
            'hasCollectableTarget("key3") must be TRUE when the stringTarget exists in the collection'
        );
    }

    public function testHasObjectTarget()
    {
        $targetCollection = $this->getMixedTargetCollection();
        $target = $targetCollection['key3'];
        $this->assertTrue(
            $targetCollection->hasCollectableTarget($target),
            'hasCollectableTarget(object) must be TRUE when the target object exists in the collection'
        );
    }

    public function testNotHasUnknownTargetKey()
    {
        $targetCollection = $this->getMixedTargetCollection();
        $target = $this->getUnknownStringTarget();
        $targetKey = $target->getCollectableTargetKey();
        $this->assertFalse(
            $targetCollection->hasCollectableTarget($targetKey),
            'hasCollectableTarget("keyUnknown") must be FALSE when the key does not exist in the collection'
        );
    }

    public function testNotHasUnknownTargetObject()
    {
        $targetCollection = $this->getMixedTargetCollection();
        $target = $this->getUnknownStringTarget();
        $this->assertFalse(
            $targetCollection->hasCollectableTarget($target),
            'hasCollectableTarget(object) must be FALSE when the target does not exist in the collection'
        );
    }
}
