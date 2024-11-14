<?php

// check if user is logged
if (isset($_SESSION['admin'])) {

    if(isset($_REQUEST['submit'])) {

        include("process_form.php");

        // insert entry
        $stmt = $dbconnect->prepare("INSERT INTO `Cat_characteristics` (`BreedName`, `AltBreedName`, `Fur_ID`, `LapCat_ID`, `Temp1_ID`, `Temp2_ID`, `Temp3_ID`, `Temp4_ID`, `Temp5_ID`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("ssiiiiiii", $BreedName, $AltBreedName, $Fur_ID, $Lapcat_ID, $TempID_1, $TempID_2, $TempID_3, $TempID_4, $TempID_5);
        $stmt->execute();

        $ID= $dbconnect->insert_id;

        // Close stmt once everything has been inserted
        $stmt->close();

        // Redirect to entry_success.php
        header("Location: index.php?page=../admin/entry_review");
        exit();  // Ensure script stops running after the redirect

    }   // end pushing of the submit button

} // end user logged in

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
    exit();  // Ensure script stops running after the redirect
}

?>