<?php

namespace UglifyPHP;

class JS extends Uglify
{
    protected static $location = 'uglifyjs';
    protected static $exists_check = ' -V';
    protected static $options = array(
        'source-map',
        'source-map-root',
        'source-map-url',
        'in-source-map',
        'screw-ie8',
        'prefix',
        'output',
        'beautify',
        'mangle',
        'reserved',
        'compress',
        'define',
        'comments',
        'acorn',
        'spidermonkey',
        'self',
        'wrap',
        'export-all'
    );
    protected static $option_place = 'after';
}