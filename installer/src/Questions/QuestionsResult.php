<?php

namespace Yiisoft\Yii\Installer\Questions;

abstract class QuestionsResult
{
    //public function __construct(array $args)
    //{
    //    foreach ($args as $key => $value) {
    //        if (property_exists($this, $key)) {
    //            $this->$key = $value;
    //        }
    //    }
    //}

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
