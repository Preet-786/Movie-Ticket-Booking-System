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
			<form id="contact" action="DeleteMovie.php" method="post" enctype="multipart/form-data">
				<h2  style="text-align: center;    font-family: cursive"><b>Delete Movie</b></h2>



				
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

<p><br></p>

				<input style="font-size: larger;background-color: #c2fbb8;font-family: cursive;font-weight: bold;" 
				class="MovieGenre" type="submit" name="submit"> 
				<p class="copyright"></p>
				<p></p>


			</form>
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
	$MovieName=$_POST['movieSelection'];
	
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
		$Name=$_POST['movieSelection'];
		$sql = "select * from movielist where Name = '$Name'";
		
		if($result = $conn -> query($sql)){
			if($result -> num_rows>0){
				$sql = "delete from movielist where Name = '$Name'";
				$sql2 = "delete from timeslot where Name = '$Name'";
				$sql3 = "delete from trailer where movieName = '$Name'";
				if(($result = $conn -> query($sql)) && ($result2 = $conn -> query($sql2)) &&  ($result3 = $conn -> query($sql3))) {
				//echo "Returned rows are: " . $result -> num_rows;

				$_SESSION['msg']="Movie Deleted Successfuly";
				echo '<script> alert("Movie Deleted") </script>';
				}
			}
			else
			{
				$_SESSION['msg']="Movie is not deleted";
				echo '<script> alert("Movie Is Not Deleted") </script>';
				var_dump($conn->error);
			}		
		}
		else {
			$_SESSION['msg']="Movie is not deleted";
			echo '<script> alert("Movie Is Not Deleted") </script>';
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
$conn->close(); ?>