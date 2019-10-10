<?php

/**
* MemberShipList
*
* @package  model
* @author   fl222uw
*/
class MembershipList {
  private $members = array();
  const data_src = 'resources/members.json';

  public function __construct() {
    $file = file_get_contents(MembershipList::data_src);
    $this->members = json_decode($file,true);
  }

   /**
   * Returns data for a compact list
   *
   * @return array
   */
   public function compactList(){
     $output = array();
     $members = $this->members;
     foreach ($members as $value) {
     $member = array(
       'id' => $value['id'],
       'name' => $value['firstName'] . " " . $value['lastName'],
       'num_boats' => count($value['boats'])
     );
     array_push($output, $member);
     }
     return $output;
   }

   /**
   * Returns data for a verbose list
   *
   * @return array
   */
   public function verboseList(){
    $output = array();
    foreach ($this->members as $value) {
    }
    foreach ($this->members as $value) {
      $member = array(
        'id' => $value['id'],
        'firstName' => $value['firstName'],
        'lastName' => $value['lastName'],
        'birthNumber' => $value['birthNumber'],
        'name' => $value['firstName'] . " " . $value['lastName'],
        'boats' => $value['boats']
      );
      array_push($output, $member);
    }
    return $output;
  }

}
