<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Template\Console\Handlers;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\Console\Packages\AliasesPackage;
use Yiisoft\Yii\Installer\Steps\Console\Packages\LogTargetPackage;
use Yiisoft\Yii\Installer\Steps\Console\Packages\PhpDotEnvPackage;
use Yiisoft\Yii\Installer\Steps\Console\Packages\RunnerConsolePackage;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class InstallPackagesHandler extends InstallationHandler
{
    public function install(InstallerContext $context): void
    {
        $context->composerManager->addPackage(new RunnerConsolePackage());
        $context->composerManager->addPackage(new LogTargetPackage());
        $context->composerManager->addPackage(new AliasesPackage());
        $context->composerManager->addPackage(new PhpDotEnvPackage());
    }
}
