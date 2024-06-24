<?php

namespace Yiisoft\Yii\Installer\Tests\Internal\Questions\Fields\SelectField;

use Yiisoft\Yii\Installer\Internal\Questions\Fields\OptionLabelProvider;

enum QuestionsWithLabels implements OptionLabelProvider
{
    case Test1;
    case Test2;

    public function getLabel(): string
    {
        return match ($this) {
            self::Test1 => 'test 1',
            self::Test2 => 'test 2',
        };
    }
}
