<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Database;

use Yiisoft\Yii\Installer\Questions\Fields\BooleanField;
use Yiisoft\Yii\Installer\Questions\Fields\TextField;
use Yiisoft\Yii\Installer\Questions\Question;
use Yiisoft\Yii\Installer\Steps\Database\Handlers\CredentialsHandler;

final class DbCredentialsQuestion extends Question
{
    public function __construct(
        string $resultClass = DbCredentialsQuestionsResult::class,
        array $handlers = [
            new CredentialsHandler(),
        ],
    ) {
        parent::__construct($resultClass, $handlers);
    }

    public function fields(): \Generator
    {
        /** @var bool $needPassword */
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
