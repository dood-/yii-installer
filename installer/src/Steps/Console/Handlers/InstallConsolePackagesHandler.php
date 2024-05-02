<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Console\Handlers;

use InvalidArgumentException;
use Yiisoft\Yii\Installer\Internal\InstallerContext;
use Yiisoft\Yii\Installer\Steps\Console\ConsoleQuestionResult;
use Yiisoft\Yii\Installer\Steps\Console\Packages\RunnerConsolePackage;
use Yiisoft\Yii\Installer\Steps\InstallationHandler;

final class InstallConsolePackagesHandler extends InstallationHandler
{
    public function install(InstallerContext $context): void
    {
        $result = $context->questionResults[ConsoleQuestionResult::class];

        if (!($result instanceof ConsoleQuestionResult)) {
            throw new InvalidArgumentException('Invalid question result');
        }

        if ($result->hasConsole) {
            $context->composerManager->addPackage(new RunnerConsolePackage());
        }
    }
}
