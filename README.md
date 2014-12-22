php-white-noise
===============

This is a simple command line white noise GIF generator written in PHP.

It requires the PHP to be installed with GD support. More information is available [on the PHP website](http://php.net/manual/en/ref.image.php).

Usage
-----

```
$ php white_noise.php [numColumns [numRows [dotSize [numFrames]]]]
```

This command will create a directory named "noise" and populate it with *numFrames* GIF files named noise00.gif through noiseNN.gif, each containing a grid of *numColumns* x *numRows* *dotSize*-pixel-squared dots of black or white, randomly selected. These files may then be fed to another utility such as gifsicle to create an animated GIF file.

All arguments are optional. Default values are:
* numColumns = 640
* numRows = 360
* dotSize = 1
* numFrames = 16

Examples
--------

```
$ php white_noise.php
$ php white_noise.php 160 90 4
$ php white_noise.php 32 32 1 100
```

License
-------

php-white-noise
Copyright (C) 2014  Joe Lafiosca <joe@lafiosca.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
