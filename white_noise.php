<?php

$numColumns = 640;
$numRows = 360;
$dotSize = 1;
$numFrames = 16;

switch ($_SERVER['argc']) {
    case 5:
        $numFrames = (int)$_SERVER['argv'][4];
        /* FALLTHROUGH */
    case 4:
        $dotSize = (int)$_SERVER['argv'][3];
        /* FALLTHROUGH */
    case 3:
        $numRows = (int)$_SERVER['argv'][2];
        /* FALLTHROUGH */
    case 2:
        $numColumns = (int)$_SERVER['argv'][1];
        /* FALLTHROUGH */
    default:
        /* nothing */
}

try {

    if ($numColumns <= 0) {
        throw new Exception('Invalid number of columns specified');
    }

    if ($numRows <= 0) {
        throw new Exception('Invalid number of rows specified');
    }

    if ($dotSize <= 0) {
        throw new Exception('Invalid dot size specified');
    }

    if ($numFrames <= 0) {
        throw new Exception('Invalid number of frames specified');
    }

    $dir = 'noise';

    if (!is_dir($dir) && !mkdir($dir)) {
        throw new Exception("Failed to create directory '{$dir}'");
    }

    $width = $numColumns * $dotSize;
    $height = $numRows * $dotSize;

    $pad = strlen((string)($numFrames - 1));

    for ($frame = 0; $frame < $numFrames; ++$frame) {

        $file = sprintf("noise%0{$pad}d.gif", $frame);

        $image = imagecreatetruecolor($width, $height);

        if ($image === false) {
            throw new Exception("Failed to create image for '{$file}'");
        }

        $white = imagecolorallocate($image, 255, 255, 255);

        for ($row = 0; $row < $numRows; ++$row) {
            for ($column = 0; $column < $numColumns; ++$column) {
                if (rand(0, 1)) {
                    for ($yo = 0; $yo < $dotSize; ++$yo) {
                        for ($xo = 0; $xo < $dotSize; ++$xo) {
                            $x = $column * $dotSize + $xo;
                            $y = $row * $dotSize + $yo;
                            if (!imagesetpixel($image, $x, $y, $white)) {
                                throw new Exception("Failed to set pixel ({$x}, {$y}) for file '{$file}'");
                            }
                        }
                    }
                }
            }
        }

        $path = "{$dir}/{$file}";

        if (!imagegif($image, $path)) {
            throw new Exception("Failed to write file '{$path}'");
        }

        imagedestroy($image);

        echo "Wrote {$path}\n";

    }

    echo "Done\n";

} catch (Exception $e) {
    die("{$e->getMessage()}\n");
}

