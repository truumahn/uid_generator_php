<?php declare(strict_types = 1);

/**
 * @file
 * Vendor and custom autoloading.
 */

require 'vendor/autoload.php';

//spl_autoload_register(function ($className) {
//  $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
//  $className = substr($className, 13);
//  include_once __DIR__ . '/src/' . $className . '.php';
//});
