<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Templates\App;

use Yiisoft\Yii\Installer\Templates\Template;

final class AppTemplate extends Template
{
    public function __construct(
        string $template = 'Web app',
        string $description = 'Web application',
    ) {
        parent::__construct(
            template: $template,
            description: $description,
            handlers: [],
            resources: [],
            questions: [],
        );
    }
}
