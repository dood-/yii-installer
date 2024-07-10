<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Managers\Composer;

use Composer\Json\JsonFile;
use Exception;
use Seld\JsonLint\ParsingException;

final class ComposerJsonStorage implements ComposerStorage
{
    public function __construct(
        private readonly JsonFile $file,
    ) {
    }

    /**
     * @throws ParsingException
     */
    public function read(): array
    {
        return $this->file->read();
    }

    /**
     * @throws Exception
     */
    public function write(array $config): void
    {
        foreach ($config as $key => $value) {
            if ($value === []) {
                $config[$key] = new \stdClass();
            }
        }

        $this->file->write($config);
    }
}
