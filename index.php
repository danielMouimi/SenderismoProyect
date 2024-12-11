<?php
require_once 'config/config.php';
require "vendor/autoload.php";
require "./autoload.php";
require_once 'Views/Layout/header.php';

use Controllers\FrontController;

FrontController::main();

require_once 'Views/Layout/footer.php';
?>