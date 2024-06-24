<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Installer\Tests\Internal\Questions\Fields;

use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Installer\Internal\Questions\Fields\TextField;

final class TextFieldTest extends TestCase
{
    public function testBase(): void
    {
        $field = new TextField(
            'test name',
            'test question',
            'test help',
            true,
            'default value',
        );

        $this->assertSame('test name', $field->name);
        $this->assertSame('test question', $field->question);
        $this->assertSame('test help', $field->help);
        $this->assertTrue($field->required);
        $this->assertSame('default value', $field->default);
    }
}
