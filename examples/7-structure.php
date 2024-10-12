<?php file_exists('../vendor/autoload.php') ? require '../vendor/autoload.php' : exit;

use Nabeghe\Tepade\Tepade;
use Nabeghe\Tepade\Validators;

function structure($text)
{
    Tepade::structure(
        [

            // substructure 1
            [
                // patterns
                ['The package name is {name}', 'My package name is {name}'],
                // callback
                function (array $params, ?string $text) {
                    echo "The package name = `$params[name]`\n";
                    echo "The package name from index 0 = `$params[0]`\n";
                },
                // validators
                null,
            ],

            // substructure 2 : class mode
            NumberCallback::class => [
                // pattern
                'The number is {number}',
                // validators
                ['number' => Validators::NUMERIC],
            ],

        ],
        // text
        $text,
        // custom args
        null,
    );
}

class NumberCallback
{
    public static function on(array $params, ?string $text)
    {
        echo "The number = $params[number]\n";
    }
}

structure('My package name is nabeghe/text-params-detector');
structure('The number is 14');