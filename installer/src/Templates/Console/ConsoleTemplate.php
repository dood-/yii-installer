<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Templates\Console;

use Yiisoft\Yii\Installer\Steps\Database\DatabaseQuestion;
use Yiisoft\Yii\Installer\Template;
use Yiisoft\Yii\Installer\Templates\Console\Handlers\InstallPackagesHandler;

final class ConsoleTemplate extends Template
{
    public function __construct(
        string $template = 'Console app',
        string $description = 'Console application',
    ) {
        parent::__construct(
            template: $template,
            description: $description,
            handlers: [
                new InstallPackagesHandler(),
            ],
            // todo add packages
            resources: [],
            questions: [
                new DatabaseQuestion(),
            ],
        );
    }
}
