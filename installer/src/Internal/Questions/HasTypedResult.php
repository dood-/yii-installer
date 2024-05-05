<?php

namespace Yiisoft\Yii\Installer\Internal\Questions;

interface HasTypedResult
{
    /**
     * @return class-string<QuestionsResult>
     */
    public function getResultType(): string;
}
