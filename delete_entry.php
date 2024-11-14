<?php

// if the user is logged in, show edit / delete options
if (isset($_SESSION['admin'])) {

    $Cat_Char_ID = $_REQUEST['Cat_Char_ID'];


    $delete_sql = "DELETE FROM `Cat_characteristics` WHERE `Cat_characteristics`.`ID` = $Cat_Char_ID";
    $delete_query = mysqli_query($dbconnect, $delete_sql);

    ?>
    <h2> Delete Sucess!</h2>
    <p> The requested entry has been deleted.</p>
    <?php

} // end user logged in

else {
    $login_error = 'Please log in to access this page';
    header("Location: index.phph?page=../admin/login& error=$login_error");
}



?>