<?php

use UglifyPHP\JS;
use UglifyPHP\CSS;

require_once __DIR__ . '/../vendor/autoload.php';

if (JS::installed()) {
    $uglify = new JS(array('js-files/jquery.js', 'js-files/bootstrap.js', 'js-files/script.js'));

    if ($uglify->minify('min.js')) {
        echo '<p>JS compressed</p>';
    } else {
        echo '<p>JS error</p>';
    }
}

if (CSS::installed()) {
    $uglify = new CSS(array('css-files/bootstrap-responsive.css', 'css-files/bootstrap.css', 'css-files/css.css'));

    if ($uglify->minify('min.css', array('max-line-len' => '80'))) {
        echo '<p>CSS compressed</p>';
    } else {
        echo '<p>CSS error</p>';
    }
}