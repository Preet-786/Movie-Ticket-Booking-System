<?php 
if (!session_id()) {
  session_start();
} 
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/registration.css">
	<link rel="stylesheet" type="text/css" href="js/bootstrap.min.css">
	<title>Remove Time Slot</title>
	<style type="text/css">


.label {
  color: white;
  padding: 8px;
  font-family: Arial;
}
.warning {background-color: #ff9800;} /* Orange */
.danger {background-color: #f44336;} /* Red */ 
.safe {background-color: #a4f542;} /*green*/

		input[type="checkbox"][readonly] {
			  pointer-events: none;
			}

		.boxStyle{width: 100%;
			border: 1px solid #ccc;
			background: #FFF;
			margin: 0 0 5px;
			padding: 10px;
			font-style: normal;
			font-variant-ligatures: normal;
			font-variant-caps: normal;
			font-variant-numeric: normal;
			font-weight: 400;
			font-stretch: normal;
			font-size: 12px;
			line-height: 16px;
			font-family: Roboto, Helvetica, Arial, sans-serif;
			
		}
		.wrapper{
			text-align: center;
		}
		body, html {
			height: 100%;
			margin: 0;
		}

		
		.bg { 
			/* The image used */
			background-image: url("images/addMovieBackground.jpg");

			/* Full height */
			height: 100%; 

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>
</head>
<?php 
		if(!empty($_SESSION['user']) ) { include_once 'header.php';}
      else { include_once 'header2.php';}  
	?>
<body >	
	<div class="bg" >
		
		<div class="container">  
<form id="contact" action="removeTimeSlot.php" method="post" enctype="multipart/form-data">

				
				<input style="font-size: larger; text-align: center; background-color: #c2fbb8;font-family: cursive;font-weight: bold;" 
				class="boxStyle" type="text" name="" value="Remove Time Slot" readonly> 
				<p class="copyright"></p>
				<br>
		

<label> Select Theater </label><br>
<select name="TheatreSelection" id="TheatreSelection" required>
<option value="">  -- Select Theater --</option>

			<?php
				$theaterRes=$conn->query("select * from theater;");
				if($theaterRes){
					$cnt = 1;
					while ($theaterRes && $theaterRow=$theaterRes->fetch_object()) {
						$thName = $theaterRow->theaterName;
						echo "<option value = '$thName'> $thName </option>";
						$cnt++;
					}
				}
			?>
  </select>
 <br><br> 

<label> Select Date </label> <br>

<input type="date" id="date" name="date" required>
<script type="text/javascript">
			  document.getElementById('TheatreSelection').value = "<?php echo $_POST['TheatreSelection'];?>";
			  document.getElementById('date').value = "<?php echo $_POST['date'];?>";
</script>

<br><br>
<center><input type="submit" name="submit1" value="Show Booked Time Slots"></center>
<br>

<?php
	if(isset($_POST['submit1']) )  
	{  
		echo "<p> NOTE : You can only select/unselect red colored time slots because green colored time slots are not booked yet, So you can't remove it.</p> <br> 
			<label> Select for removal</label> <br>";


		$theatreName=$_POST['TheatreSelection'];
		//$movieName=$_POST['movieSelection'];
		$myDate=$_POST['date'];

		$sql = "select * from timeSlot where Theatre like '$theatreName' and Date like '$myDate' ";
		$movieTime=$conn->query($sql);
                
                $shows =""; 

                while ($movieTime && $movieTimeRow = $movieTime->fetch_object()) {
                	if($shows!="") $shows =$shows.",".$movieTimeRow->time;	 
                	else $shows = $movieTimeRow->time;
                }

                if($shows==""){
                	
                	echo "
                	<input type='checkbox' name='slot[]' value='9' readonly>
					<span class='label safe'><label for='slot1'> 9:00  </label></span><br>
  
 					 <input type='checkbox'  name='slot[]' value='12' readonly>
					 <span class='label safe'> <label for='slot2'>  12:00  </label></span><br>
					  
					  <input type='checkbox'  name='slot[]' value='15' readonly>
					  <span class='label safe'><label for='slot3'>  15:00   </label></span><br>
					  
					   <input type='checkbox' name='slot[]' value='18' readonly>
					  <span class='label safe'><label for='slot4'>  18:00  </label></span><br><br> ";
                }
                else{
                		
                	$str_arr = explode (",", $shows); 
					$mapping = array("9"=>"","12"=>"","15"=>"","18"=>"");
					foreach ($str_arr as $key => $value) {
						if($value!="") $mapping[$value]=$value.":00";
					}

					foreach ($mapping as $key => $value) {
							if($value!="") {
							echo "
							<input type='checkbox' name='slot[]' value='".$key."'>
							<span class='label danger'><label for='slot1' >".$value."</label></span><br>
									";
							}
							else{
								echo "
								<input type='checkbox' name='slot[]' value='".$key."' readonly>
								<span class='label safe'><label for='slot1'> ".$key.":00  </label></span> <br>
								";
							}
					}
				}
	}
?>

  
		<center><input type="submit" name="submit" value="Submit"></center>
</form>
			
			<div class="wrapper">
				<button style="text-align: center;" class="btn btn-default" onclick="document.location.href='adminpage.php'" ><span class='glyphicon glyphicon-chevron-left'> </span>BACK TO THE ADMIN PAGE</button>
			</div>
		</div>
	</div>

</body>
</html>
<?php  
if(isset($_POST['submit']) )  {  
 
$theatreName=$_POST['TheatreSelection'];
//$moviename=$_POST['movieSelection'];
$myDate=$_POST['date'];



if(isset($_POST['slot'])) {
	$checkbox1 = $_POST['slot'];   


	foreach($checkbox1 as $chk1)  {
		//echo "time - $chk1 : <br>";

		$conn = new mysqli($host, $username, $password,$db_name);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} else{
			
		}
		$sql = "select * from timeSlot where Theatre like '$theatreName' and Date like '$myDate'";
		$movieTime=$conn->query($sql);
		if($movieTime){
		 
			while ($movieTimeRow = $movieTime->fetch_object()) {

				$timeColumn = $movieTimeRow->time;
				$tc = $timeColumn;
				$id = $movieTimeRow->timeslotId;
				$i = strpos($timeColumn,$chk1);
				//echo "$i : before replace $timeColumn<br>";
				if($i===FALSE) continue;
				elseif($i==0 || $i){
					
					if(!strpos($timeColumn,",")) $timeColumn="";
					else{
						if($i==0){
							$timeColumn = str_replace($chk1.",","",$timeColumn);
						}
						else{
							$timeColumn = str_replace(",".$chk1,"",$timeColumn);
						}
					}
					//echo "$i : After replace $timeColumn<br>";
					if($timeColumn!="" && $tc!=$timeColumn){
						$sql = "UPDATE timeSlot SET time = '$timeColumn' WHERE timeslotId='$id'";
						//echo $sql."<br>";
						if ($conn->query($sql) === TRUE) {

						  //echo "$id : Record updated successfully";
						} else {
						  //echo "$id : Error updating record: " . $conn->error;
							//var_dump($conn->error);
						}
					}
					elseif($timeColumn==""){
						$sql = "DELETE FROM timeSlot WHERE timeslotId='$id'";
						//echo $sql."<br>";
						if ($conn->query($sql) === TRUE) {
						  //echo "$id : Record Deleted successfully";
						} 
						else {
						  //echo "$id : Error Deleting record: " . $conn->error;
							//var_dump($conn->error);
						}
					}
				}
			}
		}
		$conn->close();
	}
	echo'<script> alert("Removal opration successful") </script>';
}
else {
	echo'<script> alert("Failed, No data found") </script>';
}

 //  if($chk!="") {
 //  	$in_ch=mysqli_query($conn,"insert into timeslot values (' ','$chk','$moviename','$theatre','$dt')");  		
 //  	if($in_ch==1)  { echo'<script> alert("Inserted Successfully") </script>';  }  
 //  	else   {  echo'<script> alert("Failed To Insert") </script>';  }  
	
	// }
	// else {
	// 	echo'<script> alert("Can Not Insert, Please select appropriate timings")</script>';	
	// }

}
?>  
