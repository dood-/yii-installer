<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Templates;

use Yiisoft\Yii\Installer\Questions\Question;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

abstract class Template
{
    /**
     * @param string $template
     * @param string $description
     * @param array<InstallationHandler> $handlers
     * @param array $resources
     * @param array<Question> $questions
     */
    public function __construct(
        public readonly string $template,
        public readonly string $description,
        public readonly array $handlers,
        public readonly array $resources,
        public readonly array $questions,
    ) {
    }
}
