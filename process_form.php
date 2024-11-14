<?php

// retrieve data from form
$BreedName = $_REQUEST['Breed_Name'];

$AltBreedName = $_REQUEST['AltBreedName'] ?: "n/a";  // fallback if blank

$Fur_ID = $_REQUEST['Furtype'];

$Lapcat_ID = $_REQUEST['Lapcat'];

$Temprament1 = $_REQUEST['Temprament1'];
$Temprament2 = $_REQUEST['Temprament2'];
$Temprament3 = $_REQUEST['Temprament3'];
$Temprament4 = $_REQUEST['Temprament4'];
$Temprament5 = $_REQUEST['Temprament5'];

// Initialise IDs
$Temp1_ID = $TempID_2 = $TempID_3 = $TempID_4 = $TempID_5 = $Fur_ID = $Lapcat_ID = $ID = "";
$Fur_ID = 0;
$Lapcat_ID = 0;

// handle blank fields
if ($AltBreedName == "") {
    $AltBreedName = "n/a";
}

if ($Temprament2 == "") {
    $Temprament2 = "n/a";
}

if ($Temprament3 == "") {
    $Temprament3 = "n/a";
}

if ($Temprament4 == "") {
    $Temprament4 = "n/a";
}

if ($Temprament5 == "") {
    $Temprament5 = "n/a";
}


// check to see if Temperament is already in DB, if not, add it

$Tempraments = array($Temprament1, $Temprament2, $Temprament3, $Temprament4, $Temprament5);
$Temp_IDs = array();

// statement to insert Temprament/s
$stmt = $dbconnect -> prepare("INSERT INTO `Temprament` (`Temprament`) VALUES (?); ");

foreach ($Tempraments as $Temprament) {
    $Temp_ID = get_search_ID($dbconnect, $Temprament);

    if($Temp_ID == "no results") {

        // insert the Temprament
        $stmt -> bind_param("s", $Temprament);
        $stmt -> execute();

        // retrieve Temprament ID
        $Temp_ID = $dbconnect->insert_id;
    }

   // echo "temprament ID: ".$Temp_ID."<br>";

    $Temp_IDs[] = $Temp_ID;
}

var_dump($_POST);

// retrieve Temprament IDs
$TempID_1 = $Temp_IDs[0];
$TempID_2 = $Temp_IDs[1];
$TempID_3 = $Temp_IDs[2];
$TempID_4 = $Temp_IDs[3];
$TempID_5 = $Temp_IDs[4];

?>