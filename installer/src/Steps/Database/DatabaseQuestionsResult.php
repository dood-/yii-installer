<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database;

use Yiisoft\Yii\Installer\Internal\Questions\QuestionsResult;

final class DatabaseQuestionsResult extends QuestionsResult
{
    public function __construct(
        public readonly ?DatabaseType $type,
    ) {
    }
}
