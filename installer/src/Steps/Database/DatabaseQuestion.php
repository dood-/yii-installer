<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database;

use Generator;
use Yiisoft\Yii\Installer\Questions\Fields\BooleanField;
use Yiisoft\Yii\Installer\Questions\Fields\SelectField;
use Yiisoft\Yii\Installer\Questions\Fields\TextField;
use Yiisoft\Yii\Installer\Questions\Question;
use Yiisoft\Yii\Installer\Steps\Database\Handlers\InstallPackagesHandler;

final class DatabaseQuestion extends Question
{
    public function __construct(
        string $resultType = DatabaseQuestionsResult::class,
        array $handlers = [
            new InstallPackagesHandler(),
        ],
    ) {
        parent::__construct($resultType, $handlers);
    }

    public function fields(): Generator
    {
        $dbType = yield new SelectField(
            name: 'type',
            question: 'Which database do you want to use?',
            options: DatabaseType::class,
            help: null,
            required: false,
        );

        if (!$dbType) {
            return null;
        }

        $needPassword = yield new BooleanField(
            name: 'need_password',
            question: 'Do you want to set a password?',
        );

        if ($needPassword) {
            yield new TextField(
                name: 'user',
                question: 'User',
                required: true,
            );

            yield new TextField(
                name: 'password',
                question: 'Password',
            );
        }
    }
}
