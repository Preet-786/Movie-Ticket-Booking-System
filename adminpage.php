<?php 
include 'db.php';
if (!session_id()) {
	session_start();
}
if (!(($_SESSION['user'])==1)) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link href="js/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/adminpage.css" rel="stylesheet" type="text/css" media="all" />
<style>
ul.a{
  list-style-type: none;
  margin: 0;
  padding: 0;
  height:380px;
  width: 350px;
  background-color: #f1f1f1;
  border: 1px solid #555;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
  height:60px;
  width: 350px;
}

li {
  text-align: center;
  border-bottom: 1px solid #555;
  height:60px;
  width: 350px;
}

li:last-child {
  border-bottom: none;
  height:60px;
  width: 350px;
}

li a.active {
  background-color:#0047b3;
  color: white;
  height:60px;
  width: 350px;
}

li a:hover:not(.active) {
  background-color: #009933;
  color: white;
  
}
.main {
  margin-left: 380px; /* Same width as the sidebar + left position in px */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}
@media screen and (max-height: 450px) {
  .ul {padding-top: 15px;}
  .ul a {font-size: 18px;}
}

</style>
</head>
<body style="background-image: linear-gradient(to right, #006699 , white)" >
	<!-- header-section-starts -->
							<?php 
								if(!empty($_SESSION['user']) ) { include_once 'header.php';}
							    else { include_once 'header2.php';} 
							?>
<table>
    <tr>
      <td>    
      <ul class="a" >
          <font size="5px">
        <li ><a href="AddMovie.php">Add Movie</a></li>
        <li ><a href="addtheater.php">Add Theater</a></li>
        <li ><a href="addTimeSlot.php">Add Time Slot</a></li>
        <li ><a href="DeleteMovie.php">Delete Movie</a></li>
          <li ><a href="removetheater.php">Remove Theater</a></li>
      	  <li ><a href="removetimeslot.php">Remove Timeslot</a></li>
      </font>
      </ul >
    </td>
    <td>

    <div class="main">
    		<?php 
    		
    		include 'user.php';
    		?>
        </div>
		</td>
  </tr>
</table>
		
	</body>
	<?php include 'footer.php'; ?>
	</html>
