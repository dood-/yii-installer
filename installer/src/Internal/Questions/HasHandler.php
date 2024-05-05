<?php

namespace Yiisoft\Yii\Installer\Internal\Questions;

interface HasHandler
{
    /**
     * @return array<QuestionFieldsHandler>
     */
    public function handlers(): array;
}
