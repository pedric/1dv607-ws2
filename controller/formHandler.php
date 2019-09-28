<?php

$form_type = null;

if (isset($_REQUEST['formtype'])) {
  $form_type = $_REQUEST['formtype'];
}

// Handle case add member
if ($form_type === 'addMember') {
  if ( $_GET['firstName'] && $_GET['lastName'] && $_GET['birthNumber'] ) {
    $member = new Member($_GET['firstName'],$_GET['lastName'],$_GET['birthNumber']);
    $alert = "New member " . $_GET['firstName'] . " " . $_GET['lastName'] . " bnr: " . $_GET['birthNumber'] . " added.";
  }
}
// !end.Handle case add member

// Handle case edit member
if ($form_type === 'editMember') {
  if ( $_GET['firstName'] && $_GET['lastName'] && $_GET['birthNumber'] && $_GET['memberId'] ) {
    Member::updateMember($_GET['memberId'],$_GET['firstName'],$_GET['lastName'],$_GET['birthNumber']);
    $alert = "Member " . $_GET['firstName'] . " " . $_GET['lastName'] . " updated.";
  }
}
// !end.Handle case edit member

// Handle case delete member
if ($form_type === 'deleteMember') {
  if ( $_GET['memberId'] ) {
    Member::deleteMember( $_GET['memberId'] );
    $alert = "Member with id:" . $_GET['memberId'] . " deleted.";
  }
}
// !end.Handle case delete member

// Handle case add boat
if ($form_type === 'addBoat') {
  if ( $_GET['type'] && $_GET['length'] && $_GET['ownerId'] ) {
    $boat = new Boat($_GET['ownerId'],$_GET['type'],$_GET['length']);
    Member::addBoat($_GET['ownerId'],$boat);
    $alert = "New boat with id:" . $_GET['type'] . " added.";
  }
}
// !end.Handle case add boat

// Handle case delete boat
if ($form_type === 'deleteBoat') {
  if ( $_GET['boatId'] && $_GET['ownerId'] ) {
    Boat::deleteBoat($_GET['boatId']);
    Member::deleteBoat($_GET['ownerId'],$_GET['boatId']);
    $alert = "Boat with id:" . $_GET['boatId'] . " deleted.";
  }
}
// !end.Handle case delete boat
