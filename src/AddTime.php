<?php

declare(strict_types=1);

/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTime;

use CaptainHook\App\Config;
use CaptainHook\App\Console\IO;
use CaptainHook\App\Hook\Action;
use DateTimeImmutable;
use Exception;
use InvalidArgumentException;
use Org_Heigl\CaptainHook\Hooks\AddTime\CommitMessage\CommitMessageHandler;
use Org_Heigl\CaptainHook\Hooks\AddTime\Formatter\TimeDifference;
use Org_Heigl\CaptainHook\Hooks\AddTime\Fuzzier\TenMinutesCeiling;
use SebastianFeldmann\Git\Repository;

class AddTime implements Action
{
    private $formatter;

    public function __construct(TimeDifference $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Executes the action.
     *
     * @param  \CaptainHook\App\Config $config
     * @param  \CaptainHook\App\Console\IO $io
     * @param  \SebastianFeldmann\Git\Repository $repository
     * @param  \CaptainHook\App\Config\Action $action
     * @throws \Exception
     */
    public function execute(Config $config, IO $io, Repository $repository, Config\Action $action)
    {
        $time = new DateTimeImmutable();
        try {
            $lastCommitDate = $this->getLastCommitDateTime();
            $timeDiff = $this->formatter->format(
                $time->diff($lastCommitDate)
            );
        } catch (Exception $e) {
            $io->write($e->getMessage());
            $timeDiff = '??';
        }

        $messageHandler = new CommitMessageHandler($repository->getCommitMsg());

        $message = $messageHandler->appendContent(sprintf(
            'Time: %s',
            $timeDiff
        ));

        $repository->setCommitMsg($message);
    }

    private function getLastCommitDateTime() : DateTimeImmutable
    {
        exec('git log -1 --format="%at"', $result);

        if (! is_numeric($result[0])) {
            throw new InvalidArgumentException('No last commit-Date found');
        }

        return new DateTimeImmutable('@' . $result[0]);
    }
}