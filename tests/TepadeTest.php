<?php declare(strict_types=1);

use Nabeghe\Tepade\Tepade;
use Nabeghe\Tepade\Validators;

class TepadeTest extends \PHPUnit\Framework\TestCase
{
    public function testeDetectedResult(): void
    {
        $params = Tepade::detect(
            'The package name is {name}',
            'The package name is nabeghe/text-params-detector',
        );
        $this->assertIsArray($params);
        $this->assertSame('nabeghe/text-params-detector', $params['name']);
        $this->assertSame('nabeghe/text-params-detector', $params[0]);
    }

    public function testDetectedResultNull(): void
    {
        $params = Tepade::detect(
            'The package name is {name}',
            'nabeghe/text-params-detector',
        );
        $this->assertNull($params);
    }

    public function testDetectionCallback(): void
    {
        Tepade::detect(
            'The package name is {name}',
            'The package name is nabeghe/text-params-detector',
            function (?array $params, ?string $text) {
                $this->assertIsArray($params);
                $this->assertSame('nabeghe/text-params-detector', $params['name']);
                $this->assertSame('nabeghe/text-params-detector', $params[0]);
            },
        );
    }

    public function testDetectionCallbackNull(): void
    {
        Tepade::detect(
            'The package name is {name}',
            'nabeghe/text-params-detector',
            function (?array $params, ?string $text) {
                $this->assertNull($params);
            },
        );
    }

    public function testDetectionCallbackCustomArgs(): void
    {
        Tepade::detect(
            'The package name is {name}',
            'The package name is nabeghe/text-params-detector',
            function (?array $params, ?string $text, string $customArg) {
                $this->assertSame('This is custom argument', $customArg);
            },
            null,
            ['This is custom argument'],
        );
    }

    public function testDetectionValidators(): void
    {
        Tepade::detect(
            'The number is {number}',
            'The number is 14',
            function (?array $params, ?string $text) {
                $this->assertIsNumeric('14', $params['number']);
            },
            ['number' => Validators::NUMERIC],
        );
    }

    public function testDetectorBuilder(): void
    {
        Tepade::new(
            'The package name is {name}',
            'The package name is nabeghe/text-params-detector'
        )->callback(function (?array $params, ?string $text) {
            $this->assertSame('nabeghe/text-params-detector', $params['name']);
            $this->assertSame('nabeghe/text-params-detector', $params[0]);
        })->detect();
    }

    public function testMultipleDetectorPatterns(): void
    {
        Tepade::detect(
            [
                'The package name is {name}',
                'My package name is {name}',
            ],
            'My package name is nabeghe/text-params-detector',
            function (array $params, ?string $text) {
                $this->assertSame('My package name is nabeghe/text-params-detector', $text);
                $this->assertSame('nabeghe/text-params-detector', $params['name']);
                $this->assertSame('nabeghe/text-params-detector', $params[0]);
            },
        );
    }

    protected function structure(string $text)
    {
        Tepade::structure(
            [

                // substructure 1
                [
                    // patterns
                    ['The package name is {name}', 'My package name is {name}'],
                    // callback
                    function (array $params, ?string $text) {
                        $this->assertSame('My package name is nabeghe/text-params-detector', $text);
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
            [$this],
        );
    }

    public function testStructure1(): void
    {
        $this->structure('My package name is nabeghe/text-params-detector');
    }

    public function testStructure2(): void
    {
        $this->structure('The number is 14');
    }
}

class NumberCallback
{
    public static function on(array $params, ?string $text, TepadeTest $testCase)
    {
        $testCase->assertIsNumeric('14', $params['number']);
    }
}