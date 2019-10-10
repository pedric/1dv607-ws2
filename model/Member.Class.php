<?php

/**
* Member
*
* @package  model
* @author   fl222uw
*/
class Member {
  private $id;
  private $firstName;
  private $lastName;
  private $birthNumber;
  private $boat;
  const data_src = 'resources/members.json';

  public function __construct($f = null,$l = null,$b = null) {
    $this->id = $this->getMemberId($f,$l);
    if(isset($f)){$this->firstName = $f;}
    if(isset($l)){$this->lastName = $l;}
    if(isset($b)){$this->birthNumber = $b;}
    if($f && $l && $b){$this->saveMember();}
  }

  /*
   * Getters
   */
   public function getFullName(){
     return $this->firstName . " " . $this->lastName;
   }

   public function getFirstName(){
     return $this->firstName;
   }

   public function getLastName(){
     return $this->lastName;
   }

   public function getBirthNumber(){
     return $this->birthNumber;
   }

   public function getId(){
     return $this->id;
   }

   /*
    * Setters
    */
    public function setFirstName($n){
      $this->firstName = $n;
    }

    public function setLastName($n){
      $this->lastName = $n;
    }

    public function setBirthNumber($n){
      $this->birthNumber = $n;
    }

    /**
     * Generates a member id for new member based on initials
     *
     * @param $f,$l
     */
     public function getMemberId($f,$l){
       $file = file_get_contents(Member::data_src);
       $array = json_decode($file,true);
       $swe_alphabet = "abcdefghijklmnopqrstuwxyzåäö";
       if($f && $l) {
          $first_name_initial_char = strtolower(substr($f,0,1));
          $last_name_initial_char = strtolower(substr($l,0,1));
          $initials_as_number = strpos($swe_alphabet , $first_name_initial_char) + strpos($swe_alphabet , $last_name_initial_char);
          return $initials_as_number + count($array) + 1;
       } else {
         return rand(0,9) + count($array) + 1;
       }

     }

    /**
    * Saves member to json file, called diretly from constructor
    */
    public function saveMember(){
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      $new_member_array = array(
        'id'=>$this->id,
        'firstName'=>$this->firstName,
        'lastName'=>$this->lastName,
        'birthNumber'=>$this->birthNumber,
        'boats'=>array(

        ));
      array_push($array,$new_member_array);
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Member::data_src, $json_string);
    }

    /**
    * Add new boat object to member
    *
    * @param $oId,$boat
    */
    public static function addBoat($oId,$boat){
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      for($i = 0; $i < count($array);$i++){
        if($array[$i]['id'] == $oId){
          array_push($array[$i]['boats'],$boat);
        }
      }
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Member::data_src, $json_string);
    }

    public static function deleteBoat($oId,$boat){
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      for($i = 0; $i < count($array);$i++){
        if($array[$i]['id'] == $oId){
          for($j = 0; $j < count($array[$i]['boats']);$j++){
            var_dump( $array[$i]['boats'][$j]['id'] );
            if ( $array[$i]['boats'][$j]['id'] == $boat ) {
              array_splice($array[$i]['boats'],$i,1);
            }
          }
        }
      }
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Member::data_src, $json_string);
    }

    /**
    * Delete member
    */
    public static function deleteMember($id){
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      $deleted_members_name = null;
      for($i = 0; $i < count($array);$i++){
        if($array[$i]['id'] == $id){
          $deleted_members_name = $array[$i]['firstName'] . " " . $array[$i]['lastName'];
          array_splice($array,$i,1);
        }
      }
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Member::data_src, $json_string);
    }

    /**
    * Updates members data
    *
    * @param $id,$f,$l,$b
    */
    public static function updateMember($id,$f = null,$l = null,$b = null){
        $file = file_get_contents(Member::data_src);
        $array = json_decode($file,true);
        for($i = 0; $i < count($array);$i++){
          if($array[$i]['id'] == $id){
            if(isset($f)){$array[$i]['firstName'] = $f;}
            if(isset($l)){$array[$i]['lastName'] = $l;}
            if(isset($b)){$array[$i]['birthDate'] = $b;}
          }
        }
        $json_string = json_encode($array,JSON_PRETTY_PRINT);
        file_put_contents(Member::data_src, $json_string);
    }

    /**
    * Returns member object
    *
    * @param $id
    * @return Object
    */
    public static function getMember($id){
        $file = file_get_contents(Member::data_src);
        $array = json_decode($file,true);
        $hit = false;
        for($i = 0; $i < count($array);$i++){
          if($array[$i]['id'] == $id){
            $hit = $array[$i];
          }
        }
        return $hit;
    }

    /**
    * Returns members boats object
    *
    * @param $id
    * @return Object
    */
    public static function getMembersBoats($id){
        $file = file_get_contents(Member::data_src);
        $array = json_decode($file,true);
        $hit = false;
        for($i = 0; $i < count($array);$i++){
          if($array[$i]['id'] == $id){
            $hit = $array[$i]['boats'];
          }
        }
        return $hit;
    }
}
