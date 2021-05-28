<?php
namespace Adsmurai\CoffeeMachine\Interfaces;

interface iDrink
{
    public function getName();

    public function getCost();

    public function getSugars();

    public function getExtraHot();
}