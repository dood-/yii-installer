<?php

namespace Yiisoft\Yii\Installer\Internal\Questions\Fields;

interface OptionsProvider
{
    /**
     * @return SelectOption[]
     */
    public function getOptions(): array;
}
