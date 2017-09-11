
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
$page_title = 'View Reservations';
include ('includes/header.html');
require ('../../connection/mysqli_connect.php');

// Default query for this page:
$q = "SELECT u.`first_name` u_fn, u.`last_name` u_ln, rr.`reservationID` rr_rvID, rr.`roomID` rr_rID, 

r.`roomID` r_rID, r.`maxOccupancy` r_maxO, r.`price` r_price, r.`description` r_desc, 

rv.`reservationID` rv_rvID, rv.`revDate` rv_date, rv.`revTime` rv_time, rv.`duration` rv_hour, 

rv.`user_id` rv_uID, rv.`paymentID` rv_pay FROM `reservation` rv JOIN `users` u ON 

rv.`user_id`=u.`user_id` JOIN `room_reservation` rr ON rv.`reservationID`=rr.`reservationID` JOIN 

`room` r ON rr.`roomID`=r.`roomID` WHERE rv.`user_id`= '" . $_SESSION['user_id'] . "' ORDER BY rv.`revDate` DESC,rv.`revTime` DESC";
####################################################
$image = array();
$img_small = "";
$img_large = "";
$i = 0;
$r = mysqli_query ($dbc, $q);?>
<div class="content">
<center><h2>Room Reservation History</h2></center>
<?php
if (!mysqli_num_rows($r) == 0) {
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) 
{
$img_large = $row['r_rID']. "_lg.jpg";
$img_small = $row['r_rID'] . "_sm.jpg";

echo "
  
        
		   <table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"10\">
		   
	       <tr>
           <td style=\"text-align:center;\" width=\"50%\">";
if (@getimagesize("images/{$img_small}")) {
echo "		   
           <img src=\"images/{$img_small}\" width=\"250\" height=\"167\" border=\"2\"/>";
		   }
else {
echo 
	"<img src=\"images/unavailable.jpg\" width=\"250\" height=\"167\" border=\"2\"/>";
}
echo "		   
		   <p><a href=\"javascript:create_window('$img_large', 750, 500)\"><img border=\"0\" alt=\"view larger image\" src=\"images/enlarge_icon.gif\"></a></p>
		   </td>
		   <td>
		   <p>Date: {$row['rv_date']}</p>
		   <p>Time: {$row['rv_time']}</p>
		   <p>Room Number: {$row['r_rID']}</p>
	       <p>Description: {$row['r_desc']}</p>
		   <p>Max Occupancy: {$row['r_maxO']}</p>
           
           
		   </td>
		   </tr>
   </table>   
   <hr />
 
";

$i++;
} // End of while loop.
####################################################
} else { // No records!
			echo  "<center><h2>You have no previous or current reservations</h2></center>";
		}?>
</div>
<?php
mysqli_close($dbc);
include ('includes/footer.html');
?>