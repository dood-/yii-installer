<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Questions\Fields;

use RuntimeException;
use UnitEnum;

class SelectField extends Field implements OptionsProvider
{
    /**
     * @param string|non-empty-string $name
     * @param string|non-empty-string $question
     * @param SelectOption[]|class-string $options
     * @param string|null $help
     * @param bool $required
     * @param string|bool|null $default
     */
    public function __construct(
        string $name,
        string $question,
        private readonly array|string $options,
        ?string $help = null,
        bool $required = false,
        string|bool|null $default = null,
    ) {
        parent::__construct(
            name: $name,
            question: $question,
            help: $help,
            required: $required,
            default: $default,
        );
    }

    /**
     * @return array|SelectOption[]
     */
    public function getOptions(): array
    {
        $options = $this->options;

        if (is_string($options)) {
            if (!enum_exists($options)) {
                throw new RuntimeException("Enum '{$options}' does not exists");
            }

            $options = array_map(static fn(UnitEnum $case) => new SelectOption(
                title: $case instanceof OptionLabelProvider ? $case->getLabel() : $case->name,
                value: $case,
            ), $options::cases());
        }

        if (!$this->required) {
            return [
                new SelectOption(
                    title: 'Skip',
                    value: null,
                ),
                ...$options,
            ];
        }

        return $options;
    }
}
