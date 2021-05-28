<?php

namespace Adsmurai\CoffeeMachine\Console;

use Adsmurai\CoffeeMachine\Controllers\BenefitsController;
use Adsmurai\CoffeeMachine\Controllers\DrinkController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetBenefitsCommand extends Command
{
    protected static $defaultName = 'app:get-benefits';

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $benefitsController = new BenefitsController();
        $benefitsController->getAllBenefitsText();
    }
}
