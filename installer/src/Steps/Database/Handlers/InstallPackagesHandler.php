<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database\Handlers;

use InvalidArgumentException;
use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\Database\DatabaseQuestion;
use Yiisoft\Yii\Installer\Steps\Database\DatabaseQuestionsResult;
use Yiisoft\Yii\Installer\Steps\Database\DatabaseType;
use Yiisoft\Yii\Installer\Steps\Database\Packages\CycleDatabasePackage;
use Yiisoft\Yii\Installer\Steps\Database\Packages\CyclePackage;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class InstallPackagesHandler extends InstallationHandler
{
    public function handle(InstallerContext $context): void
    {
        $result = $context->questionResults[DatabaseQuestion::class];

        if (!($result instanceof DatabaseQuestionsResult)) {
            throw new InvalidArgumentException('Invalid question result');
        }

        match ($result->type) {
            DatabaseType::Cycle => $this->installCycle($context),
            DatabaseType::Doctrine => $this->installDoctrine($context),
        };

        $context->envManager->addGroup(
            values: [
                'DB_HOST' => 'localhost',
                'DB_PORT' => '3306',
                'DB_DATABASE' => 'application',
                'DB_USERNAME' => $result->user ?? 'root',
                'DB_PASSWORD' => $result->password ?? 'root',
            ],
            comment: 'Database Settings'
        );
    }

    private function installCycle(InstallerContext $context): void
    {
        $context->composerManager->addPackage(new CyclePackage());
    }

    private function installDoctrine(InstallerContext $context): void
    {
        $context->composerManager->addPackage(new CyclePackage());
    }
}
