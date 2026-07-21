<?php

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Doctrine DBAL 4.x removed some types — register them for column introspection
if (class_exists(Type::class)) {
    try {
        Type::addType('timestamp', DateTimeType::class);
    } catch (Exception) {
        // already registered
    }

    try {
        Type::addType('char', StringType::class);
    } catch (Exception) {
        // already registered
    }
}
