<?php

namespace Yiisoft\Yii\Installer\Steps\Template;

use Yiisoft\Yii\Installer\Questions\Fields\OptionLabelProvider;

enum TemplateType implements OptionLabelProvider
{
    case App;
    case Console;

    public function getLabel(): string
    {
        return match ($this) {
            self::App => 'Web Application',
            self::Console => 'Console Application',
        };
    }
}
