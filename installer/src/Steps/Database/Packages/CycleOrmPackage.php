<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database\Packages;

use Yiisoft\Yii\Installer\Managers\Composer\ComposerPackage;
use Yiisoft\Yii\Installer\Managers\Composer\Package;

final class CycleOrmPackage extends Package
{
    public function __construct()
    {
        parent::__construct(
            package: ComposerPackage::CycleOrm,
        );
    }
}