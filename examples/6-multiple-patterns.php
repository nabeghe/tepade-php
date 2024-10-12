<?php file_exists('../vendor/autoload.php') ? require '../vendor/autoload.php' : exit;

use Nabeghe\Tepade\Tepade;

Tepade::detect(
    [
        'The package name is {name}',
        'My package name is {name}',
    ],
    'My package name is nabeghe/text-params-detector',
    function (array $params, ?string $text) {
        echo "Text = $text\n";
        echo "The package name = `$params[name]`\n";
        echo "The package name from index 0 = `$params[0]`\n";
    },
);