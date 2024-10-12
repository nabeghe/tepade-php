<?php file_exists('../vendor/autoload.php') ? require '../vendor/autoload.php' : exit;

use Nabeghe\Tepade\Tepade;
use Nabeghe\Tepade\Validators;

Tepade::detect(
    'The number is {number}',
    'The number is 14',
    function (array $params, ?string $text) {
        echo "The number = $params[number]\n";
    },
    ['number' => Validators::NUMERIC],
);