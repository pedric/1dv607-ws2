<?php

class MemberShipList {
  public $members = array();
  const data_src = 'resources/members.json';

  public function __construct() {
    $file = file_get_contents(MemberShipList::data_src);
    $this->members = json_decode($file,true);
  }

  /*
   * Lists
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

   public function verboseList(){
    $output = array();
    foreach ($this->members as $value) {
    }
    foreach ($this->members as $value) {
      foreach($value['boats'] as $boat){
        $obj;
        $boats = array();
        $obj->id = $boat['id'];
        $obj->ownerId = $boat['ownerId'];
        $obj->type = $boat['type'];
        $obj->length = $boat['length'];
        array_push($boats, $obj);
      }
      $member = array(
        'id' => $value['id'],
        'name' => $value['firstName'] . " " . $value['lastName'],
        'boats' => $boats
      );
      array_push($output, $member);
    }
    var_dump($output);
    return $output;
  }

}
