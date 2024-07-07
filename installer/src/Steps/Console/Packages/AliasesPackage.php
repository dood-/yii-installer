<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Console\Packages;

use Yiisoft\Yii\Installer\Internal\Managers\Composer\ComposerPackage;
use Yiisoft\Yii\Installer\Internal\Managers\Composer\Package;

final class AliasesPackage extends Package
{
    public function __construct()
    {
        parent::__construct(
            package: ComposerPackage::YiiAliases,
        );
    }
}
