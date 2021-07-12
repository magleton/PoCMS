<?php

use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Version;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;

try {
    date_default_timezone_set('Asia/Shanghai');
    defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT_PATH', __DIR__);
    define('APP_NAME', 'task');
    define('APP_PATH', ROOT_PATH . '/' . APP_NAME . '/');
    require ROOT_PATH . '/vendor/autoload.php';
    $app = new \Polymer\Boot\Application();
    $app->runConsole();
    $em = app()->db('db1', ROOT_PATH . DS . 'app' . DS .'WeiXin'.DS.'Entity'.DS.'Mapping');
    $helperSet = new HelperSet([
        new EntityManagerHelper($em )
    ]);
    $cli = new Application('Doctrine Command Line Interface', Version::VERSION);
    $cli->setCatchExceptions(true);
    $cli->setHelperSet($helperSet);
    $cli->addCommands([
            new DiffCommand(),
            new ExecuteCommand(),
            new GenerateCommand(),
            new MigrateCommand(),
            new StatusCommand(),
            new VersionCommand()
        ]
    );
    ConsoleRunner::addCommands($cli);
    $cli->run();
} catch (Exception $e) {
    print_r($e);
}
