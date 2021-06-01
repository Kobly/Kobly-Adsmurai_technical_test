<?php

namespace Adsmurai\CoffeeMachine\Tests\Unit\Console;

use Adsmurai\CoffeeMachine\Models\Drinks\DrinkFactory;
use Adsmurai\CoffeeMachine\Services\ServeDrink\ServeDrinkConfig;
use Adsmurai\CoffeeMachine\Services\ServeDrink\ServeDrinkService;
use Adsmurai\CoffeeMachine\Tests\Integration\IntegrationTestCase;

class ServeDrinkServiceTest extends IntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @dataProvider ordersProvider
     */
    public function testCreateServeDrinkConfig(
        string $drinkType,
        string $money,
        int $sugars,
        int $extraHot,
        string $expectedOutput
    ): void {
        $drinkFactory = new DrinkFactory();
        $drinkClass = $drinkFactory->create($drinkType, $sugars, $extraHot);
        $serveDrinkConfig = new ServeDrinkConfig($drinkClass, $money);
        $serveDrinkService = new ServeDrinkService($serveDrinkConfig);
        $serveDrinkServiceResponse = $serveDrinkService->execute();
        $this->assertSame($expectedOutput, $serveDrinkServiceResponse);
    }

    public function ordersProvider(): array
    {
        return [
            [
                'chocolate', '0.7', 1, 0, 'You have ordered a chocolate with 1 sugars (stick included)'
            ],
            [
                'tea', '0.4', 0, 1, 'You have ordered a tea extra hot'
            ],
            [
                'coffee', '2', 2, 1, 'You have ordered a coffee extra hot with 2 sugars (stick included)'
            ],
            [
                'coffee', '0.2', 2, 1, 'The coffee costs 0.5.'
            ],
            [
                'chocolate', '0.3', 2, 1, 'The chocolate costs 0.6.'
            ],
            [
                'tea', '0.1', 2, 1, 'The tea costs 0.4.'
            ],
            [
                'tea', '0.5', -1, 1, 'The number of sugars should be between 0 and 2.'
            ]
        ];
    }
}
