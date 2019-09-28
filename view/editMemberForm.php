<h3>Edit member <?=$_GET['firstName'] . $_GET['lastName']?></h3>
<?php
  $members_boats = Member::getMembersBoats($_GET['memberId']);
  if ($members_boats > 0) {
    echo '<div>Boats</div>';
  }
  foreach ($members_boats as $value) {
    echo $value['type'] . ', ' . $value['length'] . ' foot';
  }
?>
<form action="/">

<div>
<label>First name</label>
<input type="text" name="firstName" value="<?=$_GET['firstName']?>" required>
</div>

<div>
<label>Last name</label>
<input type="text" name="lastName" value="<?=$_GET['lastName']?>" required>
</div>

<div>
<label>Birth number</label>
<input type="text" name="birthNumber" value="<?=$_GET['birthNumber']?>" required>
</div>

<input type="hidden" name="memberId" value="<?=$_GET['memberId']?>">
<input type="hidden" name="formtype" value="editMember">

<input class="button-primary" type="submit" value="Update member">

</form>
