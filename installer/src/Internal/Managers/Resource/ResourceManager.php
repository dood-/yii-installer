<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Managers\Resource;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

final class ResourceManager
{
    /**
     * @param Resource[] $resources
     * @param array<string, string> $aliases
     */
    public function __construct(
        private array $resources = [],
        private readonly array $aliases = [],
    ) {
    }

    public function add(Resource $resource): self
    {
        $this->resources[] = $resource;

        return $this;
    }

    public function save(): void
    {
        foreach ($this->resources as $resource) {
            $source = $resource->source;

            if ($this->isAlias($source)) {
                $source = \strtr($source, $this->aliases);
            }

            $this->copy($source, $resource->destination);
        }
    }

    private function copy(string $source, string $destination): void
    {
        if (!is_dir($destination)) {
            $this->createDirectory($destination);
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        /** @var SplFileInfo $item */
        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $dir = $destination . '/' . $iterator->getSubPathName();
                if (!is_dir($dir)) {
                    $this->createDirectory($dir);
                }
            } else {
                $file = $destination . '/' . $iterator->getSubPathName();
                copy((string) $item, $file);
            }
        }
    }

    private function isAlias(string $alias): bool
    {
        return !strncmp($alias, '@', 1);
    }

    private function createDirectory(string $destination): void
    {
        if (!mkdir($destination, 0755, true) && !is_dir($destination)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $destination));
        }
    }
}
