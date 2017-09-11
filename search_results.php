
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
require ('../../connection/mysqli_connect.php');?>


<?php 

$s_date = $_POST['date'];




if ($_POST['maxO'] === 'any') 
{   $s_min = 1;
	$s_max = 1000;
};
if ($_POST['maxO'] === '1-25') 
{   $s_min = 1;
	$s_max = 25;
};
if ($_POST['maxO'] === '26-50') 
{
	$s_min = 26;
	$s_max = 50;
};
if ($_POST['maxO'] === '51-75') 
{
	$s_min = 51;
	$s_max = 75;
};
if ($_POST['maxO'] === '76-100') 
{
	$s_min = 76;
	$s_max = 100;
};

// Default query for this page:


$q = "SELECT DISTINCT room.* FROM room JOIN room_reservation ON room.roomID=room_reservation.roomID WHERE (room_reservation.roomID NOT IN (SELECT room_reservation.roomID FROM room_reservation JOIN reservation ON room_reservation.reservationID=reservation.reservationID WHERE reservation.revDate ='{$s_date}')) AND (room.maxOccupancy BETWEEN '{$s_min}' AND '{$s_max}') ORDER BY room.roomID ";
####################################################
$image = array();
$img_small = "";
$img_large = "";
$i = 0;
$r = mysqli_query ($dbc, $q);?>
<div class="content">
<?php
if (!mysqli_num_rows($r) == 0) {
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) 
{
$img_large = $row['roomID']. "_lg.jpg";
$img_small = $row['roomID'] . "_sm.jpg";

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
		   <p>Room Number: {$row['roomID']}</p>
	       <p>Description: {$row['description']}</p>
		   <p>Max Occupancy: {$row['maxOccupancy']}</p>
           <p>Price: \${$row['price']}</p>
           <form action=\"reservation.php\" method=\"post\">
   
	<input type=\"hidden\" name=\"roomID\" value=\"{$row['roomID']}\"/> 
	<input type=\"hidden\" name=\"description\" value=\"{$row['description']}\" />
    <input type=\"hidden\" name=\"maxOccupancy\" value=\"{$row['maxOccupancy']}\" /> 
	<input type=\"hidden\" name=\"price\" value=\"{$row['price']}\"/>
	<input type=\"hidden\" name=\"date\" value=\"{$_POST['date']}\"/>
	<p align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Reserve\" /></p>
    </br>
 </form>
		   </td>
		   </tr>
   </table>   
   <hr />
 
";

$i++;
} // End of while loop.
####################################################
} else { // No records!
			echo  "<center><h2>There are no records that match your search criteria</h2></center>";
		}
?>
</div>
<?php
mysqli_close($dbc);
include ('includes/footer.html');
?>