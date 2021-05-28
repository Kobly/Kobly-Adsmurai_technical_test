<?php


namespace Adsmurai\CoffeeMachine\Models\Drinks;


use Adsmurai\CoffeeMachine\Interfaces\iDrink;

class Coffee implements iDrink
{
    private string $name    = 'coffee';
    private float $cost     = 0.5;
    private int $maxSugar   = 2;
    private int $sugars;
    private bool $extraHot;

    public function __construct(int $sugars, bool $extraHot)
    {
        $this->sugars   = $sugars;
        $this->extraHot = $extraHot;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getCost() : float
    {
        return $this->cost;
    }

    public function getSugars() : int
    {
        return $this->sugars;
    }

    public function getExtraHot() : bool
    {
        return $this->extraHot;
    }
}