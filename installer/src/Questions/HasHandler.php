<?php

namespace Yiisoft\Yii\Installer\Questions;

interface HasHandler
{
    /**
     * @return array<QuestionFieldsHandler>
     */
    public function handlers(): array;
}
