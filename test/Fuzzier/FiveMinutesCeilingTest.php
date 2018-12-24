<?php
/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTimeTest\Fuzzier;

use DateInterval;
use Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier\FiveMinutesCeiling;
use PHPUnit\Framework\TestCase;

class FiveMinutesCeilingTest extends TestCase
{

    /** @dataProvider fuzzyProvider */
    public function testFuzzy(DateInterval $input, DateInterval $expected)
    {
        $fuzzier = new FiveMinutesCeiling();

        $result = $fuzzier->fuzzy($input);

        self::assertNotSame($input, $result);
        self::assertEquals($expected, $result);
    }

    public function fuzzyProvider()
    {
        return [
            [new DateInterval('PT1H12M12S'), new DateInterval('PT1H15M0S')],
            [new DateInterval('PT1H0M12S'), new DateInterval('PT1H5M0S')],
            [new DateInterval('PT1H0M0S'), new DateInterval('PT1H0M0S')],
            [new DateInterval('PT1H56M0S'), new DateInterval('PT2H0M0S')],
            [new DateInterval('PT1H54M1S'), new DateInterval('PT1H55M0S')],
        ];
    }
}
