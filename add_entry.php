
<?php
// check user is logged on
if (isset($_SESSION['admin'])) {
	
// get all subjects from data base
$all_temps_sql = "SELECT * FROM Temprament ORDER BY Temprament ASC ";
$all_fur_sql = "SELECT * FROM `Fur_Type` ORDER BY `Fur_Type`.`Fur` ASC";
$all_lap_sql = "SELECT * FROM `LapCat` ORDER BY `LapCat`.`Lapcat` ASC";
$all_tempraments = autocomplete_list($dbconnect, $all_temps_sql, 'Temprament');
$all_Fur_Types = autocomplete_list($dbconnect, $all_fur_sql, 'Fur');
$all_Lap_Cat = autocomplete_list($dbconnect, $all_lap_sql, 'Lapcat');
	
// initialise subject variables
$tag_1 = "";
$tag_2 = "";
$tag_3 = "";
	
// initialise tag ID's
	$tag_1_ID = $tag_2_ID = $tag_3_ID = 0;
	
	?>

<div class = "admin-form">
	<h1> Add a Cat Breed</h1>
	
	<form action="index.php?page=../admin/insert_entry" method="post">
		<p><input name="Breed Name" placeholder="Cat Breed (Required)" required></p>
		
		<p><input name="AltBreedName" placeholder="AltBreedname" /></p>
		
		<div class="autocomplete"><p><input name="Furtype" id="Furtype" placeholder="Fur length"></p></div>
		<div class="autocomplete"><p><input name="Lapcat" id="Lapcat" placeholder="Lapcat"></p></div>
		
		<div class="autocomplete"><p><input name="Temprament1" id="temprament1" placeholder="Temprament"></p></div>
		<div class="autocomplete"><p><input name="Temprament2" id="temprament2" placeholder="Temprament"></p></div>
		<div class="autocomplete"><p><input name="Temprament3" id="temprament3" placeholder="Temprament"></p></div>
		<div class="autocomplete"><p><input name="Temprament4" id="temprament4" placeholder="Temprament"></p></div>
		<div class="autocomplete"><p><input name="Temprament5" id="temprament5" placeholder="Temprament"></p></div>
		
		<p><input class="form-submit " type="submit" name="submit"
				  value="Submit Cat" /></p>
		
	</form>
	
	<script>
		<?php include("autocomplete.php"); ?>
		
		var all_tags = <?php print("$all_tempraments")?>;
		autocomplete(document.getElementById("temprament1"), all_tags);
		autocomplete(document.getElementById("temprament2"), all_tags);
		autocomplete(document.getElementById("temprament3"), all_tags);
		autocomplete(document.getElementById("temprament4"), all_tags);
		autocomplete(document.getElementById("temprament5"), all_tags);
		
		var all_tags = <?php print("$all_Fur_Types"); ?>;
		autocomplete(document.getElementById("Furtype"), all_tags);
		var all_tags = <?php print("$all_Lap_Cat"); ?>;
		autocomplete(document.getElementById("Lapcat"), all_tags);
		
	</script>
	
</div>

<?php
	} // end user logged on it
	
	else {
		$login_error = 'Please login to access this page';
		header("Location: index.php?page=../admin/login&
		error=$login_error");
	}

?>