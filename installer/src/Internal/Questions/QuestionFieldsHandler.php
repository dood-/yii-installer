<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Questions;

use Yiisoft\Yii\Installer\Internal\Console\ConsoleIO;
use Yiisoft\Yii\Installer\Internal\InstallerContext;

final class QuestionFieldsHandler
{
    public function __construct(
        private readonly ConsoleIO $io,
        private readonly InstallerContext $context,
    ) {
    }

    public function handle(Question $question): void
    {
        $this->handleQuestion($question);
    }

    private function handleQuestion(Question $question): void
    {
        $generator = $question->fields();

        $answers = [];

        while ($generator->valid()) {
            $field = $generator->current();

            if ($field instanceof Question) {
                $this->handleQuestion($field);
                $generator->send($this->results[$field::class] ?? null);
            } else {
                $answer = $this->io->ask($field);
                $answers[$field->name] = $answer;

                $generator->send($answer);
            }
        }

        $this->context->questionResultCollection->add(
            questionType: $question::class,
            result: $question->resultClass::fromArray($answers),
        );
    }
}
