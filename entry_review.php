<?php
// check if the user is logged in
if (isset($_SESSION['admin'])) {

    // Query to get the most recent entry (highest ID)
    $sql = "SELECT b.*, t1.Temprament AS Temp1, t2.Temprament AS Temp2, 
                    t3.Temprament AS Temp3, t4.Temprament AS Temp4, t5.Temprament AS Temp5 
            FROM `Cat_characteristics` b
            JOIN Temprament t1 ON b.Temp1_ID = t1.Temp_ID
	        JOIN Temprament t2 ON b.Temp2_ID = t2.Temp_ID
	        JOIN Temprament t3 ON b.Temp3_ID = t3.Temp_ID
	        JOIN Temprament t4 ON b.Temp4_ID = t4.Temp_ID
	        JOIN Temprament t5 ON b.Temp5_ID = t5.Temp_ID
            ORDER BY b.ID DESC 
            LIMIT 1"; // Fetch the latest entry (highest ID)

    $result = $dbconnect->query($sql);


    ?>
    <h1> Congrats you submitted an entry.!</h1>
    <p>
    <h4>You can review this entry here! </h4>

    </p>
    <p>
    <h4>Below are the contents of the entry. </h4>

    </p>
    <p>
    <h4> If you are unhappy you can delete the entry or create a new one "</h4>

    </p>

    <h2> ENTRY CONTENTS:</h2>

    <div class="review" <?php

    // Check if an entry is found
    if ($result->num_rows > 0) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();
        echo "<p><strong>Breed Name:</strong> " . $row['BreedName'] . "</p>";
        echo "<p><strong>Alternative Breed Name:</strong> " . $row['AltBreedName'] . "</p>";
        echo "<p><strong>Fur Type :</strong> " . $row['Fur_ID'] . "</p>";
        echo "<p><strong>LapCat Type :</strong> " . $row['LapCat_ID'] . "</p>";
        echo "<p><strong>Tempraments:</strong></p>";
        echo "<ul>";
        echo "<li>" . $row['Temp1'] . "</li>";
        echo "<li>" . $row['Temp2'] . "</li>";
        echo "<li>" . $row['Temp3'] . "</li>";
        echo "<li>" . $row['Temp4'] . "</li>";
        echo "<li>" . $row['Temp5'] . "</li>";
        echo "</ul>";


    } else {
        // If no entry found
        echo "<p>No entries found.</p>";
    }


    ?> </div>
        </br>
        <span class="white-tag">
            <a href="index.php?page=../admin/add_entry">
                Add New Entry
            </a>
        </span> | 
        <span class="white-tag">
            <a href="index.php?page=all_results&search=all">
                All Cats
            </a>
        </span> | 
        <span class="white-tag">
            <a href="index.php?page=../admin/delete_entry">
                Delete Entry
            </a>
        </span>
        </br>
        <?php

} else {
    // If the user is not logged in, redirect to login page
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");
    exit();
}
?>