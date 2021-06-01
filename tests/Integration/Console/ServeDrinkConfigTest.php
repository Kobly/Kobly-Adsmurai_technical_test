<?php

namespace Adsmurai\CoffeeMachine\Tests\Integration\Console;

use Adsmurai\CoffeeMachine\Models\Drinks\DrinkFactory;
use Adsmurai\CoffeeMachine\Services\ServeDrink\ServeDrinkConfig;
use Adsmurai\CoffeeMachine\Tests\Integration\IntegrationTestCase;

class ServeDrinkConfigTest extends IntegrationTestCase
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
        int $extraHot
    ): void {
        $drinkFactory = new DrinkFactory();
        $drinkClass = $drinkFactory->create($drinkType, $sugars, $extraHot);
        $serveDrinkConfig = new ServeDrinkConfig($drinkClass, $money);
        $this->assertEquals($drinkClass, $serveDrinkConfig->getDrinkModel());
        $this->assertEquals($money, $serveDrinkConfig->getMoney());
    }

    public function ordersProvider(): array
    {
        return [
            [
                'chocolate', '0.7', 1, 0
            ],
            [
                'tea', '0.4', 0, 1, 1
            ],
            [
                'coffee', '2', 2, 1, 0
            ],
            [
                'coffee', '0.2', 2, 1, 0
            ],
        ];
    }
}
