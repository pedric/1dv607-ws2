<?php

/**
* Form
*
* @package  controller
* @author   fl222uw
*/
class Form {

  private $form_type;

  public function __construct($type) {
    $this->form_type = $type;
  }

  /**
  * Gets an array with data for a members boats
  * @param $memberId
  * @return array()/false
  */
  public static function getMembersBoats($memberId) {
    if( $members_boats = Member::getMembersBoats($memberId) ) {
        return $members_boats;
    } else {
        return false;
    }
  }

  /**
  * Gets an array with data for a member
  * @param $memberId
  * @return array()/false
  */
  public static function getMemberData($memberId){
      if( $member_data = Member::getMember($memberId) ) {
          return $member_data;
      } else {
          return false;
      }
  }

  /**
  * Takes a string and delegates formsubmission with parameters in url
  * @param $form_type
  */
  public function handleFormSubmission($form_type) {
      // Handle case add member
      if ($form_type === 'addMember') {
        if ( $_GET['firstName'] && $_GET['lastName'] && $_GET['birthNumber'] ) {
          $member = new Member($_GET['firstName'],$_GET['lastName'],$_GET['birthNumber']);
        }
      }
      // !end.Handle case add member

      // Handle case edit member
      if ($form_type === 'editMember') {
        if ( $_GET['firstName'] && $_GET['lastName'] && $_GET['birthNumber'] && $_GET['memberId'] ) {
          Member::updateMember($_GET['memberId'],$_GET['firstName'],$_GET['lastName'],$_GET['birthNumber']);
        }
      }
      // !end.Handle case edit member

      // Handle case delete member
      if ($form_type === 'deleteMember') {
        if ( $_GET['memberId'] ) {
          Member::deleteMember( $_GET['memberId'] );
        }
      }
      // !end.Handle case delete member

      // Handle case add boat
      if ($form_type === 'addBoat') {
        if ( $_GET['type'] && $_GET['length'] && $_GET['ownerId'] ) {
          $boat = new Boat($_GET['ownerId'],$_GET['type'],$_GET['length']);
          $boat_array = array(
              "id"  =>  $boat->getId(),
              "ownerId" => $boat->getOwnerId(),
              "type" => $boat->getType(),
              "length" => $boat->getLength()
          );
          Member::addBoat($_GET['ownerId'],$boat_array);
        }
      }
      // !end.Handle case add boat

      // Handle case update boat
      if ($form_type === 'updateBoat') {
        if ( $_GET['type'] && $_GET['length'] && $_GET['ownerId'] && $_GET['id'] ) {
          Boat::updateBoat($_GET['id'],$_GET['ownerId'],$_GET['type'],$_GET['length']);
        }
      }
      // !end.Handle case update boat

      // Handle case delete boat
      if ($form_type === 'deleteBoat') {
        if ( $_GET['boatId'] && $_GET['ownerId'] ) {
          Boat::deleteBoat($_GET['boatId']);
          Member::deleteBoat($_GET['ownerId'],$_GET['boatId']);
        }
      }
      // !end.Handle case delete boat
  }

  /**
  * Takes a string and return feedback message to view
  * @param $form_type
  * @return String
  */
  public static function getAlertMessage($form_type) {

    $alert = "";

    if ($form_type === 'addMember'){
      $alert = "New member " . $_GET['firstName'] . " " . $_GET['lastName'] . " bnr: " . $_GET['birthNumber'] . " added.";
    } else if ($form_type === 'editMember') {
      $alert = "Member " . $_GET['firstName'] . " " . $_GET['lastName'] . " updated.";
    } else if ($form_type === 'deleteMember') {
      $alert = "Member with id:" . $_GET['memberId'] . " deleted.";
    } else if ($form_type === 'addBoat') {
      $alert = "New " . $_GET['type'] . " added.";
    } else if ($form_type === 'deleteBoat') {
      $alert = "Boat with id:" . $_GET['boatId'] . " deleted.";
    } else if ($form_type === 'updateBoat') {
      $alert = "Updated boat.";
    } else {
      $alert = "Error: Unknown form operation";
    }

    return $alert;
  }

}
