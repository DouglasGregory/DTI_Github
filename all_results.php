<?php

// retrieve search type..
$search_type = $_REQUEST['search']; 

// Initialize variables to avoid undefined variable warnings
$find_count = 0;
$heading_type = "";
$heading = "No results";
$sql_conditions = ""; // Default condition

// Default values for BreedName and AltBreedName
$BreedName = isset($_REQUEST['BreedName']) ? $_REQUEST['BreedName'] : '';
$AltBreedName = isset($_REQUEST['AltBreedName']) ? $_REQUEST['AltBreedName'] : '';

if ($search_type == "all") {
    $heading = "All Cats";
    $sql_conditions = "";

} elseif ($search_type == "recent") {
    $heading = "Recent Entries";
    $sql_conditions = " ORDER BY b.ID DESC LIMIT 10";

} elseif ($search_type == "random") {
    $heading = "Random Entries";
    $sql_conditions = " ORDER BY RAND() LIMIT 10";

} elseif ($search_type == "BreedName") {
    $heading = "";
    $heading_type = "BreedName";

    // Ensure $AltBreedName is used correctly
    if (!empty($BreedName)) {
        $sql_conditions = " WHERE b.BreedName = '" . mysqli_real_escape_string($dbconnect, $BreedName) . "'";
    } else {
        $sql_conditions = " WHERE 1=0"; // No results condition
    }
    
} else {
    $heading = "No results";
    $sql_conditions = " WHERE b.ID = 1000";
}

include ("results.php");

?>