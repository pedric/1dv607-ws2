<h3>Add new boat for <?=$_GET['name']?></h3>
<form action="/">

<label>Type of boat</label>
<select name="type">
  <option value="other">Other</option>
  <option value="sailboat">Sailboat</option>
  <option value="motorsailer">Motorsailer</option>
  <option value="kayak or Canoe">Kayak or Canoe</option>
</select>

<div>
<label>Length (foot)</label>
<input type="number" name="length" required>
</div>

<input type="hidden" name="formtype" value="addBoat">
<input type="hidden" name="ownerId" value="<?=$_GET['ownerId']?>">

<input class="button-primary" type="submit" value="Add boat">

</form>
