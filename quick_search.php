<?php

// retrieve search type..
$search_type = clean_input($dbconnect,$_POST['search_type']); 
$search_term = clean_input($dbconnect,$_POST['quick_search']); 

// set searches up
$breed_search = "b.BreedName LIKE '%$search_term%'";
$temp_search = "
t1.Temprament LIKE '%$search_term%'
OR t2.Temprament LIKE '%$search_term%'
OR t3.Temprament LIKE '%$search_term%'
OR t4.Temprament LIKE '%$search_term%'
OR t5.Temprament LIKE '%$search_term%'
";

if ($search_type == "breed") {
    $sql_conditions = "WHERE $breed_search";
}

elseif($search_type == "Temperament") {
    $sql_conditions = "WHERE $temp_search";
}

else {
    $sql_conditions = "
    WHERE $breed_search OR $temp_search
    ";}

$heading = "'$search_term' entries";

include (
    "results.php"
);

?>
