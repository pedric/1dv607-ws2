<?php
// function autoloader($class_name)
// {
//     include './model/' . $class_name . '.Class.php';
// }

// spl_autoload_register('autoloader');

include './model/Member.Class.php';
include './model/MembershipList.Class.php';
include './model/Boat.Class.php';

$form = false;
if (isset($_REQUEST['form'])) {
  $form = $_REQUEST['form'];
}
