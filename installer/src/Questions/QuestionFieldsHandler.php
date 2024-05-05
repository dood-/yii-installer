<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Questions;

use Yiisoft\Yii\Installer\Console\ConsoleIO;
use Yiisoft\Yii\Installer\Internal\InstallerContext;

final class QuestionFieldsHandler
{
    private array $results = [];

    public function __construct(
        private readonly ConsoleIO $io,
        private readonly InstallerContext $context,
    ) {
    }

    public function handle(Question $question): array
    {
        $this->handleQuestion($question);

        return $this->results;
    }

//    public function getResults(): array
//    {
//        return $this->results;
//    }

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

        if ($answers !== []) {
            $this->context->questionResultCollection->add(
                questionType: $question::class,
                result: $question->resultClass::fromArray($answers),
            );
        }
    }
}
