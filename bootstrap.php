<?php

require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    "driver" => "mysql",
    "host" =>"mysql",
    "database" => "test_task",
    "username" => "*",
    "password" => "*"

]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();
