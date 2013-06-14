<?php

namespace smallhadroncollider\UglifyPHP;

abstract class UglifyPHP
{
    /**
     * Sets the location of the executable
     * @param String $file Path of executable
     * @return void
     */
    public static final function location($file)
    {
        if (file_exists($file)) {
            static::$location = $file;
        } else {
            throw new \Exception('Uglify.js not found at ' . $file);
        }
    }

    /**
     * Checks for an exit code of 0 on uglifyjs -V (version number)
     * @return Boolean
     */
    public static final function installed()
    {
        if (!isset(static::$location)) {
            throw new \Exception('protected static $location not set on ' . get_called_class());
        }

        if (!isset(static::$exists_check)) {
            throw new \Exception('protected static $exists_check not set on ' . get_called_class());
        }

        exec(static::$location . static::$exists_check, $output, $return);

        if ($return === 0) {
            return true;
        }

        return false;
    }

    /**
     * Takes an array of files to minify
     * @param Array/String $files An array of file paths or a single path
     * @return void
     */
    public function __construct($files = array())
    {
        if (is_string($files)) {
            $files = array($files);
        }

        $this->files = $files;
    }

    public function minify($path)
    {
        $exec = static::$location;
        $files = implode(' ', $this->files);
        $cmd = "{$exec} {$files} > {$path}";

        exec($cmd, $output, $return);

        if ($return === 0) {
            return true;
        }

        return false;
    }
}