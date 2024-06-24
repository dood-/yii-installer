<?php

namespace Yiisoft\Yii\Installer\Internal\Managers\Composer;

use Exception;
use Seld\JsonLint\ParsingException;

interface ComposerStorage
{
    /**
     * @throws ParsingException
     */
    public function read(): array;

    /**
     * @throws Exception
     */
    public function write(array $config): void;
}
