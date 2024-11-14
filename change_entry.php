<?php

// check iser is logged
if (isset($_SESSION['admin'])) {

    if(isset($_REQUEST['submit']))
{

// retrieve quote and author ID from form
// check they are integers (in case someone edits the URL)
$ID = filter_var($_REQUEST['ID'], FILTER_SANITIZE_NUMBER_INT);
include("process_form.php");

		
$stmt = $dbconnect->prepare("UPDATE `Cat_characteristics` SET `BreedName` = ?, `AltBreedName` = ?, `Fur_ID` = ?, `Lapcat_ID` = ? = ?, `Temp1_ID` = ?, `Temp2_ID` = ?, `Temp3_ID` = ?, `Temp4_ID` = ?, `Temp5_ID` = ? WHERE Cat_Char_ID = ?;");
$stmt->bind_param("ssiiiiiiii", $BreedName, $AltBreedName, $Fur_ID, $Lapcat_ID, $Temp1_ID, $Temp2_ID, $Temp3_ID, $Temp4_ID, $Temp5_ID, $ID);
$stmt->execute();
// Close stmt once everything has been inserted
$stmt -> close();

$heading = "";
$heading_type = "edit_success";
$sql_conditions = "WHERE ID = $ID";

include("content/results.php");

}   // end pushing of the submit button

} // end user logged on it

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
}





?>