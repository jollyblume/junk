<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/** @var ClassLoader $loader */
$loader = require dirname(__DIR__).'/../../vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
