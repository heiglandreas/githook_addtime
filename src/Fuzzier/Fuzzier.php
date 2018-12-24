<?php

declare(strict_types=1);

/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier;


use DateInterval;

interface Fuzzier
{
    const YEAR = 'y';

    const MONTH = 'm';

    const DAY = 'd';

    const DAYS = 'days';

    const HOUR = 'h';

    const MINUTE = 'i';

    const SECOND = 's';

    const MICROSECOND = 'f';

    public function fuzzy(DateInterval $interval) : DateInterval;
}