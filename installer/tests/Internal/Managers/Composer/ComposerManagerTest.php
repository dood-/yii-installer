<?php

namespace Yiisoft\Yii\Installer\Tests\Internal\Managers\Composer;

use Composer\Json\JsonFile;
use Composer\Package\RootPackage;
use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Installer\Internal\Managers\Composer\ComposerManager;
use Yiisoft\Yii\Installer\Internal\Managers\Composer\ComposerStorage;
use Yiisoft\Yii\Installer\Steps\Console\Packages\ConsolePackage;
use Yiisoft\Yii\Installer\Steps\Console\Packages\RunnerConsolePackage;

class ComposerManagerTest extends TestCase
{
    private ComposerStorage $storage;
    private ComposerManager $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->storage = $this->createMock(ComposerStorage::class);
        $this->storage
            ->expects($this->once())
            ->method('read')
            ->willReturn((new JsonFile(__DIR__ . '/composer.json'))->read());

        $this->manager = new ComposerManager(
            storage: $this->storage,
            rootPackage: new RootPackage('root-package', '1.0.0', '1.0.0'),
        );
    }

    public function dataAddPackage()
    {
        yield [
            [
                new ConsolePackage(),
                new RunnerConsolePackage(),
            ]
        ];
        yield [
            [
                new ConsolePackage(),
            ]
        ];
    }

    /**
     * @dataProvider dataAddPackage
     */
    public function testAddPackage(array $packages): void
    {
        foreach ($packages as $package) {
            $this->manager->addPackage($package);
        }

        $this->storage
            ->expects($this->once())
            ->method('write')
            ->with(
                $this->callback(
                    function (array $config) use ($packages): bool {
                        foreach ($packages as $package) {
                            if (($config['require'][$package->name] ?? '') !== $package->version) {
                                return false;
                            }
                        }
                        return true;
                    }
                )
            );

        $this->manager->save();
    }

}
