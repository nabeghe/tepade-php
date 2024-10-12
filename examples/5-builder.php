<?php file_exists('../vendor/autoload.php') ? require '../vendor/autoload.php' : exit;

use Nabeghe\Tepade\Tepade;

Tepade::new(
    'The package name is {name}',
    'The package name is nabeghe/text-params-detector'
)->callback(function (?array $params, ?string $text) {
    echo "The package name = `$params[name]`\n";
    echo "The package name from index 0 = `$params[0]`\n";
})->detect();