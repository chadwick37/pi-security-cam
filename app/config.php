<?php
use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;

// Database information
$capsule->addConnection(array(
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'db',
    'username' => 'root',
    'password' => 'password',
    'collation' => 'utf8_general_ci',
    'prefix' => ''
));

$capsule->setAsGlobal();
$capsule->bootEloquent();
// set timezone for timestamps etc
date_default_timezone_set('UTC');
