<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Questions\Fields;

final class BooleanField extends Field implements OptionsProvider
{
    /** @var SelectOption[] */
    private readonly array $options;

    public function __construct(
        string $name,
        string $question,
        ?string $help = null,
    ) {
        parent::__construct(
            name: $name,
            question: $question,
            help: $help,
            required: true,
        );

        $this->options = [
            new SelectOption(
                title: 'Yes',
                value: true,
            ),
            new SelectOption(
                title: 'No',
                value: false,
            )
        ];
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
