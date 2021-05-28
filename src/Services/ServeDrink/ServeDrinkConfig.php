<?php


namespace Adsmurai\CoffeeMachine\Services\ServeDrink;


use Adsmurai\CoffeeMachine\Interfaces\iDrink;

class ServeDrinkConfig
{
    /**
     * @var iDrink
     */
    private $drinkModel;

    /**
     * @var float
     */
    private $money;

    public function __construct(iDrink $drinkModel,float $money)
    {
        $this->drinkModel = $drinkModel;
        $this->money = $money;
    }

    public function getDrinkModel() : iDrink
    {
        return $this->drinkModel;
    }

    public function getMoney() : float
    {
        return $this->money;
    }
}