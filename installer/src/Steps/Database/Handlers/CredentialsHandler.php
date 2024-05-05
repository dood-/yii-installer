<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database\Handlers;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\Database\DatabaseQuestionsResult;
use Yiisoft\Yii\Installer\Steps\Database\DbCredentialsQuestionsResult;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class CredentialsHandler extends InstallationHandler
{
    public function install(InstallerContext $context): void
    {
        $dbResult = $context->questionResultCollection->findByResultClass(DatabaseQuestionsResult::class);
        $result = $context->questionResultCollection->findByResultClass(DbCredentialsQuestionsResult::class);

        $context->envManager->addGroup(
            values: [
                'DB_TYPE' => $dbResult->type->name,
                'DB_HOST' => 'localhost',
                'DB_PORT' => '3306',
                'DB_DATABASE' => 'application',
                'DB_USERNAME' => $result->user ?? 'root',
                'DB_PASSWORD' => $result->password ?? 'root',
            ],
            comment: 'Database Settings'
        );
    }
}
