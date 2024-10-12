<?php file_exists('../vendor/autoload.php') ? require '../vendor/autoload.php' : exit;

use Nabeghe\Tepade\Tepade;

Tepade::detect(
    'The package name is {name}',
    'The package name is nabeghe/text-params-detector',
    // By making the first parameter nullable, the callback will be executed even if there is no match.
    function (array $params, ?string $text) {
        echo "The package name = $params[name]\n";
        echo "The package name from index = $params[0]\n";
    },
);