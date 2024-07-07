<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Template\Console;

use Yiisoft\Yii\Installer\Internal\Questions\Question;
use Yiisoft\Yii\Installer\Steps\Database\DatabaseQuestion;
use Yiisoft\Yii\Installer\Steps\Template\Console\Handlers\EnvHandler;
use Yiisoft\Yii\Installer\Steps\Template\Console\Handlers\InstallPackagesHandler;
use Yiisoft\Yii\Installer\Steps\Template\Console\Handlers\ResourcesHandler;

final class ConsoleTemplateQuestion extends Question
{
    public function __construct(
        string $resultClass = ConsoleTemplateResult::class,
        array $handlers = [
            new InstallPackagesHandler(),
            new EnvHandler(),
            new ResourcesHandler(),
        ],
    ) {
        parent::__construct($resultClass, $handlers);
    }

    public function fields(): \Generator
    {
        yield new DatabaseQuestion();
    }
}
