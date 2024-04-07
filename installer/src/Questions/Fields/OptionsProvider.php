<?php

namespace Yiisoft\Yii\Installer\Questions\Fields;

interface OptionsProvider
{
    /**
     * @return SelectOption[]
     */
    public function getOptions(): array;
}
