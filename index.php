<?php
include_once 'controller/appcontroller.php';
include_once 'partials/header.php';

echo "Index!";

$obj1 = new MemberShipList();
echo '<pre>';
$obj1->verboseList();
echo '</pre>';
// $boat = new Boat("5d8e6f666564e","sailboat", 7.4);
//
// $obj2 = new Member();
//
// $obj2->addBoat("5d8e6f666564e",$boat);
// $obj2->updateMember("5d8e6f79b940a","Richard","Louis");

// echo $form;

include_once 'partials/footer.php';
