  <?php
  if (!session_id()) {
    session_start();
  }
  include_once ('db.php');
  ?>

  <!DOCTYPE html>
  <html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="#">

  <title>Online Movie Tickets Management System</title>

  <!-- Bootstrap core CSS -->
  <!-- <link href="./movie_files/bootstrap.min.css" rel="stylesheet"> -->
  <link href="https://bootswatch.com/flatly/bootstrap.css" rel="stylesheet">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="js/ie-emulation-modes-warning.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Custom styles for this template -->
      <link href="css/rotating-card.css" rel="stylesheet">
      <link href="css/bootstrap-datepicker.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
    </head>
<!-- NAVBAR
  ================================================== -->
  <body background="background-color: #3a1e1e;">
    
    <?php 
    if(!empty($_SESSION['user']) ) { include_once 'header.php';}
      else { include_once 'header2.php';} 
    include 'carousel.php';

    ?>

    <?php 

		$month = date('m');
		$day = date('d');
		$year = date('Y');

		$today = $year . '-' . $month . '-' . $day;
	?>

    <div class='container'> 
    	<form action="showtimes.php" method="POST">
        <table>
          <tr> <td style="width:50%;"><label>Date</label></td> <td style="width:40%;"> <label> Theatre </label></td><td> <label> Filter Data </label></td></tr>
          <tr>
            <td>
			<input type="date" style="width:200px;" value="<?php echo $today; ?>" class="form-control" id="date" name="date">
    </td>
    <td>
			<select name="TheatreSelection" id="TheatreSelection">
			<?php
				$theaterRes=$conn->query("select * from theater;");
				if($theaterRes){
					$cnt = 1;
					while ($theaterRes && $theaterRow=$theaterRes->fetch_object()) {
						$thName = $theaterRow->theaterName;
						if($cnt==1){
							echo "<option value = '$thName' selected> $thName </option>"; 
						}
						else {
							echo "<option value = '$thName'> $thName </option>";
						}
						$cnt++;
					}
				}
			?>
		    </select>
		    <script type="text/javascript">
			  document.getElementById('TheatreSelection').value = "<?php echo $_POST['TheatreSelection'];?>";
			  document.getElementById('date').value = "<?php echo $_POST['date'];?>";
			</script>
    </td>
    <td>
			<input type='submit' name='submitt' >
    </td>
  </tr>
</table>
		</form>
	</div>

    <div  class="container">
      <table id="fresh-table" class="table" width="100%">
        <thead>
          <th data-field="name" data-sortable="true">Movie</th>
          
          <th data-field="shows">Shows</th>
          <th>Action</th>

        </thead>
        <tbody>

          <?php 

          $movieRes=$conn->query("select * from movielist;");
          while ($movieRes && $movieRow=$movieRes->fetch_object()) {

           ?>
            <tr>
              <td style="font-weight: bold;"><?php echo "".$movieRow->Name;?>
              </td>
                <?php 
                $myDate = $today;
                $theatreName = isset($_POST['TheatreSelection']);
                if(isset($_POST['submitt'])) {
                	$myDate = $_POST['date'];
                	$theatreName = $_POST['TheatreSelection'];
                }
                $movieName = $movieRow->Name;
                //echo $myDate;
$sql = "select * from timeSlot where Name like '$movieName' and Theatre like '$theatreName' and Date like '$myDate' ";

				
                $movieTime=$conn->query($sql);
                
                
                $shows =""; 

                while ($movieTime && $movieTimeRow = $movieTime->fetch_object()) {
                	$shows =$shows.",".$movieTimeRow->time;	 
                }

                if($shows==""){
                	echo "<td>No shows at this date </td>";
                	echo "<td> Can Not Book Ticket";
                }
                else{
                //DropDown
                	$str_arr = explode (",", $shows); 
					$mapping = array("9"=>"","12"=>"","15"=>"","18"=>"");
					foreach ($str_arr as $key => $value) {
						if($value!="")
						$mapping[$value]=$value.":00";
					}
					echo "<td>";
					foreach ($mapping as $key => $value) {
						if($value!="")
							echo "<span class='label label-primary'>".$value."</span> &nbsp;";
					}
	                echo "</td>";
	                if(empty($_SESSION['user'])){
	                	echo "
	                	<td>
                		<input type='submit' onclick='myFunction()' style='width:200px;' class='btn btn-primary btn-xs btn-block' type='submit' value='Book Ticket' name='submit'>
              			</td>";
              		}
              		else{
              			$sql = "select * from movielist where Name like '$movieName'";
              			$movieeRes=$conn->query($sql);
              			$movieId ="";
              			if($movieeRes && $movieeRow=$movieeRes->fetch_object()){
              				$movieId = $movieeRow->movieId;
              			}

              			echo "<td >
              			<form action='ticketProcessing.php' method='post' >
                        <input type='hidden' name='movieId' value='".$movieId."' >

                        <input type='submit' style='width:200px;' class='btn btn-primary btn-xs btn-block' type='submit' value='Book Ticket' name='submit'>
                      	</form>
                      	</td>";
              		}
	            }
                ?>
            	

              
            </tr>
            <?php  } ?>
          </tbody>


        </table>
      </div>
    </div>
  </div>
</div>
</div>
</section>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/bootstrap-table.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/main.js"></script>
    <script>
		function myFunction() {
		  alert("Please Login And Then Try To Book");
		}

      $( document ).ready(function() {
        $('.datepicker').datepicker({
          weekStart:1,
          color: 'red'
        });
      });

      // table showtime
      var $table = $('#fresh-table'),
      $alertBtn = $('#alertBtn'), 
      full_screen = false,
      window_height;

      $().ready(function(){

        window_height = $(window).height();
        table_height = window_height - 20;


        $table.bootstrapTable({
          toolbar: ".toolbar",

          showRefresh: true,
          search: false,
          showToggle: true,
          showColumns: true,
          pagination: true,
          striped: true,
          sortable: true,
          height: table_height,
          pageSize: 25,
          pageList: [25,50,100],
          
          formatShowingRows: function(pageFrom, pageTo, totalRows){
              //do nothing here, we don't want to show the text "showing x of y from..." 
            },
            formatRecordsPerPage: function(pageNumber){
              return pageNumber + " rows visible";
            },
            icons: {
              refresh: 'fa fa-refresh',
              toggle: 'fa fa-th-list',
              columns: 'fa fa-columns',
              detailOpen: 'fa fa-plus-circle',
              detailClose: 'fa fa-minus-circle'
            }
          });

        window.operateEvents = {
          'click .like': function (e, value, row, index) {
            alert('You click like icon, row: ' + JSON.stringify(row));
            console.log(value, row, index);
          },
          'click .edit': function (e, value, row, index) {
            alert('You click edit icon, row: ' + JSON.stringify(row));
            console.log(value, row, index);    
          },
          'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
              field: 'id',
              values: [row.id]
            });

          }
        };

        $alertBtn.click(function () {
          alert("You pressed on Alert");
        });


        $(window).resize(function () {
          $table.bootstrapTable('resetView');
        });    
      });


      function operateFormatter(value, row, index) {
        return [
        '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
        '<i class="fa fa-heart"></i>',
        '</a>',
        '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
        '<i class="fa fa-edit"></i>',
        '</a>',
        '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-remove"></i>',
        '</a>'
        ].join('');
      }
    </script>
  </div>
  <!-- FOOTER -->

  <?php include 'footer.php'; ?>
</body>
</html>