<?php


namespace Adsmurai\CoffeeMachine\Controllers;

use Adsmurai\CoffeeMachine\Models\Drinks\DrinkFactory;
use Adsmurai\CoffeeMachine\Services\ServeDrink\ServeDrinkConfig;
use Adsmurai\CoffeeMachine\Services\ServeDrink\ServeDrinkService;

class DrinkController
{
    public function mainAction(string $drinkName, float $money, int $sugars, bool $extraHot) : string
    {
        try {
            $drinkFactory = new DrinkFactory();
            $drinkModel = $drinkFactory->create($drinkName, $sugars, $extraHot);
            if (!empty($drinkModel)) {
                $serveDrinkConfig = new ServeDrinkConfig($drinkModel, $money);
                $serveDrinkServide = new ServeDrinkService($serveDrinkConfig);
                $response = $serveDrinkServide->execute();

            } else {
                $response = $this->generateTextErrorDrinkName($drinkFactory);
            }
        } catch (\Exception $e){
            printf('Something has wrong');
        }


        return $response;
    }

    private function generateTextErrorDrinkName(DrinkFactory $drinkFactory) : string
    {
        $typeOfDrinks = $drinkFactory->getTypeOfDrinks();
        $totalDrinks = count($typeOfDrinks);
        $counter = 1;
        $response = 'The drink type should be ';

        foreach ($typeOfDrinks as $name) {
            if ($counter == 1) {
                $response .= $name;
            } elseif($counter == $totalDrinks) {
                $response .= ' or '. $name .'.';
            } else {
                $response .= ', '. $name;
            }

            $counter++;
        }

        return $response;
    }
}