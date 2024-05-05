<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Questions\Fields;

abstract class Field
{
    public function __construct(
        public readonly string $name,
        public readonly string $question,
        public readonly ?string $help = null,
        public readonly bool $required = false,
        public readonly string|bool|null $default = null,
    ) {
    }
}
