<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Console\Handlers;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\Console\ConsoleQuestionResult;
use Yiisoft\Yii\Installer\Steps\Console\Packages\RunnerConsolePackage;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class InstallConsolePackagesHandler extends InstallationHandler
{
    public function install(InstallerContext $context): void
    {
        $result = $context->questionResultCollection->findByResultClass(ConsoleQuestionResult::class);

        if ($result?->hasConsole === true) {
            $context->composerManager->addPackage(new RunnerConsolePackage());
        }
    }
}
