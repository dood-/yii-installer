<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Questions\Fields;

final class SelectOption
{
    public function __construct(
        public readonly string $title,
        public readonly mixed $value,
    ) {
    }
}
