<?php

namespace Tests\Validation\User;

use Tests\Validation\User\CollectableStringTargetWithErrors;

/**
 * CollectableStringTarget with ErrorsInterface testSuite
 *
 * @SuppressWarnings(methods)
 */
class CollectableStringTargetWithErrorsTest extends \PHPUnit\Framework\TestCase
{
    public function testNoErrorsForNewTarget()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $this->assertFalse(
                $target->hasErrors(),
                'hasErrors() must be FALSE for a new CollectableStringTargetWithErrors'
            );
    }

    public function testAddErrorIsFluent()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $fluentTarget = $target->addError([]);
        $this->assertEquals(
            $fluentTarget,
            $target->addError('test error message'),
            'hasErrors() must be FALSE after addError([])'
        );
    }

    public function testNotHasErrorsAfterAddEmptyArray()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError([]);
        $this->assertFalse(
            $target->hasErrors(),
            'hasErrors() must be FALSE after addError([])'
        );
    }

    public function testNotHasErrorsAfterAddEmptyString()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError('');
        $this->assertFalse(
            $target->hasErrors(),
            'hasErrors() must be FALSE after addError("")'
        );
    }

    public function testNotHasErrorsAfterAddEmptyInt()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError(0);
        $this->assertFalse(
            $target->hasErrors(),
            'hasErrors() must be FALSE after addError(0)'
        );
    }

    public function testNotHasErrorsAfterAddNull()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError(null);
        $this->assertFalse(
            $target->hasErrors(),
            'hasErrors() must be FALSE after addError(NULL)'
        );
    }

    public function testHasErrorsAfterAddArray()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError([
            'test error message',
            new \Exception('test exception'),
            404,
        ]);
        $this->assertTrue(
            $target->hasErrors(),
            'hasErrors() must be TRUE after addError([not-empty])'
        );
    }

    public function testHasErrorsAfterAddException()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError(new \Exception('test exception'));
        $this->assertTrue(
            $target->hasErrors(),
            'hasErrors() must be TRUE after addError(new \Exception())'
        );
    }

    public function testHasErrorsAfterAddInt()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError(404);
        $this->assertTrue(
            $target->hasErrors(),
            'hasErrors() must be TRUE after addError(404)'
        );
    }

    public function testHasErrorsAfterAddString()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError('test error message');
        $this->assertTrue(
            $target->hasErrors(),
            'hasErrors() must be TRUE after addError("test error message")'
        );
    }

    public function testNotHasErrorsAfterClear()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError('test error message');
        $target->clearErrors();
        $this->assertFalse(
            $target->hasErrors(),
            'hasErrors() must be FALSE after clearErrors()'
        );
    }

    public function testIsValidWithNoErrors()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $this->assertTrue(
            $target->isValid(),
            'isValid() must be TRUE for new CollectableStringTargetWithErrors'
        );
    }

    public function testNotIsValidAfterAddString()
    {
        $target = new CollectableStringTargetWithErrors('keyTest');
        $target->addError('test error message');
        $this->assertFalse(
            $target->isValid(),
            'isValid() must be FALSE after addError("test error message")'
        );
    }
}
