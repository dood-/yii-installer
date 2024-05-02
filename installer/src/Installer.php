<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer;

use Composer\Composer;
use Composer\Json\JsonFile;
use Composer\Script\Event;
use ReflectionClass;
use Yiisoft\Yii\Installer\Console\ConsoleIO;
use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Managers\Composer\ComposerJsonStorage;
use Yiisoft\Yii\Installer\Managers\Composer\ComposerManager;
use Yiisoft\Yii\Installer\Managers\Env\EnvManager;
use Yiisoft\Yii\Installer\Managers\Resource\ResourceManager;
use Yiisoft\Yii\Installer\Questions\Fields\SelectField;
use Yiisoft\Yii\Installer\Questions\QuestionFieldsHandler;
use Yiisoft\Yii\Installer\Templates\Console\ConsoleTemplate;
use Yiisoft\Yii\Installer\Templates\Template;
use Yiisoft\Yii\Installer\Templates\TemplateType;

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
            template: $this->getTemplate(),
            envManager: new EnvManager('.env', $this->projectRoot),
            composerManager: new ComposerManager(
                storage: new ComposerJsonStorage(new JsonFile($this->composerFilePath)),
                rootPackage: $this->composer->getPackage(),
            ),
            resourceManager: new ResourceManager(
                aliases: [
                    '@steps' => __DIR__ . '/Steps/',
                    '@templates' => __DIR__ . '/Templates/',
                ],
            ),
        );

        $questionHandler = (new QuestionFieldsHandler($this->io));


        // todo rewrite the lines below
        foreach ($context->template->questions as $question) {
            if (!$question->shouldSkip($context)) {
                $context->questionResults[$question::class] = $questionHandler->handle($question);
            }
        }

        foreach ($context->template->handlers as $handler) {
            $handler->install($context);
        }

        foreach ($context->template->questions as $question) {
            foreach ($question->handlers as $handler) {
                $handler->install($context);
            }
        }

        $context->envManager->save();
        $context->composerManager->save();
        $context->resourceManager->save();
    }

    private function getTemplate(): Template
    {
        /** @var TemplateType $type */
        $type = $this->io->ask(
            new SelectField(
                name: 'type',
                question: 'Which application type do you want to use?',
                options: TemplateType::class,
                help: null,
                required: true,
            )
        );

        return new $type->value;
    }
}
