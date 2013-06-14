<?php

namespace UglifyPHP;

class JS extends Uglify
{
    protected static $location = 'uglifyjs';
    protected static $exists_check = ' -V';
}