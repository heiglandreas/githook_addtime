<?php
/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTimeTest\Fuzzier;

use DateInterval;
use Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier\FiveMinutesCeiling;
use Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier\TenMinutesCeiling;
use PHPUnit\Framework\TestCase;

class TenMinutesCeilingTest extends TestCase
{

    /** @dataProvider fuzzyProvider */
    public function testFuzzy(DateInterval $input, DateInterval $expected)
    {
        $fuzzier = new TenMinutesCeiling();

        $result = $fuzzier->fuzzy($input);

        self::assertNotSame($input, $result);
        self::assertEquals($expected, $result);
    }

    public function fuzzyProvider()
    {
        return [
            [new DateInterval('PT1H12M12S'), new DateInterval('PT1H20M0S')],
            [new DateInterval('PT1H0M12S'), new DateInterval('PT1H10M0S')],
            [new DateInterval('PT1H0M0S'), new DateInterval('PT1H0M0S')],
            [new DateInterval('PT1H51M0S'), new DateInterval('PT2H0M0S')],
            [new DateInterval('PT1H49M1S'), new DateInterval('PT1H50M0S')],
        ];
    }
}
