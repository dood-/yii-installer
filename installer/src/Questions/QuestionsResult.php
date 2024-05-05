<?php

namespace Yiisoft\Yii\Installer\Questions;

use ReflectionClass;

abstract class QuestionsResult
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function fromArray(array $values): static
    {
        $reflection = new ReflectionClass(static::class);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new static();
        }

        $parameters = array_map(static fn($parameter) => $parameter->getName(), $constructor->getParameters());

        return new static(
            ...array_filter(
                $values,
                static fn($arg) => in_array($arg, $parameters, true),
                ARRAY_FILTER_USE_KEY
            )
        );
    }
}
