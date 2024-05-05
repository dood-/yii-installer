<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps;

use Yiisoft\Yii\Installer\Internal\InstallerContext;

abstract class InstallationHandler
{
    public function install(InstallerContext $context): void
    {
    }

    public function configure(InstallerContext $context): void
    {
    }
}
