<?php

if (php_sapi_name() !== 'cli') {
    die("This script can only be run from the command line.");
}

if ($argc < 2) {
    die("Usage: php main.php <image_path>\n");
}

$imagePath = $argv[1];

if (!file_exists($imagePath)) {
    die("Error: The specified image file does not exist.\n");
}

echo "$imagePath:\n";

$exif = exif_read_data($imagePath, 'IFD0');
echo $exif === false ? "No header data found.\n" : "Image contains headers.\n";

$exif = exif_read_data($imagePath, 0, true);
foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {
        echo "$key.$name: $val\n";
    }
}
