<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Console;

use Composer\IO\IOInterface;
use Yiisoft\Yii\Installer\Questions\Fields\Field;
use Yiisoft\Yii\Installer\Questions\Fields\OptionsProvider;
use Yiisoft\Yii\Installer\Questions\Fields\SelectOption;

use function in_array;
use function strtolower;

final class ConsoleIO
{
    public function __construct(
        private readonly IOInterface $io,
    ) {
    }

    public function ask(Field $field): mixed
    {
        if ($field instanceof OptionsProvider) {
            return $this->askOption($field);
        }

        return $this->askText($field);
    }

    public function askOption(Field $field): mixed
    {
        if (!$field instanceof OptionsProvider) {
            throw new \InvalidArgumentException('Options provider must be instance of OptionsProvider');
        }

        $options = $field->getOptions();
        $choices = array_map(static fn(SelectOption $option) => $option->title, $options);

        $hasHelp = !empty($field->help);
        if ($hasHelp) {
            $choices[] = $field->help;
            $helpIndex = count($choices) - 1;
        }

        while (true) {
            $selected = $this->io->select(
                question: $field->question,
                choices: $choices,
                default: $field->default ?: '0',
            );

            $isHelp = in_array(strtolower((string) $selected), ['?', 'h', 'help']);

            if ($isHelp || ($hasHelp && $helpIndex === $selected)) {
                if ($hasHelp) {
                    $this->io->write($field->help);
                } else {
                    $this->io->error('Help is not available');
                }
            } elseif (array_key_exists($selected, $options)) {
                break;
            } else {
                $this->io->error('Invalid choice');
            }
        }

        return $options[$selected]->value;
    }

    public function askText(Field $question): string|bool|int|float|null
    {
        if ($question->required) {
            while (true) {
                $answer = $this->io->ask($question->question . ': ');
                if (!empty($answer)) {
                    return $answer;
                }
            }
        }

        return $this->io->ask($question->question . ': ');
    }

    // todo public function test()
    //{
    //    $terminal = new Terminal();
    //    $this->io->write('<fg=black;bg=cyan>' . str_pad('=', $terminal->getWidth(), '=') . '</>');
    //}
}
