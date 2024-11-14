<?php
// check iser is logged
if (isset($_SESSION['admin'])) {

    // retrieve Tempraments and authors to populate combo box
    include("sub_author.php");

    // retrieve current values for entry
    $ID = $_REQUEST['ID'];

    // get values from DB
    $edit_query = get_data($dbconnect, "WHERE b.ID = $ID");

    $edit_results_query = $edit_query[0];
    $edit_results_rs = mysqli_fetch_assoc($edit_results_query);

    $BreedName = $edit_results_rs['BreedName'];
    $AltBreedName = $edit_results_rs['AltBreedName'] ?: "n/a";  // Fallback if blank
    $Fur_ID = $edit_results_rs['Fur'];
    $Lapcat_ID = $edit_results_rs['Lapcat'];
    $Temprament1 = $edit_results_rs['Temprament1'];
    $Temprament2 = $edit_results_rs['Temprament2'];
    $Temprament3 = $edit_results_rs['Temprament3'];
    $Temprament4 = $edit_results_rs['Temprament4'];
    $Temprament5 = $edit_results_rs['Temprament5'];

    $all_Tempraments = array($Temprament1, $Temprament2, $Temprament3, $Temprament4, $Temprament5);
    ?>

    <div class="admin-form">
        <h1>EDIT SELECTED ENTRY</h1>

        <form
            action="index.php?page=../admin/change_entry&ID=<?php echo $ID; ?>"
            method="post">

            <p>
                <textarea name="BreedName" placeholder="Breed Name (Required)" required><?php echo $BreedName; ?></textarea>
            </p>

            <p>
                <textarea name="AltBreedName" placeholder="Alternate Breed Name"><?php echo $AltBreedName; ?></textarea>
            </p>

            </br>
            
            <div class="important">
                If you EDIT an Breed, it will CHANGE THE BREED NAME for the entry being edited. It DOES NOT edit the BREED
                NAME on all entries attributed to that breed.
            </div> 

            </br>

            <div class="dropdown">
                <select name="FurType" id="FurType" class="custom-dropdown" required>
                    <option value="" disabled selected>Select Fur Type (required)</option>
                    <option value="Short" id="Fur_ID_1">Short</option>
                    <option value="Medium" id="Fur_ID_2">Medium</option>
                    <option value="Long" id="Fur_ID_3">Long</option>
                    <option value="Long" id="Fur_ID_4">Bald</option>
                    <option value="None" id="Fur_ID_5">None</option>
                </select>
            </div>

            <!-- <br /><br /> -->

            <div class="dropdown">
                <select name="LapcatType" id="LapcatType" class="custom-dropdown" required>
                    <option value="" disabled selected>Select Type of Lapcat (required)</option>
                    <option value="Lap" id="Lapcat_ID_1">Lapcat</option>
                    <option value="Non Lap" id="Lapcat_ID_2">Non-Lapcat</option>
                    <option value="Rodent" id="Lapcat_ID_3">Rodent</option>
                    <option value="Generic" id="Lapcat_ID_4">Generic</option>
                    <option value="None" id="Lapcat_ID_5">None</option>
                </select>
            </div>

            <!-- <br /><br /> -->

            <div class="light_blue">
                Blank Tempraments appear as "N/A." You can either EDIT these / ADD a Temprament, or LEAVE them as N/A.
            </div> </br>

            <div class="autocomplete">
                <input name="Temprament1" id="Temprament1" value="<?php echo $Temprament1 ?>" required/>
            </div>
            <br /><br />
            <div class="autocomplete">
                <input name="Temprament2" id="Temprament2" value="<?php echo $Temprament2 ?>" />
            </div>
            <br /><br />
            <div class="autocomplete">
                <input name="Temprament3" id="Temprament3" value="<?php echo $Temprament3 ?>" />
            </div>
            <br /><br />
            <div class="autocomplete">
                <input name="Temprament4" id="Temprament4" value="<?php echo $Temprament4 ?>" />
            </div>
            <br /><br />
            <div class="autocomplete">
                <input name="Temprament5" id="Temprament5" value="<?php echo $Temprament5 ?>" />
            </div>

            <br /><br />

            <p><input calss="form-submit" type="submit" name="submit" value="Submit Edit" /></p>

        </form>


        <script>
            <?php include("autocomplete.php"); ?>

            /* arrays containing lines. */
            var all_tags = <?php print ("$Temprament") ?>;
            autocomplete(document.getElementById("Temprament1"), all_tags);
            autocomplete(document.getElementById("Temprament2"), all_tags);
            autocomplete(document.getElementById("Temprament3"), all_tags);
            autocomplete(document.getElementById("Temprament4"), all_tags);
            autocomplete(document.getElementById("Temprament5"), all_tags);
        </script>

    </div>

    <?php
} // end user logged on it
else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}
?>