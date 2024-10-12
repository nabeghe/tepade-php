<?php file_exists('../vendor/autoload.php') ? require '../vendor/autoload.php' : exit;

use Nabeghe\Tepade\Tepade;

Tepade::detect(
    'The package name is {name}',
    'The package name is nabeghe/text-params-detector',
    function (?array $params, ?string $text, string $customArg) {
        echo "The package name = $params[name]\n";
        echo "The custom argument = $customArg\n";
    },
    null,
    ['14'],
);