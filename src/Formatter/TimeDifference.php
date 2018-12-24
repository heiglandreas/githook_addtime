<?php

declare(strict_types=1);

/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTime\Formatter;


use DateInterval;
use Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier\Exact;
use Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier\Fuzzier;

class TimeDifference
{
    private $fuzzier;

    public function __construct(Fuzzier $fuzzier = null)
    {
        if (null === $fuzzier) {
            $fuzzier = new Exact();
        }
        $this->fuzzier = $fuzzier;
    }

    public function format(DateInterval $interval)
    {
        $interval = $this->fuzzier->fuzzy($interval);

        $string = '';
        if ($interval->h > 0) {
            $string .= $interval->h . 'h';
        }

        if ($interval->i > 0) {
            $string .= $interval->i . 'm';
        }

        if ($interval->s > 0) {
            $string .= $interval->s . 's';
        }

        return $string;
    }
}