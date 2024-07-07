<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Managers\Env;

use Traversable;

use function array_map;
use function implode;
use function uasort;

/**
 * @psalm-import-type ValueType from EnvGroup as EnvGroupValueType
 */
final class EnvManager
{
    /** @var EnvGroup[] */
    private array $groups = [];

    public function __construct(
        private readonly string $fileName,
        private readonly string $projectRoot,
    ) {
        $this->groups[0] = new EnvGroup(values: [], priority: 100); // default group
    }

    public function __toString(): string
    {
        uasort($this->groups, static fn(EnvGroup $a, EnvGroup $b) => $b->priority <=> $a->priority);

        $groups = array_map('strval', $this->groups);

        return implode(PHP_EOL, $groups) . PHP_EOL;
    }

    /**
     * @psalm-param array<non-empty-string, EnvGroupValueType> $values
     * @param ?non-empty-string $comment
     */
    public function addGroup(array $values, ?string $comment = null, int $priority = 0): self
    {
        foreach ($values as $key => $value) {
            foreach ($this->groups as $group) {
                if ($group->hasKey($key)) {
                    $group->addValue($key, $value);
                    unset($values[$key]);
                }
            }
        }

        if ($values !== []) {
            $this->groups[] = new EnvGroup($values, $comment, $priority);
        }

        return $this;
    }

    /**
     * @param non-empty-string $key
     * @psalm-param EnvGroupValueType $value
     */
    public function addValue(string $key, mixed $value): self
    {
        /** @var non-empty-string $key */
        $key = mb_strtoupper($key);

        foreach ($this->groups as $group) {
            if ($group->hasKey($key)) {
                $group->addValue($key, $value);
                return $this;
            }
        }

        $this->groups[0]->addValue($key, $value);

        return $this;
    }

    public function getIterator(): Traversable
    {
        foreach ($this->groups as $group) {
            yield from $group;
        }
    }

    public function save(): string
    {
        $content = (string) $this;
        $filePath = $this->projectRoot . $this->fileName;
        file_put_contents($filePath, $content, FILE_APPEND | LOCK_EX);

        return $content;
    }

    /**
     * @param non-empty-string $key
     */
    private function keyExists(string $key): bool
    {
        foreach ($this->groups as $group) {
            if ($group->hasKey($key)) {
                return true;
            }
        }

        return false;
    }
}
