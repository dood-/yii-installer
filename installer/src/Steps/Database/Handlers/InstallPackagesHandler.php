<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database\Handlers;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\Database\DatabaseQuestionsResult;
use Yiisoft\Yii\Installer\Steps\Database\DatabaseType;
use Yiisoft\Yii\Installer\Steps\Database\Packages\CyclePackage;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class InstallPackagesHandler extends InstallationHandler
{
    public function install(InstallerContext $context): void
    {
        $result = $context->questionResultCollection->findByResultClass(DatabaseQuestionsResult::class);

        if ($result?->type !== null) {
            match ($result->type) {
                DatabaseType::Cycle => $this->installCycle($context),
                DatabaseType::Db => $this->installDb($context),
            };
        }
    }

    private function installCycle(InstallerContext $context): void
    {
        $context->composerManager->addPackage(new CyclePackage());
    }

    private function installDb(InstallerContext $context): void
    {
        $context->composerManager->addPackage(new CyclePackage());
    }
}
