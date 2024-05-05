<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database;

use Yiisoft\Yii\Installer\Questions\Fields\SelectField;
use Yiisoft\Yii\Installer\Questions\Question;
use Yiisoft\Yii\Installer\Steps\Database\Handlers\InstallPackagesHandler;

final class DatabaseQuestion extends Question
{
    public function __construct(
        string $resultClass = DatabaseQuestionsResult::class,
        array $handlers = [
            new InstallPackagesHandler(),
        ],
    ) {
        parent::__construct($resultClass, $handlers);
    }

    public function fields(): \Generator
    {
        /** @var ?DatabaseType $dbType */
        $dbType = yield new SelectField(
            name: 'type',
            question: 'Which database do you want to use?',
            options: DatabaseType::class,
            help: null,
            required: false,
        );

        if ($dbType) {
            yield new DbCredentialsQuestion();
        }
    }
}
