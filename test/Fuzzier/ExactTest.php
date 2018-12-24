<?php
/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTimeTest\Fuzzier;

use DateInterval;
use Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier\Exact;
use PHPUnit\Framework\TestCase;

class ExactTest extends TestCase
{

    public function testFuzzy()
    {
        $fuzzier = new Exact();

        $interval = new DateInterval('PT1H12M1S');

        $result = $fuzzier->fuzzy($interval);

        self::assertNotSame($result, $interval);
        self::assertEquals($interval, $result);
    }
}
