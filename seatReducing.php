<?php 
if (!session_id()) {
	session_start();
} 
include 'db.php';


$seat=$_POST['seat']-1;

$sql="update showOrder set seat=".$seat." where showOrderId=".$_POST['showOrderId'].";";
if ($conn->query($sql) === TRUE) {
	//echo "succeed";
	$_SESSION['booked'] = "Ticket Has Been Booked";
	
}
else{
	echo "Error: " . $sql . "<br>" . $conn->error;
	$_SESSION['booked'] = "Ticket Has Not Been Booked";
}

header('Location: customerPage.php')
?>

