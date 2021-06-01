<?php

namespace Adsmurai\CoffeeMachine\Models\Drinks;

use Adsmurai\CoffeeMachine\Interfaces\iDrink;

class DrinkFactory
{
    private array $typeOfDrinks = ['chocolate', 'coffee', 'tea'];

    public function create($className, int $sugars, bool $extraHot) : ?iDrink
    {
        $class = null;

        if (in_array($className, $this->typeOfDrinks)) {
            $classCall = __NAMESPACE__ . '\\' . ucfirst($className);
            $class = new $classCall($sugars, $extraHot);
        }

        return $class;
    }

    public function getTypeOfDrinks() : array
    {
        return $this->typeOfDrinks;
    }
}