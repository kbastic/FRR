
<?php

session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}
// Set the page title and include the HTML header:
$page_title = 'Reserve Rooms';
include ('includes/header.html');
?>

<h2 align="center">Make Reservation</h2>
<fieldset><legend style="font-size:small">Select reservation options:</legend>
<form action="confirmation.php" method="post" >
    </br>
  
	 <p>Room Number: <?php if (isset($_POST['description'])) echo $_POST['roomID']; ?></p>
     
     <p>Description: <?php if (isset($_POST['description'])) echo $_POST['description']; ?></p>
     
     <p>Max Occupancy: <?php if (isset($_POST['maxOccupancy'])) echo $_POST['maxOccupancy']; ?></p>
     
     <p>Price: $<?php if (isset($_POST['price'])) echo $_POST['price']; ?></p>
     
     <p>Date: <?php if (isset($_POST['date'])) echo $_POST['date']; ?></p>
     
  <?php   echo "<input type=\"hidden\" name=\"roomID\" value=\"{$_POST['roomID']}\"/> 
	<input type=\"hidden\" name=\"description\" value=\"{$_POST['description']}\" />
    <input type=\"hidden\" name=\"maxOccupancy\" value=\"{$_POST['maxOccupancy']}\" /> 
	<input type=\"hidden\" name=\"price\" value=\"{$_POST['price']}\"/>
	<input type=\"hidden\" name=\"date\" value=\"{$_POST['date']}\"/> ";
  ?>
     
    
     <p>Select Time: <select name="time" id="time">
              <option value="08:00:00">8 AM</option>
              <option value="09:00:00">9 AM</option>
              <option value="10:00:00">10 AM</option>
              <option value="11:00:00">11 AM</option>
              <option value="12:00:00">12 AM</option>
              <option value="13:00:00">1 PM</option>
              <option value="14:00:00">2 PM</option>
              <option value="15:00:00">3 PM</option>
              <option value="16:00:00">4 PM</option>
              
              
    </select> </p>  
    <p>Select Duration in Hours: <select name="hours" id="hours">
              <option value="1">1 hour</option>
              <option value="2">2 hours</option>
              <option value="3">3 hours</option>
              <option value="4">4 hours</option>
              
    </select> </p>
    <p>Select Payment Type: <select name="payment" id="payment">
              <option value="1">Cash</option>
              <option value="2">Credit</option>
              <option value="3">Check</option>
             
              
    </select> </p>
	
</fieldset>
	<p align="center"><input type="submit" name="submit" value="Confirm" /></p>
</form>


<?php

include ('includes/footer.html');
?>