<?php
define('indirect', 1);

use nickschlobohm\Flatfoot;

include_once __DIR__ . '/../vendor/autoload.php';

Flatfoot\Config::$sRequestPath = $_SERVER['PATH_INFO'] ?? '/index';

?>
<?= Flatfoot\Template::header() ?>
<?php Flatfoot\Template::include (Flatfoot\Config::$sRequestPath) ?>
<?= Flatfoot\Template::footer() ?>