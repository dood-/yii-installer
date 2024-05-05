<?php

namespace Yiisoft\Yii\Installer\Internal\Questions;

use Generator;
use Yiisoft\Yii\Installer\Internal\Questions\Fields\Field;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

abstract class Question
{
    /**
     * @psalm-param class-string<QuestionsResult> $resultClass
     * @param InstallationHandler[] $handlers
     */
    public function __construct(
        public readonly string $resultClass,
        public readonly array $handlers = [],
    ) {
    }

    /**
     * @return Generator<mixed, mixed, \Yiisoft\Yii\Installer\Internal\Questions\Fields\Field|Question, void>
     */
    abstract public function fields(): \Generator;
}
