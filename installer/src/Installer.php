<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer;

use Composer\Composer;
use Composer\Json\JsonFile;
use Composer\Script\Event;
use Yiisoft\Yii\Installer\Internal\Console\ConsoleIO;
use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Internal\Managers\Composer\ComposerJsonStorage;
use Yiisoft\Yii\Installer\Internal\Managers\Composer\ComposerManager;
use Yiisoft\Yii\Installer\Internal\Managers\Env\EnvManager;
use Yiisoft\Yii\Installer\Internal\Managers\Resource\ResourceManager;
use Yiisoft\Yii\Installer\Internal\Questions\QuestionFieldsHandler;
use Yiisoft\Yii\Installer\Internal\Questions\QuestionResultCollection;
use Yiisoft\Yii\Installer\Steps\Template\TemplateQuestion;

use function dirname;
use function realpath;
use function rtrim;
use function str_replace;

final class Installer
{
    private readonly string $projectRoot;

    public function __construct(
        private readonly ConsoleIO $io,
        private readonly string $composerFilePath,
        private readonly Composer $composer,
        ?string $projectRoot = null,
    ) {
        $projectRoot = $projectRoot ?? str_replace('\\', '/', realpath(dirname($this->composerFilePath)));
        $this->projectRoot = rtrim($projectRoot, '/\\') . '/';
    }

    public static function install(Event $event): void
    {
        (new self(
            io: new ConsoleIO($event->getIO()),
            composerFilePath: $event->getComposer()->getConfig()->getConfigSource()->getName(),
            composer: $event->getComposer(),
        ))->run();
    }

    private function run(): void
    {
        $context = new InstallerContext(
            appRoot: $this->projectRoot,
            envManager: new EnvManager('.env', $this->projectRoot),
            composerManager: new ComposerManager(
                storage: new ComposerJsonStorage(new JsonFile($this->composerFilePath)),
                rootPackage: $this->composer->getPackage(),
            ),
            resourceManager: new ResourceManager(
                aliases: [
                    '@steps' => __DIR__ . '/Steps/',
                ],
            ),
            questionResultCollection: new QuestionResultCollection()
        );

        $questionHandler = (new QuestionFieldsHandler($this->io, $context));

        $questionHandler->handle(new TemplateQuestion());

        foreach ($context->questionResultCollection as $questionClass => $result) {
            $question = new $questionClass;
            foreach ($question->handlers as $handler) {
                $handler->install($context);
            }
        }

        $context->composerManager->save();
        $context->envManager->save();
        $context->resourceManager->save();
    }
}
