<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Template;

use Yiisoft\Yii\Installer\Questions\QuestionsResult;

final class TemplateQuestionResult extends QuestionsResult
{
    public function __construct(
        public readonly TemplateType $type,
    ) {
    }
}
