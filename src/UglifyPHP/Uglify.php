<?php

namespace UglifyPHP;

abstract class Uglify
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

    public function minify($path, $opts = array())
    {
        $path = escapeshellarg($path);
        $files = implode(' ', array_map(function ($file) {
            return escapeshellarg($file);
        }, $this->files));
        $options = $this->options_string($opts);
        $exec = static::$location;

        if (static::$option_place === 'before') {
            $cmd = "{$exec} {$options} {$files} > {$path}";
        } else {
            $cmd = "{$exec} {$files} {$options} > {$path}";
        }

        exec($cmd, $output, $return);

        if ($return === 0) {
            return true;
        }

        return false;
    }

    private function options_string($opts)
    {
        $options = '';

        foreach ($opts as $name => $value) {
            if (in_array($name, static::$options)) {
                if ($value === true) {
                    $options .= '--' . $name;
                } else if (is_string($value)) {
                    $options .= '--' . $name . ' ' . escapeshellarg($value);
                } else {
                    throw new \Exception('Value of "' . $name . '" in ' . get_called_class() . ' must be a string');
                }
            } else {
                throw new \Exception('Unsupported option "' . $name . '" in ' . get_called_class());
            }
        }

        return $options;
    }
}