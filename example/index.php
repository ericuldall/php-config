<?php

require_once('../src/Config.php');

$config = (new Config())->getConfig();
var_dump($config);
