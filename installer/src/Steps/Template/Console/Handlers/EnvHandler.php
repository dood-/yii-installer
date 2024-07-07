<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Template\Console\Handlers;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class EnvHandler extends InstallationHandler
{
    public function install(InstallerContext $context): void
    {
        $context->envManager->addGroup(
            values: [
                'YII_ENV' => 'dev',
                'YII_DEBUG' => true,
            ],
            comment: 'Dev environment variables for Codeception.',
            priority: 1000,
        );
    }
}
