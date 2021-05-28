<?php


namespace Adsmurai\CoffeeMachine\Services\SaveDrinkInfo;

use Adsmurai\CoffeeMachine\Interfaces\iDrink;

class SaveDrinkInfoConfig
{
    /**
     * @var iDrink
     */
    private $drinkModel;

    public function __construct(iDrink $drinkModel)
    {
        $this->drinkModel = $drinkModel;
    }

    public function getDrinkModel() : iDrink
    {
        return $this->drinkModel;
    }
}