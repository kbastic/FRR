
<?php
// This page displays the available rooms.
session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
// Set the page title and include the HTML header:
$page_title = 'Search Rooms';
include ('includes/header.html');
?>

<h2 align="center">Search</h2>
<fieldset><legend style="font-size:small">Select search criteria:</legend>
<form action="search_results.php" method="post" id="search_form">
    </br>
	
    <p>Date: <input type="text" id="date" name="date" maxlength="25" size="25"/>
     <img src="images/cal.gif" onclick="javascript:NewCssCal('date', 'yyyyMMdd')" style="cursor:pointer"/></p> 
    <p>Max Occupancy: <select name="maxO" id="maxO">
              <option value="any">Any</option>
              <option value="1-25">1-25</option>
              <option value="26-50">26-50</option>
              <option value="51-75">51-75</option>
              <option value="76-100">76-100</option>
    </select> </p>
	
</fieldset>
	<p align="center"><input type="submit" name="submit" value="Search" /></p>
</form>


<?php

include ('includes/footer.html');
?>