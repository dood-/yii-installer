<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Console;

use Generator;
use Yiisoft\Yii\Installer\Questions\Fields\BooleanField;
use Yiisoft\Yii\Installer\Questions\Question;
use Yiisoft\Yii\Installer\Steps\Console\Handlers\InstallConsolePackagesHandler;

final class ConsoleQuestion extends Question
{
    public function __construct(
        string $resultType = ConsoleQuestionResult::class,
        array $handlers = [
            new InstallConsolePackagesHandler(),
        ],
    ) {
        parent::__construct($resultType, $handlers);
    }

    public function fields(): Generator
    {
        yield new BooleanField(
            name: 'hasConsole',
            question: 'Do you need console commands?',
        );
    }
}
