<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Internal\Managers\Composer;

use Composer\Json\JsonFile;
use Exception;
use Seld\JsonLint\ParsingException;

final class ComposerJsonStorage
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
        if (empty($config['require'])) {
            $config['require'] = new \stdClass();
        }

        if (empty($config['require-dev'])) {
            $config['require-dev'] = new \stdClass();
        }

        $this->file->write($config);
    }
}
