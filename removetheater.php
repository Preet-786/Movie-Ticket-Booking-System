<?php
  if (!session_id()) {
    session_start();
  }
  include_once ('db.php');
  ?>

<!DOCTYPE html>
<html>
<head>	

	<link rel="stylesheet" type="text/css" href="css/registration.css">
	<link rel="stylesheet" type="text/css" href="js/bootstrap.min.css">
	<style type="text/css">
		
		.MovieGenre{width: 100%;
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
		body, html {
			height: 100%;
			margin: 0;
		}
		.wrapper{
			text-align: center;
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

<body >
	<?php 
		if(!empty($_SESSION['user']) ) { include_once 'header.php';}
	    else { include_once 'header2.php';} 
	?>
	<div class="bg">

		<div class="container">  
			<form id="contact" action="removetheater.php" method="post" enctype="multipart/form-data">
				<h2  style="text-align: center;    font-family: cursive"><b>Delete Theatre</b></h2>


<center>
			
<select name="theatreSelection" id="theatreSelection" required>
<option value="">-- Select theatre --</option></center>
<br>
			<?php
				$movieRes=$conn->query("select * from theater;");
				if($movieRes){
					$cnt = 1;
					while ($movieRes && $movieRow=$movieRes->fetch_object()) {
						$movieName = $movieRow->theaterName;
							echo "<option value = '$movieName' > $movieName </option>"; 
						$cnt++;
					}
				}
			?>
			</select>
<p><br></p>
					<input style="font-size: larger;background-color: #c2fbb8;font-family: cursive;font-weight: bold;" 	class="MovieGenre" type="submit" name="submit"> 
				<p class="copyright"></p>
				<p></p>


			</form><p><br></p>
			<div class="wrapper">
				<button class="btn btn-default" onclick="document.location.href='adminpage.php'" > <span class='glyphicon glyphicon-chevron-left'> </span>BACK TO THE ADMIN PAGE</button>
			</div>

		</div>

	</div>
</body>
</html> 

<?php 
if (isset($_POST['submit'] )&& !empty($_POST['submit']))
{
	$MovieName=$_POST['theatreSelection'];
	
	if (!empty($MovieName) )
	{
		$var=new DeleteProduct();
		$var->productDel($conn);
	}
	
}
else{
	
}
?>


<?php 

class DeleteProduct{
	public function productDel($conn)
	{
		$Name=$_POST['theatreSelection'];

		$sql = "select * from theater where theaterName = '$Name'";

		
		if($result = $conn -> query($sql)){
			if($result -> num_rows>0){
				$sql = "delete from theater where theaterName = '$Name'";
				$sql2 = "delete from timeslot where Theatre = '$Name'";

				if(($result = $conn -> query($sql) ) && ($result2 = $conn -> query($sql2))) {
				$_SESSION['msg']="Theatre Deleted Successfuly";
				echo "<script> alert('Theatre is Deleted Successfuly')</script>";
				}
			}
			else
			{
				$_SESSION['msg']="Theater is not deleted";
				echo "<script>alert('Theatre Is Not Deleted')</script>";
				var_dump($conn->error);
			}		
		}
		else
			{
				$_SESSION['msg']="Theater is not deleted";
				echo "<script>alert('Theatre Is Not Deleted')</script>";
				var_dump($conn->error);
			}
		/*
		$target="uploadimages/".basename($_FILES['image']['name']);
		$image=$_FILES['image']['name'];
		$image_tmp=$_FILES['image']['tmp_name'];
		*/
		
		
		//header ("Location: adminpage.php" );

	}
}


?><?php mysqli_close($conn); ?>