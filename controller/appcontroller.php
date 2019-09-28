<?php
  function __autoload($class_name)
  {
      include_once './model/' . $class_name . '.Class.php';
  }

$form = false;
if (isset($_REQUEST['form'])) {
  $form = $_REQUEST['form'];
}
