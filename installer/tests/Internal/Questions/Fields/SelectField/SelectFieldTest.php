<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Tests\Internal\Questions\Fields\SelectField;

use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Installer\Internal\Questions\Fields\OptionsProvider;
use Yiisoft\Yii\Installer\Internal\Questions\Fields\SelectField;

final class SelectFieldTest extends TestCase
{
    public function testBase(): void
    {
        $field = new SelectField(
            'test name',
            'test question',
            [],
            help: 'test help',
        );

        $this->assertInstanceOf(OptionsProvider::class, $field);
        $this->assertSame('test name', $field->name);
        $this->assertSame('test question', $field->question);
        $this->assertSame('test help', $field->help);
        $this->assertFalse($field->required);
        $this->assertCount(1, $field->getOptions());
        $this->assertSame('Skip', $field->getOptions()[0]->title);
        $this->assertNull($field->getOptions()[0]->value);
    }

    public function testEnumQuestions(): void
    {
        $field = new SelectField(
            'test name',
            'test question',
            QuestionsWithLabels::class,
            required: true,
        );

        $this->assertInstanceOf(OptionsProvider::class, $field);
        $this->assertSame('test name', $field->name);
        $this->assertSame('test question', $field->question);
        $this->assertTrue($field->required);
        $this->assertCount(2, $field->getOptions());
        $this->assertSame('test 2', $field->getOptions()[1]->title);
        $this->assertEquals(QuestionsWithLabels::Test2, $field->getOptions()[1]->value);
    }
}
