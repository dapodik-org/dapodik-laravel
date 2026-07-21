<?php

error_reporting(E_ALL & ~E_DEPRECATED);

$loader = require __DIR__.'/../vendor/autoload.php';

/*
 * Register missing Doctrine DBAL types that Laravel 7/8's ->change() needs.
 * These are not included by default in doctrine/dbal ^2.6.
 */
Doctrine\DBAL\Types\Type::addType('char', 'Doctrine\DBAL\Types\StringType');
Doctrine\DBAL\Types\Type::addType('uuid', 'Doctrine\DBAL\Types\GuidType');
Doctrine\DBAL\Types\Type::addType('timestamp', 'Doctrine\DBAL\Types\DateTimeType');
