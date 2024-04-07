<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Templates\Console\Handlers;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\Console\Packages\RunnerConsolePackage;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class InstallPackagesHandler extends InstallationHandler
{
    public function handle(InstallerContext $context): void
    {
        $context->composerManager->addPackage(new RunnerConsolePackage());
    }
}
