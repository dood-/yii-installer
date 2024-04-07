<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Managers\Composer;

use Composer\Package\Link;
use Composer\Package\RootPackageInterface;
use Composer\Package\Version\VersionParser;

final class ComposerManager
{
    private array $fileContent;

    /** @var array|Link[] */
    private array $requires;

    /** @var array|Link[] */
    private array $devRequires;

    public function __construct(
        private readonly ComposerJsonStorage $storage,
        private readonly RootPackageInterface $rootPackage,
    ) {
        $this->fileContent = $storage->read();
        $this->requires = $rootPackage->getRequires();
        $this->devRequires = $rootPackage->getDevRequires();
    }

    public function addPackage(Package $package): void
    {
        $link = new Link(
            source: '__root__',
            target: $package->name,
            constraint: (new VersionParser())->parseConstraints($package->version),
            description: Link::TYPE_REQUIRE,
            prettyConstraint: $package->version,
        );

        $this->removePackage($package);

        if ($package->isDev) {
            $this->devRequires[$package->name] = $link;
            $this->fileContent['require-dev'][$package->name] = $package->version;
        } else {
            $this->requires[$package->name] = $link;
            $this->fileContent['require'][$package->name] = $package->version;
        }

        foreach ($package->dependencies as $dependency) {
            $this->addPackage($dependency);
        }
    }

    public function removePackage(Package $package): void
    {
        unset(
            $this->devRequires[$package->name],
            $this->fileContent['require-dev'][$package->name],
            $this->requires[$package->name],
            $this->fileContent['require'][$package->name],
        );
    }

    public function save(): void
    {
        $this->rootPackage->setRequires($this->requires);
        $this->rootPackage->setDevRequires($this->devRequires);
        $this->rootPackage->setExtra($this->definition['extra'] ?? []);

        $this->storage->write($this->fileContent);
    }
}
