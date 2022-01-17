<?php 
if (!session_id()) {
  session_start();
} 
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<link href="js/bootstrap.min.css" rel='stylesheet' type='text/css' />
  <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />

  <style type="text/css">
    .fontColor{
      color: white;
      font-size: 1.0vw;
    }
  </style>


<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav input[type=text] {
  float: none;
  padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  border: none;
  font-size: 17px;
}

@media screen and (max-width: 600px) {
  .topnav a, .topnav input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }

}

.topnav-right {
  float: right;
  margin-right: 5%;
}

.topnav-center {
  float: left;
   margin-left: 10% ;
}

.topnav-left {
  float: left;
   margin-left: 5% ;
}



</style>
</head>
<body>


  <!-- header-section-starts -->
  <div class="topnav">
        <div class="topnav-left">
              
          <ul>
                  <a  href = "user.php">
            <?php 
            $userId=$_SESSION['user'];
            $res=$conn->query("select * from user where userId='$userId';");
            $row=$res->fetch_object();
                  $uType = $row->status;

            echo "<span class='glyphicon glyphicon-user'> </span>". strtoupper($row->userName);
            
            ?>
                  </a>
                   <?php 
                      if($uType==202) {
                        echo "<a href='index.php' >HOME</a>"; //Means not admin
                      }
                      else {
                        echo "<a href='adminpage.php' >HOME</a>"; //Means admin
                      }
                    ?>
                    
                    <a href="about.php">ABOUT</a>
                    <a href="showtimes.php">SHOW TIMINGS</a>
                    <a href="trailers.php">WATCH TRAILERS</a>
                    <a> <img src="images/logo.png" style="width:250px;height:30px; margin-left:20%; "> </a>
          </ul>
            </div>
            <div class = "topnav-center">
            <form action="search.php" method="POST">
              <input type="text" placeholder="Search Movie Name Here..." name="search" size="">
            </form>
            </div>
            <div class="topnav-right">  
                 
                <a  href="logout.php"> <span class='glyphicon glyphicon-off'> LOGOUT </a>   
                
            </div>
            
          </div>
        </nav>
     </div>
  </div>
  
</body>
<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/main.js"></script>
</html>
                  
          