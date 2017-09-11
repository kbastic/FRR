
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
$page_title = 'Reservation Confirmation';
include ('includes/header.html');
require ('../../connection/mysqli_connect.php');

//calculate total
$total = $_POST['price'] * $_POST['hours'];

//payment type
if ($_POST['payment'] === '1') 
{   $p_type = "Cash";
	
};
if ($_POST['payment'] === '2') 
{   $p_type = "Credit";
	
};
if ($_POST['payment'] === '3') 
{   $p_type = "Check";
	
};

// Add the payment to the payment table
$q = "INSERT INTO payment(amount, paymentDate, paymentTypeID) VALUES ('$total', NOW(), '{$_POST['payment']}')";

$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {

	// Need the payment ID:
	$pid = mysqli_insert_id($dbc);
	}
	
// Add reservation to reservation table
$q ="INSERT INTO reservation(revDate, revTime, duration, user_id, paymentID) VALUES ('{$_POST['date']}', '{$_POST['time']}', '{$_POST['hours']}', '{$_SESSION['user_id']}', $pid)  ";
$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {

	// Need the reservation ID:
	$rid = mysqli_insert_id($dbc);
	}	

// Add reservation_room to reservation_room table

$q= "INSERT INTO room_reservation(reservationID, roomID) VALUES ($rid, '{$_POST['roomID']}') ";
$r = mysqli_query($dbc, $q);


//close database connection	
mysqli_close($dbc);
?>

<h2 align="center">Reservation Confirmation</h2>

 <p>Room Number: <?php echo $_POST['roomID']; ?></p>
 <p>Description: <?php if (isset($_POST['description'])) echo $_POST['description']; ?></p>
 <p>Max Occupancy: <?php if (isset($_POST['maxOccupancy'])) echo $_POST['maxOccupancy']; ?></p>
 <p>Price: $<?php if (isset($_POST['price'])) echo $_POST['price']; ?></p>
 <p>Date: <?php if (isset($_POST['date'])) echo $_POST['date']; ?></p>
 <p>Time: <?php if (isset($_POST['time'])) echo $_POST['time']; ?></p>
 <p>Duration in Hours: <?php if (isset($_POST['hours'])) echo $_POST['hours']; ?></p>
 <p>Payment Type: <?php if (isset($_POST['payment'])) echo $p_type; ?></p>
 <p>Total: $<?php echo number_format((float)$total, 2, '.', ''); ?></p>
 
 <p><center><input type=button onClick="location.href='history.php'" value="View Reservations"></center></p>
 
<?php

include ('includes/footer.html');
?>