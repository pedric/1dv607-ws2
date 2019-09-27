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
     $obj;
     foreach ($this->members as $value) {
       $obj_from_json = json_decode($value);
       $obj->id = $obj_from_json->id;
       $obj->name = $obj_from_json->firstName . " " . $obj_from_json->lastName;
       $obj->num_boats = $obj_from_json->boats;
       array_push($output, $obj);
     }
     return $output;
   }

   public function verboseList(){

   }

}
