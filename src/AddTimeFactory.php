<?php

declare(strict_types=1);

/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTime;

use CaptainHook\App\Config;
use CaptainHook\App\Hook\Action;
use CaptainHook\App\Hook\ActionFactory;
use Org_Heigl\CaptainHook\Hooks\AddTime\Formatter\TimeDifference;

class AddTimeFactory implements ActionFactory
{
    public function getAction(Config\Options $options) : Action
    {
        $fuzziness = null;
        if ($options->get('fuzziness') != null) {
            $class = $options->get('fuzziness');
            $fuzziness = new $class();
        }

        return new AddTime(new TimeDifference($fuzziness));
    }
}