<?php

// Function to 'clean' data
function clean_input($dbconnect, $data) {
	$data = trim($data);	
	$data = htmlspecialchars($data);
	$data = mysqli_real_escape_string($dbconnect, $data);
	return $data;
}

// Function to fetch data from the database based on optional condition
function get_data($dbconnect, $more_condition = null) {

    // Base SQL query to fetch data
	// b = Breedname
	// f = Fur table
	// L = lapcat table
    $find_sql = "SELECT
	
        b.*,
		f.*,
		l.*,
        t1.Temprament AS Temprament1,
        t2.Temprament AS Temprament2,
        t3.Temprament AS Temprament3,
        t4.Temprament AS Temprament4,
        t5.Temprament AS Temprament5
		
    FROM 
	Cat_characteristics b
	
    JOIN Fur_Type f ON f.Fur_ID = b.Fur_ID
    JOIN LapCat l ON l.LapCat_ID = b.LapCat_ID
    JOIN Temprament t1 ON b.Temp1_ID = t1.Temp_ID
    JOIN Temprament t2 ON b.Temp2_ID = t2.Temp_ID
    JOIN Temprament t3 ON b.Temp3_ID = t3.Temp_ID
    JOIN Temprament t4 ON b.Temp4_ID = t4.Temp_ID
    JOIN Temprament t5 ON b.Temp5_ID = t5.Temp_ID

	";
  // if we have a WHERE condition, add it to the sql
	if($more_condition != null) {
		// add some extra string onto find sql
		$find_sql .= $more_condition;
	}

	$find_query = mysqli_query($dbconnect, $find_sql);
//	$find_rs = mysqli_fetch_assoc($find_query);
	$find_count = mysqli_num_rows($find_query);

	return $find_query_count = array($find_query, $find_count);
//	return $find_rs_count = array($find_query, $find_rs, $find_count);
	}


// Function to get an item's name from a table by ID

function get_item_name($dbconnect, $table, $column, $ID)
{
    $find_sql = "SELECT * FROM $table WHERE $column = $ID";
    $find_query = mysqli_query($dbconnect, $find_sql);
	$find_rs = mysqli_fetch_assoc($find_query);
	
	
	return $find_rs;
	
    }

	
// get search ID
function get_search_ID($dbconnect, $search_term)
{
	$find_sql = "SELECT * FROM `Temprament` WHERE `Temprament` LIKE '$search_term'
";
	$find_query = mysqli_query($dbconnect, $find_sql);
	$find_rs = mysqli_fetch_assoc($find_query);

	// count results
	$find_count = mysqli_num_rows($find_query);

	if($find_count == 1) {
		return $find_rs['Temp_ID'];
	}
	else{
		return "no results";
	
	}
}


// entity is tempraments; breed / alt breed name
function autocomplete_list($dbconnect, $item_sql, $entity)    
{
// Get entity / topic list from database
$all_items_query = mysqli_query($dbconnect, $item_sql);
    
// Make item arrays for autocomplete functionality...
while($row=mysqli_fetch_array($all_items_query))
{
  $item=$row[$entity];
  $items[] = $item;
}

$all_items=json_encode($items);
return $all_items;
    
}

?>
