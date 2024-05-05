<?php

namespace Yiisoft\Yii\Installer\Internal\Managers\Composer;

enum ComposerPackage: string
{
    case PhpDotEnv = 'vlucas/phpdotenv:^5.3';
    case YiiAliases = 'yiisoft/aliases:^3.0';
    case YiiLog = "yiisoft/log:^2.0";
    case LogTargetFile = "yiisoft/log-target-file:^3.0";
    case YiiConsole = "yiisoft/yii-console:^2.0";
    case YiiRunnerConsole = "yiisoft/yii-runner-console:^2.0";
    case YiiCycle = 'yiisoft/yii-cycle:dev-master';
    case CycleOrm = 'cycle/orm:^2.0';
    case CycleEntityBehavior = 'cycle/entity-behavior:^1.0';
}
