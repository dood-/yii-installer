<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Managers\Resource;

final class ResourceManager
{
    private array $resources;

    public function __construct(
        array $resources = [],
    ) {
        $this->resources = $resources;
    }

    public function add(string $resource)
    {
        $this->resources[] = $resource;
    }

    public function getResources(): array
    {
        return $this->resources;
    }
}
