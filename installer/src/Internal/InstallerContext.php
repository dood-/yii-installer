<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal;

use Yiisoft\Yii\Installer\Internal\Managers\Composer\ComposerManager;
use Yiisoft\Yii\Installer\Internal\Managers\Env\EnvManager;
use Yiisoft\Yii\Installer\Internal\Managers\Resource\ResourceManager;
use Yiisoft\Yii\Installer\Internal\Questions\QuestionResultCollection;

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
