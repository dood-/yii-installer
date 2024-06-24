<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Tests\Internal\Questions\Fields;

use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Installer\Internal\Questions\Fields\BooleanField;
use Yiisoft\Yii\Installer\Internal\Questions\Fields\OptionsProvider;

final class BooleanFieldTest extends TestCase
{
    public function testBase(): void
    {
        $field = new BooleanField(
            'test name',
            'test question',
            'test help',
        );

        $this->assertInstanceOf(OptionsProvider::class, $field);
        $this->assertSame('test name', $field->name);
        $this->assertSame('test question', $field->question);
        $this->assertSame('test help', $field->help);
        $this->assertTrue($field->required);
        $this->assertCount(2, $field->getOptions());
        $this->assertTrue($field->getOptions()[0]->value);
        $this->assertSame('Yes', $field->getOptions()[0]->title);
        $this->assertFalse($field->getOptions()[1]->value);
        $this->assertSame('No', $field->getOptions()[1]->title);
    }
}
