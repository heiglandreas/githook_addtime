<?php

declare(strict_types=1);

/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier;

use DateInterval;

class TenMinutesCeiling implements Fuzzier
{
    public function fuzzy(DateInterval $interval): DateInterval
    {
        $interval = clone $interval;

        if ($interval->s > 0) {
            $interval->s = 0;
            $interval->i = $interval->i + 1;
        }

        if ($interval->i === 0) {
            return $interval;
        }

        if ($interval->i % 10 === 0) {
            return $interval;
        }

        $modulo = ceil($interval->i / 10);
        if ($modulo % 6 === 0) {
            $interval->h = $interval->h + ceil($modulo / 6);
            $modulo = 0;
        }
        $interval->i = $modulo * 10;

        return $interval;
    }
}