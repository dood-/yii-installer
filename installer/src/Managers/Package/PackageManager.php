<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Managers\Package;

use IteratorAggregate;
use Traversable;
use Yiisoft\Yii\Installer\Managers\Composer\Package;

final class PackageManager implements IteratorAggregate
{
    /**
     * @param array<non-empty-string, Package> $packages
     */
    public function __construct(
        private array $packages = [],
    ) {
    }

    public function addPackage(Package $package): void
    {
        foreach ($package->dependencies as $dependency) {
            $this->addPackage($dependency);
        }

        $this->packages[$package->name] = $package;
    }

    public function hasPackage(): bool
    {
    }

    public function getIterator(): Traversable
    {
        // TODO: Implement getIterator() method.
    }
}
