<?php
chdir('..');
include 'include/class_auto_loader.php';

if (isset($_POST['request']) === FALSE || empty($_POST['request'])) {
  echo "!There is no request.";
  exit;
}

RequestController::execute($_POST['request'], $_POST);
