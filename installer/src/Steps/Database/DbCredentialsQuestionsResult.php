<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database;

use Yiisoft\Yii\Installer\Questions\QuestionsResult;

final class DbCredentialsQuestionsResult extends QuestionsResult
{
    public function __construct(
        public readonly string $user,
        public readonly string $password,
    ) {
    }
}
