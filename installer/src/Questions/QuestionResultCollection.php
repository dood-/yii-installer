<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Questions;

use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

/**
 * @psalm-type ValueType = array{ questionType: class-string<Question>, result: QuestionsResult }
 * @template-implements IteratorAggregate<class-string<Question>, ValueType>
 */
final class QuestionResultCollection implements IteratorAggregate
{
    /**
     * @psalm-param array<array-key, ValueType> $items
     */
    public function __construct(
        private array $items = [],
    ) {
    }

    /**
     * @param class-string<Question> $questionType
     */
    public function add(string $questionType, QuestionsResult $result): void
    {
        if ($this->findByQuestionClass($questionType)) {
            throw new InvalidArgumentException('Question of this type has already been added.');
        }

        $this->items[] = [
            'questionType' => $questionType,
            'result' => $result,
        ];
    }

    /**
     * @param class-string<Question> $questionType
     */
    public function findByQuestionClass(string $questionType): ?QuestionsResult
    {
        foreach ($this->items as $item) {
            if ($item['questionType'] === $questionType) {
                return $item['result'];
            }
        }

        return null;
    }

    /**
     * @psalm-template T of QuestionsResult
     * @psalm-param class-string<T> $questionResultClass
     * @psalm-return T|null
     */
    public function findByResultClass(string $questionResultClass)
    {
        /** @var QuestionsResult $result */
        foreach ($this->items as ['result' => $result]) {
            if ($result::class === $questionResultClass) {
                return $result;
            }
        }

        return null;
    }

    public function getIterator(): Traversable
    {
        foreach ($this->items as $item) {
            yield $item['questionType'] => $item['result'];
        }
    }
}
