#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Adsmurai\CoffeeMachine\Console;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new Console\MakeDrinkCommand());
$application->add(new Console\GetBenefitsCommand());

$application->run();
