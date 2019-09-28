<?php
function autoloader($class_name)
{
    include 'model/' . $class_name . '.Class.php';
}

spl_autoload_register('autoloader');

$form = false;
if (isset($_REQUEST['form'])) {
  $form = $_REQUEST['form'];
}
