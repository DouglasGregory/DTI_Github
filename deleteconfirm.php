<?php

// if the user is logged in, show edit / delete options
if (isset($_SESSION['admin'])) {

    $ID = $_REQUEST['ID'];

    $delete_sql = "DELETE FROM `Cat_characteristics` WHERE `Cat_characteristics`.`ID` = $ID";
    $delete_query = mysqli_query($dbconnect, $delete_sql);

    // Show success message
    echo '<h2> Delete Success!</h2>';
    echo '<p> The requested entry has been deleted.</p>';
    
    // HTML block for confirmation links
    echo '<p>
        <span class="tag white-tag">
        <a href="index.php?page=../admin/delete_entry&Cat_Char_ID=' . $ID . '">Yes, delete it!</a>
        </span>
        &nbsp;
    </p>';

} else {
    // If the user is not logged in, redirect to the login page
    $login_error = 'Please log in to access this page';
    header("Location: index.php?page=../admin/login&error=" . urlencode($login_error));
    exit;
}


?>
