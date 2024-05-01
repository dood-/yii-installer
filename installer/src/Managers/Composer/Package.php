<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Managers\Composer;

use InvalidArgumentException;

abstract class Package
{
    public readonly string $name;
    public readonly string $version;

    public function __construct(
        public readonly ComposerPackage $package,
        public readonly bool $isDev = false,
        public readonly array $dependencies = [],
    ) {
        [$name, $version] = explode(':', $this->package->value);

        if (empty($name) || empty($version)) {
            throw new InvalidArgumentException('Invalid package name');
        }

        $this->name = $name;
        $this->version = $version;
    }
}
