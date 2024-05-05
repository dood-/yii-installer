<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Console;

use Yiisoft\Yii\Installer\Internal\Questions\Fields\BooleanField;
use Yiisoft\Yii\Installer\Internal\Questions\Question;
use Yiisoft\Yii\Installer\Steps\Console\Handlers\InstallConsolePackagesHandler;

final class ConsoleQuestion extends Question
{
    public function __construct(
        string $resultClass = ConsoleQuestionResult::class,
        array $handlers = [
            new InstallConsolePackagesHandler(),
        ],
    ) {
        parent::__construct($resultClass, $handlers);
    }

    public function fields(): \Generator
    {
        yield new BooleanField(
            name: 'hasConsole',
            question: 'Do you need console commands?',
        );
    }
}
