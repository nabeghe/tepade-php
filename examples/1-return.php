<?php file_exists('../vendor/autoload.php') ? require '../vendor/autoload.php' : exit;

use Nabeghe\Tepade\Tepade;

$params = Tepade::detect(
    'The package name is {name}',
    'The package name is nabeghe/text-params-detector',
);
if (is_null($params)) {
    echo "Not detected\n";
} else {
    echo "The package name = `$params[name]`\n";
    echo "The package name from index 0 = `$params[0]`\n";
}