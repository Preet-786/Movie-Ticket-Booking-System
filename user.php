<?php include_once "header.php"; ?>
<?php

	$userId=$_SESSION['user'];
	$res=$conn->query("select * from user where userId='$userId';");
	$row=$res->fetch_object();
	$uName = $row->userName;
	$uId = $row->userId;
	$uType = "";
	if($row->status == 101){
		$uType = "admin";
	}
	else{
		$uType = "user";
	}


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
  border-color: black;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.about-section {
  padding: 50px;
  text-align: center;
  color:black;
}
a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}


</style>
</head>
<body>
<div class="about-section">
  <h1>Welcome To India's Best Online Movie Booking Site</h1>
</div>

<h2 style="text-align:center;">User Profile Card</h2>

<div class="card">
  <img src="https://media.istockphoto.com/vectors/profile-icon-male-avatar-portrait-casual-person-vector-id530827853?k=6&m=530827853&s=612x612&w=0&h=FYnhkmLYaHjYSyTva1A72eDj5yu3sU7TUXg_BsH1Dfw=" alt="John" style="width:100%">
<h1> <?php echo "Your Name : ".$uName."<br>";?></h1>
  <p class="title"> <?php echo "Your Id : ".$uId."<br>";?></p>
  <p class="title"> <?php echo "Your Type : ".$uType."<br>";?></p>
  
 
  <div style="margin: 24px 0;">
    <a href="#"><i class="fa fa-dribbble"></i></a> 
    <a href="#"><i class="fa fa-twitter"></i></a>  
    <a href="#"><i class="fa fa-linkedin"></i></a>  
    <a href="#"><i class="fa fa-facebook"></i></a> 
  </div>
  <p><button></button></p>
</div>

</body>
</html>