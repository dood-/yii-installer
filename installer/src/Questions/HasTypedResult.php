<?php

namespace Yiisoft\Yii\Installer\Questions;

interface HasTypedResult
{
    /**
     * @return class-string<QuestionsResult>
     */
    public function getResultType(): string;
}
