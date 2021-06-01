<?php

namespace Adsmurai\CoffeeMachine\Tests\Integration\Console;

use Adsmurai\CoffeeMachine\Console\GetBenefitsCommand;
use Adsmurai\CoffeeMachine\Interfaces\iDrink;
use Adsmurai\CoffeeMachine\Models\Drinks\DrinkFactory;
use Adsmurai\CoffeeMachine\Services\ServeDrink\ServeDrinkConfig;
use Adsmurai\CoffeeMachine\Tests\Integration\IntegrationTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class DrinkFactoryTest extends IntegrationTestCase
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
        int $sugars,
        int $extraHot
    ): void {
        $drinkFactory = new DrinkFactory();
        $drinkClass = $drinkFactory->create($drinkType, $sugars, $extraHot);
        $this->assertInstanceOf(iDrink::class, $drinkClass);
    }

    public function ordersProvider(): array
    {
        return [
            [
                'chocolate', 1, 0
            ],
            [
                'tea', 0, 1
            ],
            [
                'coffee', 2, 0
            ],
            [
                'coffee', 2, 0
            ],
        ];
    }
}
