<?php

session_start();

require '../lib/class.config.php';
require '../config/config.php';
require '../lib/class.frontController.php';

try {
  $app = new frontController($config);
  $app->run();
} catch (Exception $exc) {
  echo '<pre>';
  echo $exc->getMessage();
  echo $exc->getTraceAsString();
  echo '</pre>';
}