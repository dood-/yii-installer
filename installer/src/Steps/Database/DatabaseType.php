<?php

namespace Yiisoft\Yii\Installer\Steps\Database;

use Yiisoft\Yii\Installer\Internal\Questions\Fields\OptionLabelProvider;

enum DatabaseType implements OptionLabelProvider
{
    case Db;
    case Cycle;

    public function getLabel(): string
    {
        return match ($this) {
            self::Db => 'DB',
            self::Cycle => 'Cycle ORM',
        };
    }
}

