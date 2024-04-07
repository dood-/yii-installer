<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Questions\QuestionsResult;

abstract class InstallationHandler
{
    public function install(InstallerContext $context, QuestionsResult $questionsResult): void
    {
    }

    public function configure(InstallerContext $context, QuestionsResult $questionsResult): void
    {
    }
}
