<?php
    session_start();

    //check if logged in
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    }else{
        //if not logged in go to login page
        header('Location: login.php');
    }
    
    //connect to database
    include("connect.php");

    $email = $_SESSION['email'];

    $query1 = "SELECT * FROM USER WHERE Email='".$email."'";
    $result = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($result);
    $fName = $row["First"];
    $lName = $row["Last"];
    $uID = $row["uID"];

    $query2 = "SELECT * FROM IS_SUBBED WHERE User_ID='".$uID."'";
?>

<html lang='en'>
    <head>
        <title>CMPS3640 Project</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta name="keyword" content="signup, project, cmps3640, notification, system">
        <meta name="description" content="The signup page for the cmps3640 project">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    </head>
    <body style="background-color:#cfcfcf;">
	<div class="container-fluid"> 
		<div class="row m-4" style="background-color:white;">
			<div class="col-sm-8 m-4"> <h3>Hello <?php echo $fName." ".$lName?></h3> </div>
			<div class "col-sm-1"> <a href="#" class=""><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bell-fill mt-4 mr-2" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
</svg></div>
			<div class="col-sm-2 mt-4"> <a href="logout.php" type="button" class="btn btn-outline-primary">Log Out</a></div>
		</div>
		<div class="row justify-content-start">
			<div class="col-4 align-self-start m-2" style="background-color:white;">
				<div class="m-2">
					<b> Receiving Notifications From </b><hr>
					<?php
						if($result=$db->query($query2)){
							while($row=$result->fetch_assoc()){
								$gName = $row["gName"];

								echo '<tr>
									<td>'.$gName.'</td>
								     </tr>';
							}
							$result->free();
						}
					?>
					<br>
					<a href="#" type="button" class="mt-4 btn btn-outline-primary">Add Groups</a>
				</div>
			</div>
			<div class="col-7 align-self-start m-2" style="background-color:white;">
				<div class="m-2">
					<b> Notifications</b><a href="#" class="">  Send Notificaiton </a><hr>
				</div>
			</div>
		</div>
	</div>
    </body>
</html>
