<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Template\Console\Handlers;

use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Internal\Managers\Resource\Resource;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class ResourcesHandler extends InstallationHandler
{
    public function install(InstallerContext $context): void
    {
        $context->resourceManager->add(
            new Resource(
                source: '@steps/Template/Console/resources/app',
                destination: './',
            ),
        );
    }
}
