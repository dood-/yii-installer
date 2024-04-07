<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Managers\Env;

use Traversable;

use function array_map;
use function implode;
use function uasort;

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
        uasort($this->groups, static fn(EnvGroup $a, EnvGroup $b) => $a->priority <=> $b->priority);

        $groups = array_map('strval', $this->groups);

        return implode(PHP_EOL, $groups) . PHP_EOL;
    }

    /**
     * @param array<non-empty-string, mixed> $values
     * @param ?non-empty-string $comment
     */
    public function addGroup(array $values, ?string $comment = null, int $priority = 0): self
    {
        foreach ($values as $key => $value) {
            foreach ($this->groups as $group) {
                if ($group->hasKey($key)) {
                    $group->addValue($key, $values);
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
     */
    public function addValue(string $key, mixed $value): self
    {
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
