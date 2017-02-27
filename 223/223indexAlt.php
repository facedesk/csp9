<?php
// This block allows our program to access the MySQL database.
// Stores your login information in PHP variables
require_once '../login.php';
// Accesses the login information to connect to the MySQL server using your credentials and database
$db_server = mysqli_connect($host, $username, $password);
// This provides the error message that will appear if your credentials or database are invalid
if (!$db_server) die("Unable to connect to MySQL: " . mysqli_error());
mysqli_select_db("shoes")
	or die("Unable to select database: " . mysqli_error());
	
// Store the query string from 2.2.3.A Step 23
$query = "SELECT city FROM store_info NATURAL JOIN request NATURAL JOIN shoe WHERE model_id=1";
		
// Searches the database returning results that match the query
// Results come in a table stored in $requests_for_model
$requests_for_model = mysqli_query($query);
// The mysqli_num_rows function returns an integer representation of number of rows for the table passed as an argument
$number_of_requests = mysqli_num_rows($requests_for_model);

for ($current_row = 0; $current_row < $number_of_requests; $current_row++)
{
	// walker variable (through rows in the table)
	$request = mysqli_fetch_row($requests_for_model);
	echo $request[0]; // output the 0th item in the row which is the city
	if ($current_row < $number_of_requests - 1) // Makes sure commas are only printed after results that are not the last
	{
		echo ", ";
	}
} 

?>