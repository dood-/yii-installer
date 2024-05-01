<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Questions;

use Yiisoft\Yii\Installer\Console\ConsoleIO;
use Yiisoft\Yii\Installer\Questions\Fields\Field;

final class QuestionFieldsHandler
{
    public function __construct(
        private readonly ConsoleIO $io,
    ) {
    }

    public function handle(Question $question): ?QuestionsResult
    {
        $generator = $question->fields();

        $answers = [];

        while ($generator->valid()) {
            /** @var Field $field */
            $field = $generator->current();

            $answer = $this->io->ask($field);
            $answers[$field->name] = $answer;

            $generator->send($answer);
        }

        return new ($question->resultType)(...$answers);
    }
}
