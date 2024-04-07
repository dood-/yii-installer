<?php

namespace Yiisoft\Yii\Installer\Steps\Database;

use Yiisoft\Yii\Installer\Questions\Fields\OptionLabelProvider;

enum DatabaseType implements OptionLabelProvider
{
    case Cycle;
    case Doctrine;

    public function getLabel(): string
    {
        return match ($this) {
            self::Cycle => 'Cycle ORM',
            self::Doctrine => 'Doctrine ORM',
        };
    }
}

