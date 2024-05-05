<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Steps\Template;

use Yiisoft\Yii\Installer\Internal\Questions\Fields\SelectField;
use Yiisoft\Yii\Installer\Internal\Questions\Question;
use Yiisoft\Yii\Installer\Steps\Template\Console\ConsoleTemplateQuestion;

final class TemplateQuestion extends Question
{
    public function __construct(
        string $resultClass = TemplateQuestionResult::class,
        array $handlers = [],
    ) {
        parent::__construct($resultClass, $handlers);
    }

    public function fields(): \Generator
    {
        /** @var TemplateType $template */
        $template = yield new SelectField(
            name: 'type',
            question: 'Which type of application do you want to create?',
            options: TemplateType::class,
            help: null,
            required: true,
        );

        yield match ($template) {
            TemplateType::App => throw new \Exception('To be implemented'),
            TemplateType::Console => new ConsoleTemplateQuestion(),
        };
    }
}
