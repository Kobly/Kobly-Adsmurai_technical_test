<?php

namespace Adsmurai\CoffeeMachine\Console;

use Adsmurai\CoffeeMachine\Controllers\BenefitsController;
use Adsmurai\CoffeeMachine\Controllers\DrinkController;
use Adsmurai\CoffeeMachine\Models\Drinks\DrinkFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    protected function configure()
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $drinkController = new DrinkController();
        $response = $drinkController->mainAction(
            strtolower($input->getArgument('drink-type')),
            (float)$input->getArgument('money'),
            (int)$input->getArgument('sugars'),
            (bool)$input->getOption('extra-hot'));
        $output->writeln($response);
    }
}
