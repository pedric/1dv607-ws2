<?php
class Boat {
  public $id;
  public $ownerId;
  public $type;
  public $length;
  const data_src = 'resources/boats.json';

  public function __construct($oId,$t,$l) {
    $this->id = uniqid();
    $this->ownerId = $oId;
    $this->type = $t;
    $this->length = $l;
    $this->saveBoat();
  }

  /*
   * Getters
   */

   public function getLength(){
     return $this->length;
   }

   public function getType(){
     return $this->type;
   }

   public function getOwnerId(){
     return $this->ownerId;
   }

   public function getId(){
     return $this->id;
   }

   /*
    * Setters
    */
    public function setLength($l){
      $this->length = $l;
    }

    public function setType($t){
      $this->type = $t;
    }

    public function setOwnerId($oId){
      $this->ownerId = $oId;
    }

  /*
   * Other methods
   */
  public function saveBoat() {
    $file = file_get_contents(Boat::data_src);
    $array = json_decode($file,true);
    $new_boat_array = array(
      'id'=>$this->id,
      'ownerId'=>$this->ownerId,
      'type'=>$this->type,
      'length'=>$this->length,
    );
    array_push($array,$new_boat_array);
    $json_string = json_encode($array,JSON_PRETTY_PRINT);
    file_put_contents(Boat::data_src, $json_string);
  }

  public static function deleteBoat($id) {
      $file = file_get_contents(Boat::data_src);
      $array = json_decode($file,true);
      $deleted_boat_info = null;
      for($i = 0; $i < count($array);$i++){
        if($array[$i]['id'] == $id){
          $deleted_boat_info = $array[$i]['type'] . " " . $array[$i]['length'];
          array_splice($array,$i,1);
        }
      }
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Boat::data_src, $json_string);
  }

  public function updateBoat($id,$oId = null,$t = null,$l = null){
    $file = file_get_contents(Boat::data_src);
    $array = json_decode($file,true);
    for($i = 0; $i < count($array);$i++){
      if($array[$i]['id'] == $id){
        if(isset($oId)){$array[$i]['ownerId'] = $oId;}
        if(isset($t)){$array[$i]['type'] = $t;}
        if(isset($l)){$array[$i]['length'] = $l;}
      }
    }
    $json_string = json_encode($array,JSON_PRETTY_PRINT);
    file_put_contents(Boat::data_src, $json_string);
  }

}

class Member {
  public $id;
  public $firstName;
  public $lastName;
  public $birthNumber;
  public $boat;
  const data_src = 'resources/members.json';

  public function __construct($f = null,$l = null,$b = null) {
    $this->id = uniqid();
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

    /*
     * Other methods
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
            if ( $array[$i]['boats'][$j]['id'] == $boat ) {
              array_splice($array[$i]['boats'],$j,1);
            }
          }
        }
      }
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Member::data_src, $json_string);
    }

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

    public function getMember($id){
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

class MembershipList {
  public $members = array();
  const data_src = 'resources/members.json';

  public function __construct() {
    $file = file_get_contents(MembershipList::data_src);
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

$form = false;
if (isset($_REQUEST['form'])) {
  $form = $_REQUEST['form'];
}

include './partials/header.php';
// include './controller/appcontroller.php';
include './controller/formHandler.php';

if (isset($alert)) {
  echo '<div class="alert">' . $alert . '</div>';
}
    ?>
    <div style="background:#000;">
      <header class="container">
        <ul>
          <li><a href="/?form=addMemberForm">add Member</a></li>
          <li><a href="/">List view</a></li>
        </ul>
      </header>
    </div>
    <?php
    echo '<div class="container">';

    if($form) {
      include './view/' . $form . '.php';
    }
    include './view/lists.php';
    ?>
    </div>
  <script src="/assets/js/main.js"></script>
  </body>
</html>
