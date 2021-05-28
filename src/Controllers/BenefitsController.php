<?php


namespace Adsmurai\CoffeeMachine\Controllers;


use Adsmurai\CoffeeMachine\Console\MysqlPdoClient;

class BenefitsController
{
    public function getAllBenefits() : array
    {
        $pdo = MysqlPdoClient::getPdo();

        $totalBenefits =[];
        $stmt = $pdo->query("Select drink_type, SUM(cost) as totalbenefit from orders group by drink_type");
        while ($row = $stmt->fetch()) {
            $totalBenefits[] = ['drinkType' => $row['drink_type'], 'benefit' => number_format($row['totalbenefit'], 2)];
        }

        return $totalBenefits;
    }

    public function getAllBenefitsText()
    {
        $totalBenefits = $this->getAllBenefits();

        if (count($totalBenefits)) {
            $mask = "|%15.15s |%15.15s | \n";
            printf($mask, 'Drink', 'Money');
            foreach ($totalBenefits as $drinkType) {
                printf($mask, ucfirst($drinkType['drinkType']), $drinkType['benefit']);
            }
        } else {
            printf('There are no benefits yet');
        }
    }
}