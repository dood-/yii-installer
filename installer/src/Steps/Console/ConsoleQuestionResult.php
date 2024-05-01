<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Console;

use Yiisoft\Yii\Installer\Questions\QuestionsResult;

final class ConsoleQuestionResult extends QuestionsResult
{
    public function __construct(
        public readonly bool $hasConsole,
    ) {
    }
}
