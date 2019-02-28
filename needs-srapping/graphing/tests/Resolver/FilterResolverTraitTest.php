<?php

namespace Jollyblume\Component\Tests\Graphing\Resolver;

use Jollyblume\Component\Graphing\Resolver\FilterResolverInterface;
use Jollyblume\Component\Graphing\Resolver\FilterResolverTrait;

/** @SuppressWarnings(methods) */
class FilterResolverTraitTest extends \PHPUnit\Framework\TestCase
{
    protected function getUser()
    {
        $user = new class implements FilterResolverInterface {
            use FilterResolverTrait;
        };
        return $user;
    }

    public function testEmptyKnownTokensEmitsNoSelectedTokens()
    {
        $user = $this->getUser();
        $unknownTokens = [];
        $this->assertEquals(
            [],
            $user->partitionFilter('blueToken|redToken', [], $unknownTokens),
            '' // FIXME
        );
        return $unknownTokens;
    }

    /** @depends testEmptyKnownTokensEmitsNoSelectedTokens */
    public function testEmptyKnownTokensEmitsFilterTokensAsUnknownTokens(array $unknownTokens)
    {
        $this->assertEquals(
            ['blueToken', 'redToken'],
            $unknownTokens,
            '' // FIXME
        );
    }

    public function testUnknownRemoveRuleThrowsException()
    {
        $user = $this->getUser();

        try {
            $user->partitionFilter(
                '!badToken|!infamousToken|goodToken',
                ['badToken', 'sadToken']
            );
            $this->fail(''); // FIXME
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
    }

    public function testSelectedRemoveRuleAddedToUnknownTokens()
    {
        $user = $this->getUser();
        $unknownTokens = [];
        $user->partitionFilter(
            '!badToken|badToken',
            ['badToken', 'sadToken'],
            $unknownTokens
        );
        $this->assertEquals(
            ['badToken'],
            $unknownTokens,
            '' // FIXME
        );
    }
}
