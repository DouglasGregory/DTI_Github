<?php

$all_results = get_data($dbconnect, $sql_conditions);

$find_query = $all_results[0];
$find_count = $all_results[1];

if ($find_count == 1) {
    $result_s = "Result";
} else {
    $result_s = "Results";
}

// check that we have results
if ($find_count > 0) {

    if ($heading != "") {
        $heading = "<h2>$heading ($find_count $result_s)</h2>";
    } elseif ($heading_type == "Temprament") {
        $Temprament_name = ucwords($Temprament_name);
        $heading = "<h2>$Temprament_name Breeds ($find_count $result_s)</h2>";
    }

    // Display heading
    echo $heading;

    while ($find_rs = mysqli_fetch_assoc($find_query)) {
        $BreedName = $find_rs['BreedName'];
        $AltBreedName = $find_rs['AltBreedName'];
		$ID = $find_rs['ID'];
		
        // Set up subjects
        $Fur = isset($find_rs['Fur_Type']) ? $find_rs['Fur_Type'] : '';
        $LapCat = isset($find_rs['LapCat']) ? $find_rs['LapCat'] : '';

        // Set up tempraments
        $Temp1 = $find_rs['Temprament1'];
        $Temp2 = $find_rs['Temprament2'];
        $Temp3 = $find_rs['Temprament3'];
        $Temp4 = $find_rs['Temprament4'];
        $Temp5 = $find_rs['Temprament5'];
		
        // Put tempraments in an array for iteration
        $Tempraments = array($Temp1, $Temp2, $Temp3, $Temp4, $Temp5);

        ?>

        <div class="results">
            <h3><?php echo htmlspecialchars($BreedName); ?></h3>
            <p><i>
                <a href="index.php?page=all_results&search=BreedName&BreedName=<?php echo urlencode($BreedName); ?>">
                    View Details
                </a>
            </i></p>

            <p>
            <?php
            // Iterate through tempraments array and output non-"n/a" values
            foreach ($Tempraments as $Temprament) {
                // ensure Temprament is not "n/a"
                if ($Temprament != "n/a") {
            ?>
                    <span class="tag">
                        <a href="index.php?page=all_results&search=Temprament&Temprament_name=<?php echo $Temprament; ?>">
                            <?php echo $Temprament; ?>
                        </a>
                    </span>
                    &nbsp;&nbsp;
            <?php
                }
            }

            // if the user is logged in, show edit / delete options
            if (isset($_SESSION['admin'])) {
            ?>
            <div class="tools">
                <a href="index.php?page=../admin/editcat&ID=<?php echo $ID; ?>"><i class="fa fa-edit fa-2x"></i></a> 
				&nbsp; &nbsp;
                <a href="index.php?page=../admin/deleteconfirm&ID=<?php echo $ID; ?>"><i class="fa fa-trash fa-2x"></i></a>
            </div>
            <?php
            }
            ?>
            </p>

        </div>

        <br />

    <?php
    } // End of while loop
} else { 
    ?>
    <h2>Sorry!</h2>
    <div class="no-results">
        Unfortunately, there were no results for your search. Please try again.
    </div>
<?php 
}

?>
