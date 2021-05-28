<?php


namespace Adsmurai\CoffeeMachine\Models\Drinks;


use Adsmurai\CoffeeMachine\Interfaces\iDrink;

class Tea implements iDrink
{
    private string $name    = 'tea';
    private float $cost     = 0.4;
    private int $maxSugar   = 2;
    private int $sugars;
    private bool $extraHot;

    public function __construct(int $sugars, bool $extraHot)
    {
        $this->sugars   = $sugars;
        $this->extraHot = $extraHot;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getSugars()
    {
        return $this->sugars;
    }

    public function getExtraHot()
    {
        return $this->extraHot;
    }
}