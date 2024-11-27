<?php

$all_results = get_data($dbconnect, $sql_conditions);

$find_query = $all_results[0];
$find_count = $all_results[1];

if ($find_count == 1) {
    $result_s = "Result";
} else {
    $result_s = "Results";
}

// Check that we have results
if ($find_count > 0) {

    if ($heading != "") {
        $heading = "<h2>$heading ($find_count $result_s)</h2>";
    } elseif ($heading_type == "Temprament") {
        $Temprament_name = ucwords($Temprament_name);
        $heading = "<h2>$Temprament_name Breeds ($find_count $result_s)</h2>";
    }

    // Display heading
    echo $heading;

    // Iterate through the query results
    while ($find_rs = mysqli_fetch_assoc($find_query)) {
        // Fetch breed details
		$ID = $find_rs['ID'];
        $BreedName = $find_rs['BreedName'];
        $AltBreedName = $find_rs['AltBreedName'];
        
        // Fetch and check Fur_Type and LapCat values
        $Fur_Type = $find_rs['Fur'];
        $LapCat = $find_rs['Lapcat'];


        // Fetch temperament values
        $Temp1 = $find_rs['Temprament1'];
        $Temp2 = $find_rs['Temprament2'];
        $Temp3 = $find_rs['Temprament3'];
        $Temp4 = $find_rs['Temprament4'];
        $Temp5 = $find_rs['Temprament5'];

        // Store temperaments in an array
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
                <strong>Alternative Breed Name:</strong> <?php echo htmlspecialchars($AltBreedName); ?><br>
                
				<strong>Lap Cat:</strong> <?php echo htmlspecialchars($LapCat); ?><br> 
                
				<strong>Fur Type:</strong> <?php echo htmlspecialchars($Fur_Type); ?><br>

                <strong>Temperaments:</strong> 
                <?php
                // Iterate through the temperaments array and output non-"n/a" values
                foreach ($Tempraments as $Temprament) {
                    if ($Temprament != "n/a") {
                        echo "<span class='tag'>" . htmlspecialchars($Temprament) . "</span>&nbsp;&nbsp;";
                    }
                }
                ?>
            </p>

            <?php
            // If the user is logged in, show edit / delete options
            if (isset($_SESSION['admin'])) {
            ?>
            <div class="tools">
                <a href="index.php?page=../admin/deleteconfirm&ID=<?php echo $ID; ?>"><i class="fa fa-trash fa-2x"></i></a>
            </div>
            <?php
            }
            ?>
        </div>

        <br />

    <?php
    } // End of while loop
} else { 
    // If no results are found
    ?>
    <h2>Sorry!</h2>
    <div class="no-results">
        Unfortunately, there were no results for your search. Please try again.
    </div>
<?php 
}

?>  
