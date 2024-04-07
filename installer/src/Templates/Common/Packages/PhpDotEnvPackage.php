<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Templates\Common\Packages;

use Yiisoft\Yii\Installer\ComposerPackage;
use Yiisoft\Yii\Installer\Managers\Composer\Package;

final class PhpDotEnvPackage extends Package
{
    public function __construct(
        ComposerPackage $package = ComposerPackage::PhpDotEnv,
        bool $isDev = false,
        array $dependencies = [],
    ) {
        parent::__construct(
            package: $package,
            isDev: $isDev,
            dependencies: $dependencies,
        );
    }
}
