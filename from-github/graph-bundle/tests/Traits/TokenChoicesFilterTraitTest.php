<?php

namespace Tests\Traits;

use Jollyblume\Bundle\GraphBundle\Traits\TokenChoicesFilterTrait;

/**
 * TokenChoicesFilterTrait testSuite
 * @SuppressWarnings(methods)
 */
class TokenChoicesFilterTraitTest extends \PHPUnit\Framework\TestCase
{
    use TokenChoicesFilterTrait;

    /**
     * Assert resolveTokenChoices() emits [] when no Token choices provided
     */
    public function testNoTokenChoicesProvidedEmitsEmptyArray()
    {
        $assertMessage = 'resolveTokenChoices() must emit [] when no Token choices provided';
        $filterString = 'redNosedToken|!goodToken';
        $tokenChoices = [];
        $selection    = [];

        $message = sprintf(
          "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
          $assertMessage,
          $filterString,
          implode(', ', $tokenChoices),
          implode(', ', $selection)
        );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits [] when invalid Token choices provided
     */
    public function testBadTokenChoicesProvidedEmitsEmptyArray()
    {
        $assertMessage = 'resolveTokenChoices() must emit [] when invalid Token choices provided';
        $filterString = '';
        $tokenChoices = ['goo!dToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = [];

        $message = sprintf(
                          "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                          $assertMessage,
                          $filterString,
                          implode(', ', $tokenChoices),
                          implode(', ', $selection)
                        );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits all tokenChoices when filterString empty
     */
    public function testEmptyFilterEmitsAllTokenChoices()
    {
        $assertMessage = 'resolveTokenChoices() must emit all tokenChoices when filterString empty';
        $filterString = '';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['goodToken', 'badToken', 'redToken', 'blueToken'];

        $message = sprintf(
              "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
              $assertMessage,
              $filterString,
              implode(', ', $tokenChoices),
              implode(', ', $selection)
            );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
    * Assert resolveTokenChoices() emits [] when unknownTokens in filterString
    */
    public function testUnknownInFilterEmitsEmptyArray()
    {
        $assertMessage = 'resolveTokenChoices() must emit [] when unknownTokens in filterString';
        $filterString = 'normalToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = [];

        $message = sprintf(
        "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
        $assertMessage,
        $filterString,
        implode(', ', $tokenChoices),
        implode(', ', $selection)
      );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
    * Assert resolveTokenChoices() emits [] competing select rules for knownToken provided
    */
    public function testKnownCompetingRulesProvidedEmitsEmptyArray()
    {
        $assertMessage = 'resolveTokenChoices() must emit [] when competing select rules for knownToken provided';
        $filterString = 'goodToken|!goodToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = [];

        $message = sprintf(
        "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
        $assertMessage,
        $filterString,
        implode(', ', $tokenChoices),
        implode(', ', $selection)
      );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when 1st selectToken selected
     */
    public function testFirstTokenSelectedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st selectToken selected';
        $filterString = 'goodToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['goodToken'];

        $message = sprintf(
                                  "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                  $assertMessage,
                                  $filterString,
                                  implode(', ', $tokenChoices),
                                  implode(', ', $selection)
                                );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when 2nd selectToken selected
     */
    public function testSecondTokenSelectedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st selectToken selected';
        $filterString = 'badToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['badToken'];

        $message = sprintf(
                                      "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                      $assertMessage,
                                      $filterString,
                                      implode(', ', $tokenChoices),
                                      implode(', ', $selection)
                                    );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when last selectToken selected
     */
    public function testLastTokenSelectedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st selectToken selected';
        $filterString = 'blueToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['blueToken'];

        $message = sprintf(
                                          "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                          $assertMessage,
                                          $filterString,
                                          implode(', ', $tokenChoices),
                                          implode(', ', $selection)
                                        );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when 1st selectToken removed
     */
    public function testFirstTokenRemovedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st selectToken removed';
        $filterString = '!goodToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['badToken', 'redToken', 'blueToken'];

        $message = sprintf(
                                      "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                      $assertMessage,
                                      $filterString,
                                      implode(', ', $tokenChoices),
                                      implode(', ', $selection)
                                    );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when 2nd selectToken removed
     */
    public function testSecondTokenRemovedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st selectToken removed';
        $filterString = '!badToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['goodToken', 'redToken', 'blueToken'];

        $message = sprintf(
                                          "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                          $assertMessage,
                                          $filterString,
                                          implode(', ', $tokenChoices),
                                          implode(', ', $selection)
                                        );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when last selectToken removed
     */
    public function testLastTokenRemovedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st selectToken removed';
        $filterString = '!blueToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['goodToken', 'badToken', 'redToken'];

        $message = sprintf(
                                              "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                              $assertMessage,
                                              $filterString,
                                              implode(', ', $tokenChoices),
                                              implode(', ', $selection)
                                            );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when 1st and 3rd selectToken selected
     */
    public function testFirstTokenSecondTokenSelectedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st and 3rd selectToken selected';
        $filterString = 'goodToken|redToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['goodToken', 'redToken'];

        $message = sprintf(
                                          "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                          $assertMessage,
                                          $filterString,
                                          implode(', ', $tokenChoices),
                                          implode(', ', $selection)
                                        );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results when 1st and 3rd selectToken removed
     */
    public function testFirstTokenSecondTokenRemovedEmitsExpectedResult()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results when 1st and 3rd selectToken removed';
        $filterString = '!goodToken|!redToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['badToken', 'blueToken'];

        $message = sprintf(
                                              "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                              $assertMessage,
                                              $filterString,
                                              implode(', ', $tokenChoices),
                                              implode(', ', $selection)
                                            );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results in tokenChoices order when 3rd and 1st selectToken selected
     */
    public function testSecondTokenFirstTokenSelectedEmitsTokenChoicesOrder()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results in tokenChoices order when when 3rd and 1st selectToken selectToken selected';
        $filterString = 'redToken|goodToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['goodToken', 'redToken'];

        $message = sprintf(
                                              "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                              $assertMessage,
                                              $filterString,
                                              implode(', ', $tokenChoices),
                                              implode(', ', $selection)
                                            );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }

    /**
     * Assert resolveTokenChoices() emits expected results in tokenChoices order when 3rd and 1st selectToken removed
     */
    public function testSecondTokenFirstTokenRemovedEmitsTokenChoicesOrder()
    {
        $assertMessage = 'resolveTokenChoices() must emit expected results in tokenChoices order when 3rd and 1st selectToken removed';
        $filterString = '!redToken|!goodToken';
        $tokenChoices = ['goodToken', 'badToken', 'redToken', 'blueToken'];
        $selection    = ['badToken', 'blueToken'];

        $message = sprintf(
                                                  "%s.\n\tfilterString \"%s\"\n\ttokenChoices \"[%s]\"]\n\texpected \"[%s]\"",
                                                  $assertMessage,
                                                  $filterString,
                                                  implode(', ', $tokenChoices),
                                                  implode(', ', $selection)
                                                );
        $this->assertEquals($selection, $this->resolveTokenChoices($filterString, $tokenChoices), $message);
    }
}
