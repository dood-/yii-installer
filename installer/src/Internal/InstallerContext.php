<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal;

use Yiisoft\Yii\Installer\Managers\Composer\ComposerManager;
use Yiisoft\Yii\Installer\Managers\Env\EnvManager;
use Yiisoft\Yii\Installer\Managers\Resource\ResourceManager;
use Yiisoft\Yii\Installer\Questions\QuestionResultCollection;

final class InstallerContext
{
    public function __construct(
        public readonly string $appRoot,
        public readonly EnvManager $envManager,
        public readonly ComposerManager $composerManager,
        public readonly ResourceManager $resourceManager,
        public readonly QuestionResultCollection $questionResultCollection,
    )
    {
    }
}
