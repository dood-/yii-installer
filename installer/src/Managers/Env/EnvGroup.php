<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Managers\Env;

use IteratorAggregate;
use Stringable;
use Traversable;

use function implode;
use function is_array;
use function is_bool;
use function is_null;
use function trim;

final class EnvGroup implements Stringable, IteratorAggregate
{
    /**
     * @param array<non-empty-string, mixed> $values
     * @param ?non-empty-string $comment
     */
    public function __construct(
        private array $values = [],
        public readonly ?string $comment = null,
        public readonly int $priority = 0
    ) {
    }

    /**
     * @param non-empty-string $key
     */
    public function addValue(string $key, mixed $value): void
    {
        $this->values[$key] = $value;
    }

    /**
     * @param non-empty-string $key
     */
    public function hasKey(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    public function getIterator(): Traversable
    {
        yield from $this->values;
    }

    public function __toString(): string
    {
        if ($this->values === []) {
            return '';
        }

        $rows = [];

        if ($this->comment !== null) {
            $rows[] = "#$this->comment";
        }

        foreach ($this->values as $key => $value) {
            $rows[] = mb_strtoupper(trim($key)) . '=' . $this->convertValue($value);
        }

        return PHP_EOL . implode(PHP_EOL, $rows);
    }

    private function convertValue(mixed $value): string
    {
        return match (true) {
            is_null($value) => 'NULL',
            is_bool($value) => $value ? 'true' : 'false',
            is_array($value) => "'" . implode(',', $value) . "'",
            default => "'$value'"
        };
    }
}
