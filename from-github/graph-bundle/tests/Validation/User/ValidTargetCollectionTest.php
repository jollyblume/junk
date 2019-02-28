<?php

namespace Tests\Validation\User;

use Tests\Validation\User\CollectableStringTargetWithErrors;
use Tests\Validation\User\ValidTargetCollection;
use Tests\Collection\User\CollectableStringTarget;

/**
 * TargetCollection with ValidityChainInterface with ErrorsInterface testSuite
 */
class ValidTargetCollectionTest extends \PHPUnit\Framework\TestCase
{
    private function getTargetWithNoErrors(string $targetKey)
    {
        return new CollectableStringTargetWithErrors($targetKey);
    }

    private function getTargetWithErrors(string $targetKey)
    {
        $target = new CollectableStringTargetWithErrors($targetKey);
        $target->addError('test error message');
        return $target;
    }

    private function getTargetWithNoErrorSupport(string $targetKey)
    {
        return new CollectableStringTarget($targetKey);
    }

    public function testIsValidForNewCollection()
    {
        $target = new ValidTargetCollection();
        $this->assertTrue(
            $target->isValid(),
            'isValid() must be TRUE for new ValidTargetCollection'
        );
    }

    public function testIsValidForValidChain()
    {
        $target = new ValidTargetCollection();
        $target
            ->addCollectableTarget($this->getTargetWithNoErrors('validKey1'))
            ->addCollectableTarget($this->getTargetWithNoErrorSupport('unsupportedKey2'))
            ->addCollectableTarget($this->getTargetWithNoErrors('validKey3'))
            ->addCollectableTarget($this->getTargetWithNoErrorSupport('unsupportedKey4'))
        ;

        $this->assertTrue(
            $target->isValid(),
            'isValid() must be TRUE for ValidTargetCollection with valid chain'
        );
    }

    public function testNotIsValidForInvalidChain()
    {
        $target = new ValidTargetCollection();
        $target
            ->addCollectableTarget($this->getTargetWithNoErrors('validKey1'))
            ->addCollectableTarget($this->getTargetWithNoErrorSupport('unsupportedKey2'))
            ->addCollectableTarget($this->getTargetWithNoErrors('validKey3'))
            ->addCollectableTarget($this->getTargetWithErrors('invalidKey4'))
            ->addCollectableTarget($this->getTargetWithNoErrorSupport('unsupportedKey5'))
        ;

        $this->assertFalse(
            $target->isValid(),
            'isValid() must be FALSE for ValidTargetCollection with invalid chain'
        );
    }

    public function testNotIsValidForValidChainAfterAddString()
    {
        $target = new ValidTargetCollection();
        $target
            ->addCollectableTarget($this->getTargetWithNoErrors('validKey1'))
            ->addCollectableTarget($this->getTargetWithNoErrorSupport('unsupportedKey2'))
            ->addCollectableTarget($this->getTargetWithNoErrors('validKey3'))
            ->addCollectableTarget($this->getTargetWithNoErrorSupport('unsupportedKey4'))
        ;
        $target->addError('test error message');

        $this->assertFalse(
            $target->isValid(),
            'isValid() must be FALSE for ValidTargetCollection with valid chain after addError("test error message")'
        );
    }
}
