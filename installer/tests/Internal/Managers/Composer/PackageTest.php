<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Tests\Internal\Managers\Composer;

use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Installer\Internal\Managers\Composer\ComposerPackage;
use Yiisoft\Yii\Installer\Internal\Managers\Composer\Package;

final class PackageTest extends TestCase
{
    public function testBase(): void
    {
        $testPackage = (new class(ComposerPackage::YiiConsole) extends Package {
        });

        $this->assertFalse($testPackage->isDev);
        $this->assertSame(ComposerPackage::YiiConsole, $testPackage->package);
        $this->assertSame('yiisoft/yii-console', $testPackage->name);
        $this->assertSame('^2.0', $testPackage->version);
    }
}
