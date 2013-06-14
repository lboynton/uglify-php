<?php

namespace smallhadroncollider\UglifyPHP;

class JS extends UglifyPHP
{
    protected static $location = 'uglifyjs';
    protected static $exists_check = ' -V';
}