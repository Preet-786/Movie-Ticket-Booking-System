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
	<title>Add time Slot</title>
	<style type="text/css">


.label {
  color: white;
  padding: 8px;
  font-family: Arial;
}
.warning {background-color: #ff9800;} /* Orange */
.danger {background-color: #f44336;} /* Red */ 


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
<form id="contact" action="addTimeSlot.php" method="post" enctype="multipart/form-data">

				
				<input style="font-size: larger; text-align: center; background-color: #c2fbb8;font-family: cursive;font-weight: bold;" 
				class="boxStyle" type="text" name="" value="Add Time Slot" readonly> 
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
<label> Select Movie </label><br>
  <select name="movieSelection" id="movieSelection" required>
  <option value="">-- Select Movie --</option>

			<?php
				$movieRes=$conn->query("select * from movielist;");
				if($movieRes){
					$cnt = 1;
					while ($movieRes && $movieRow=$movieRes->fetch_object()) {
						$movieName = $movieRow->Name;
							echo "<option value = '$movieName'> $movieName </option>";
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
			  document.getElementById('movieSelection').value = "<?php echo $_POST['movieSelection'];?>";
			  document.getElementById('date').value = "<?php echo $_POST['date'];?>";
			</script>

<br><br>
<center><input type="submit" name="submit1" value="Show Available Time"></center>
<br>

<?php
	if(isset($_POST['submit1']) )  
	{  
		$theatreName=$_POST['TheatreSelection'];
		$movieName=$_POST['movieSelection'];
		$myDate=$_POST['date'];

		

		$sql = "select * from timeSlot where Theatre like '$theatreName' and Date like '$myDate' ";
		$movieTime=$conn->query($sql);
                
                $shows =""; 

                while ($movieTime && $movieTimeRow = $movieTime->fetch_object()) {
                	if($shows!="") $shows =$shows.",".$movieTimeRow->time;	 
                	else $shows = $movieTimeRow->time;
                }

                if($shows==""){
                	$_SESSION['showw'] = "0";

                	echo "
                	<input type='checkbox' name='slot[]' value='9'>
					<label for='slot1'> 9:00  </label><br>
  
 					 <input type='checkbox'  name='slot[]' value='12'>
					  <label for='slot2'>  12:00  </label><br>
					  
					  <input type='checkbox'  name='slot[]' value='15'>
					  <label for='slot3'>  15:00   </label><br>
					  
					   <input type='checkbox' name='slot[]' value='18'>
					  <label for='slot4'>  18:00  </label><br><br> ";
                }
                else{
                	
                	$_SESSION['showw'] = "1";
                	$str_arr = explode (",", $shows); 
					$mapping = array("9"=>"","12"=>"","15"=>"","18"=>"");
					foreach ($str_arr as $key => $value) {
						if($value!="") $mapping[$value]=$value.":00";
					}

					foreach ($mapping as $key => $value) {
							if($value!="") {
							echo "
							<input type='checkbox' name='slot[]' value='".$key."' readonly>
							<span class='label danger'><label for='slot1' >".$value."</label></span><br>
									";
							}
							else{
								echo "
								<input type='checkbox' name='slot[]' value='".$key."'>
								<label for='slot1'> ".$key.":00  </label><br>
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
if(isset($_POST['submit']) )  
{  
 
$theatre=$_POST['TheatreSelection'];
		$moviename=$_POST['movieSelection'];
		$dt=$_POST['date'];


$checkbox1=isset($_POST['slot'])? $_POST['slot'] : array() ;  
$chk="";  


foreach($checkbox1 as $chk1)  {  
      $chk .= $chk1.",";  
  }
  if($chk!="") $chk = substr($chk,0,-1);

  $chk = trim($chk," ");
  //echo $chk;

  if($chk!="") {
  	$in_ch=mysqli_query($conn,"insert into timeslot values (' ','$chk','$moviename','$theatre','$dt')");  		
  	if($in_ch==1)  { echo'<script> alert("Inserted Successfully") </script>';  }  
  	else   {  echo'<script> alert("Failed To Insert") </script>';  }  
	
	}
	else {
		echo'<script> alert("Can Not Insert, Please select appropriate timings")</script>';	
	}

}

?>  
