<?php

namespace Yiisoft\Yii\Installer\Templates;

use Yiisoft\Yii\Installer\Questions\Fields\OptionLabelProvider;
use Yiisoft\Yii\Installer\Templates\App\AppTemplate;
use Yiisoft\Yii\Installer\Templates\Console\ConsoleTemplate;

enum TemplateType: string implements OptionLabelProvider
{
    case App = AppTemplate::class;
    case Console = ConsoleTemplate::class;

    public function getLabel(): string
    {
        return match ($this) {
            self::App => 'Web Application',
            self::Console => 'Console Application',
        };
    }
}
