# UglifyPHP
v1.0.0

A simple PHP wrapper for [Uglify JS](https://github.com/mishoo/UglifyJS2) and [Uglify CSS](https://github.com/fmarcia/UglifyCSS)

## Installation

Simply run `composer require smallhadroncollider/uglify-php`.

## Usage

First make sure you've installed Uglify JS and/or Uglify CSS on your system. You can check for their presence with `which uglifyjs` and `which uglifycss`.

```php
use UglifyPHP\JS;
use UglifyPHP\CSS;

if (JS::installed()) {
    $js = new JS(array('file-1.js', 'file-2.js', 'file-3.js'));

    if ($js->minify('min.js')) {
        // Minification successfull
    } else {
        // Minifcation error
    }
}

if (CSS::installed()) {
    $css = new CSS(array('file-1.css', 'file-2.css', 'file-3.css'));

    if ($css->minify('min.css')) {
        // Minification successfull
    } else {
        // Minification error
    }
}
```

### Options
[Uglify JS](https://github.com/mishoo/UglifyJS2) and [Uglify CSS](https://github.com/fmarcia/UglifyCSS) both support numerous options. You can invoke these by passing an associative array of options to the `minify()` function. Options without a value (e.g. `--wrap`, `--cute-comments`) should be set with a value of `true`. All other values should be passed as strings (even numeric arguments).

```php
$js->minify('output.js', array(
    'screw-ie8' => true,
    'comments' => 'all'
));

$css->minify('output.css', array(
    'cute-comments' => true,
    'max-line-len' => '50'
));
```

#### Available Options
See [Uglify JS](https://github.com/mishoo/UglifyJS2) and [Uglify CSS](https://github.com/fmarcia/UglifyCSS) documentation for details.

##### JS
- source-map
- source-map-root
- source-map-url
- in-source-map
- screw-ie8
- prefix
- output
- beautify
- mangle
- reserved
- compress
- define
- comments
- acorn
- spidermonkey
- self
- wrap
- export-all

##### CSS
- max-line-len
- expand-vars
- ugly-comments
- cute-comments


## Using with a Sandboxed LAMP Server

If you are using a sandboxed LAMP server, such as MAMP, you may find that, even though you have installed Uglify JS/CSS, the `installed()` function returns false. These servers often run in a sandbox which does not support externally installed libraries. There are two approaches that might work (the second being MAMP specific).

### Using the Absolute Path

If you run `which uglifyjs`/`which uglifycss` on the command line you should get the full path name to the `uglifyjs`/`uglifycss` executable. You can ask UglifyPHP to use this full path instead:

```php
JS::location('/usr/local/bin/uglifyjs');
CSS::location('/usr/local/bin/uflifycss');

if (JS::installed()) { /* JS Code */ }
if (CSS::installed()) { /* CSS Code */ }
```

### MAMP Sandboxing

You can turn off MAMP sandboxing by editing the file: `/Applications/MAMP/Library/bin/envvars` (this will affect all sites running on MAMP)

Before:
```
DYLD_LIBRARY_PATH="/Applications/MAMP/Library/lib:$DYLD_LIBRARY_PATH"
export DYLD_LIBRARY_PATH
```

After:
```
# DYLD_LIBRARY_PATH="/Applications/MAMP/Library/lib:$DYLD_LIBRARY_PATH"
# export DYLD_LIBRARY_PATH

export PATH="$PATH:/usr/local/bin"
```

## License

The MIT License (MIT)

Copyright (c) 2013, Small Hadron Collider

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.