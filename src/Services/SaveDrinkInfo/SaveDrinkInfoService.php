<?php


namespace Adsmurai\CoffeeMachine\Services\SaveDrinkInfo;


use Adsmurai\CoffeeMachine\Console\MysqlPdoClient;

class SaveDrinkInfoService
{
    /**
     * @var SaveDrinkInfoConfig
     */
    private $saveDrinkInfoConfig;

    public function __construct(SaveDrinkInfoConfig $saveDrinkInfoConfig)
    {
        $this->saveDrinkInfoConfig = $saveDrinkInfoConfig;
    }

    public function execute()
    {
        $drinkModel = $this->saveDrinkInfoConfig->getDrinkModel();
        $pdo = MysqlPdoClient::getPdo();

        $stmt = $pdo->prepare('INSERT INTO orders (drink_type, sugars, stick, extra_hot, cost) VALUES (:drink_type, :sugars, :stick, :extra_hot, :cost)');
        $stmt->execute([
            'drink_type'    => $drinkModel->getName(),
            'sugars'        => $drinkModel->getSugars(),
            'stick'         => ($drinkModel->getSugars() > 0) ?: 0,
            'extra_hot'     => $drinkModel->getExtraHot() ?: 0,
            'cost'          => $drinkModel->getCost()
        ]);
    }
}