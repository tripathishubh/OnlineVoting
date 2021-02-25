<?php
	session_start();
	require('connection.php');
	if( empty($_SESSION['admin_id']) ){
	   header("location:access-denied.php");
	} 
    $mysqli = new mysqli("localhost", "root", "", "poll");
    $result = $mysqli->query("SELECT * FROM tbpositions");
    if (mysqli_num_rows($result)<1){
        $result = null;
    }
	?>
	<?php
	
	if (isset($_POST['Submit']))
	{

	$newPosition = addslashes( $_POST['position'] ); 

	$sql = $mysqli->query( "INSERT INTO tbpositions(position_name) VALUES ('$newPosition')" )
	        or die("Could not insert position at the moment". mysql_error() );


	   header("Location: positions.php");
	}
?>
<?php
	
	 if (isset($_GET['id']))
	 {
	 $id = $_GET['id'];

	 $result = mysql_query("DELETE FROM tbpositions WHERE position_id='$id'")
	 or die("The position does not exist ... \n"); 
	 

	 header("Location: positions.php");
	 }
	 else

    
?>

<!DOCTYPE html>
<html>
<head>
<title>online voting</title>
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <div id="logo" class="fl_left">
      <h1><a href="#">ONLINE VOTING SYSTEM</a></h1>
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li ><a href="admin.php">Home</a></li>
        <li class="active"><a class="drop" href="#">Admin Panel </a>
          <ul>
            <li><a href="manage-admins.php">Manage Admin</a></li>
            <li class="active"><a href="positions.php">Manage Positions</a></li> 
            <li><a href="elections.php">Elections</a></li>
            <li><a href="candidates.php">Approve Users</a></li>
            <li><a href="results.php">Results</a></li> 
          </ul>
        </li>
        <li><a href="logout.php">Logout</a></li>

      </ul>
    </nav>
  </header>
</div>
<div >
	<table width="380" align="center">
	<CAPTION><h3>ADD NEW POSITION</h3></CAPTION>
	<form name="fmPositions" id="fmPositions" action="positions.php" method="post" onsubmit="return positionValidate(this)">
	<tr>
	    <td bgcolor="#00ff80">Position Name</td>
	    <td bgcolor="#808080"><input type="text" name="position" /></td>
	    <td bgcolor="#00FF00"><input type="submit" name="Submit" value="Add" /></td>
	</tr>
	</table>

	<table border="0" width="420" align="center">
		<CAPTION><h3>AVAILABLE POSITIONS</h3></CAPTION>
		<tr>
		<th>Position ID</th>
		<th>Position Name</th>
		</tr>

		<?php
			
			while ($row=mysql_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['position_id']."</td>";
			echo "<td>" . $row['position_name']."</td>";
			echo '<td><a href="positions.php?id=' . $row['position_id'] . '">Delete Position</a></td>';
			echo "</tr>";
			}
			mysql_free_result($result);
			mysql_close($link);
		?>

	</table>
	<hr>
</div>

<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <div class="one_third first">
      <h6 class="title">Address</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          <p>
          Name        : Mr. Shubham Mani <br>
          University  : JAMIA HAMDARD <br>
          Batch       : 2016-19 <br>
          Dept        : CSE <br>
          </p>
          </address>
        </li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Phone</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-phone"></i> +91 9650469951</li>
        <li><i class="fa fa-phone"></i> +91 7065448544</li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Email</h6>
      <ul class="nospace linklist contact">  
        <li><i class="fa fa-envelope-o"></i> shubhamt6661@gmail.com </li>
        <li><i class="fa fa-envelope-o"></i> vmt661@gmail.com </li>
      </ul>
    </div>

  </footer>
</div>
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2019 - All Rights Reserved - <a href="#">Mr. Shubham</a></p>
    <p class="fl_right">Developed for <a target="_blank" href="http://www.os-templates.com/">Software Engineering Project</a></p>
  </div>
</div>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script language="JavaScript" src="js/user.js">
</script>
<script type="layout/scripts/bootstrap.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.placeholder.min.js"></script>
</body>
</html>