<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Console;

use Yiisoft\Yii\Installer\Steps\QuestionsResult;

final class ConsoleQuestionResult implements QuestionsResult
{
    public function __construct(
        public readonly bool $hasConsole,
    ) {
    }
}
