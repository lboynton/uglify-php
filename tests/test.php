<?php

use UglifyPHP\JS;
use UglifyPHP\CSS;

require_once __DIR__ . '/../vendor/autoload.php';

// Check the classes are working
echo JS::installed();
echo CSS::installed();