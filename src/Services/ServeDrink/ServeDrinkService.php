<?php


namespace Adsmurai\CoffeeMachine\Services\ServeDrink;

use Adsmurai\CoffeeMachine\Interfaces\iDrink;
use Adsmurai\CoffeeMachine\Services\SaveDrinkInfo\SaveDrinkInfoConfig;
use Adsmurai\CoffeeMachine\Services\SaveDrinkInfo\SaveDrinkInfoService;

class ServeDrinkService
{
    const MAX_SUGARS = 2;

    /** @var ServeDrinkConfig */
    private $serveDrinkConfig;

    public function __construct(ServeDrinkConfig $serveDrinkConfig)
    {
        $this->serveDrinkConfig = $serveDrinkConfig;
    }

    public function execute() : string
    {
        $drinkModel = $this->serveDrinkConfig->getDrinkModel();
        $response = $this->validate($drinkModel);

        if (empty($response)) {
            $sugars = $drinkModel->getSugars();
            if ($sugars >= 0 && $sugars <= self::MAX_SUGARS) {
                $response  = 'You have ordered a ' . $drinkModel->getName();
                $response .= ($drinkModel->getExtraHot()) ? ' extra hot' : '';
                $response .= ($sugars > 0) ? ' with ' . $sugars . ' sugars (stick included)' : '';
                $saveDrinkInfoConfig  = new SaveDrinkInfoConfig($drinkModel);
                $saveDrinkInfoService = new SaveDrinkInfoService($saveDrinkInfoConfig);
                $saveDrinkInfoService->execute();
            } else {
                $response = 'The number of sugars should be between 0 and 2.';
            }
        }

        return $response;
    }

    private function validate(iDrink $drinkModel) : string
    {
        $validateText = '';
        if ($drinkModel->getCost() > $this->serveDrinkConfig->getMoney()) {
            $validateText = 'The ' . $drinkModel->getName() . ' costs ' . $drinkModel->getCost() . '.';
        }

        return $validateText;
    }
}