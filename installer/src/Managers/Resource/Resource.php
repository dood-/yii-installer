<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Managers\Resource;

final class Resource
{
    public function __construct(
        public readonly string $source,
        public readonly string $destination,
    )
    {
    }
}
