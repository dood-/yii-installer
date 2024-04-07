<?php

namespace Yiisoft\Yii\Installer\Questions;

use Generator;
use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Questions\Fields\Field;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

abstract class Question
{
    public function __construct(
        /** @return class-string<QuestionsResult> */
        public readonly string $resultType,

        /** @var array<InstallationHandler> */
        public readonly array $handlers = [],
    ) {
    }

    /**
     * @return Generator<Field>
     */
    abstract public function fields(): Generator;

    public function shouldSkip(InstallerContext $context): bool
    {
        return false;
    }
}
