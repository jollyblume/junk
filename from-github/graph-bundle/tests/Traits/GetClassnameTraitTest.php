<?php

namespace Tests\Traits;

use Jollyblume\Bundle\GraphBundle\Traits\GetClassnameTrait;

/**
 * GetClassnameTrait test
 */
class GetClassnameTraitTest extends \PHPUnit\Framework\TestCase
{
    use GetClassnameTrait;

    /**
     * Assert getClassname() must emit same string provided
     */
    public function testGetClassnameEmitsSameStringProvided()
    {
        $testClassname = 'TEST_CLASSNAME';
        $this->assertEquals($testClassname, $this->getClassname($testClassname), 'getClassname() must emit same string provided');
    }

    /**
     * Assert getClassname() must emit classname for object provided
     */
    public function testGetClassnameEmitsClassnameForObjectProvided()
    {
        $testObject = new class {
        };
        $testClassname = get_class($testObject);

        $this->assertEquals($testClassname, $this->getClassname($testObject), 'getClassname() must emit classname for object provided');
    }
}
