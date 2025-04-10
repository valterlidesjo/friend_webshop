<?php
require_once __DIR__ . '\app\database\seed.php';

$seed = new Seed();
$seed->runSeed();
