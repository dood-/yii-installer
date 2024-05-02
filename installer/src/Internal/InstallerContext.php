<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal;

use Yiisoft\Yii\Installer\Managers\Composer\ComposerManager;
use Yiisoft\Yii\Installer\Managers\Env\EnvManager;
use Yiisoft\Yii\Installer\Managers\Resource\ResourceManager;
use Yiisoft\Yii\Installer\Questions\Question;
use Yiisoft\Yii\Installer\Questions\QuestionsResult;
use Yiisoft\Yii\Installer\Templates\Template;

final class InstallerContext
{
    public function __construct(
        public readonly string $appRoot,
        public readonly Template $template,
        public readonly EnvManager $envManager,
        public readonly ComposerManager $composerManager,
        public readonly ResourceManager $resourceManager,
        /**
         * @var array<class-string<Question>, QuestionsResult>
         */
        public array $questionResults = [], // todo extract it
    )
    {
    }
}
