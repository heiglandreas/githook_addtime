<?php

declare(strict_types=1);

/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier;


use DateInterval;

class Exact implements Fuzzier
{
    public function fuzzy(DateInterval $interval): DateInterval
    {
        return clone $interval;
    }
}