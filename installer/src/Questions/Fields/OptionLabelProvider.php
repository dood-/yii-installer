<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Questions\Fields;

interface OptionLabelProvider
{
    public function getLabel(): string;
}
