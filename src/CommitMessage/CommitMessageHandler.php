<?php

declare(strict_types=1);

/**
 * Copyright Andrea Heigl <andreas@heigl.org>
 *
 * Licenses under the MIT-license. For details see the included file LICENSE.md
 */

namespace Org_Heigl\CaptainHook\Hooks\AddTime\CommitMessage;

use SebastianFeldmann\Git\CommitMessage;

class CommitMessageHandler
{
    private $message;

    public function __construct(CommitMessage $message)
    {
        $this->message = $message;
    }

    public function appendContent(string $addedLine, $beforeFinalComment = true) : CommitMessage
    {
        $content = $this->message->getLines();
        $linecounter = count($content);
        if ($beforeFinalComment) {
            foreach (array_reverse($content) as $line) {
                if (strpos($line, $this->message->getCommentCharacter()) === 0) {
                    --$linecounter;
                    continue;
                }
                if (strlen(trim($line)) === 0) {
                    --$linecounter;
                    continue;
                }

                break;
            }
        }

        array_splice($content, $linecounter  + 1, 0, [$addedLine]);

        return new CommitMessage(implode("\n", $content), $this->message->getCommentCharacter());
    }
}