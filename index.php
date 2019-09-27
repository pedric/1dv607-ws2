<?php
include_once 'controller/appcontroller.php';
include_once 'partials/header.php';

echo "Index!";

$obj1 = new MemberShipList();
var_dump( $obj1->compactList() );

// $obj = new Member('fred', 'lagesson', '4');
//
// $obj2 = new Boat(23,'sailboat', '6.30');

include_once 'partials/footer.php';
