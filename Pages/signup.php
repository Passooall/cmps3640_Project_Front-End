<?php
    //connect to database
include("connect.php");
include("functions.php");
    //check if connection is made
    if(mysqli_connect_errno())
    {
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }

    //When user posts something
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $passwrd = $_POST['passwrd'];
        $repasswrd = $_POST['repasswrd'];
        $user_id=id_gen($db);

        //Check to see if email is already in use
        $query1 = mysqli_query($db, "SELECT Email FROM USER WHERE Email='".$email."'");
        if(mysqli_num_rows($query1) != 0){
            //if in use display error
            echo '<span style="color:red;text-align:center;">E-mail is already registered</span>';
        } elseif(strlen($passwrd)<8 || strlen($passwrd)>20){
            //if password does not meet criteria display error
            echo '<span style="color:red;text-align:center;">Password must be between 8 and 20 characters</span>';
	    } elseif($passwrd!=$repasswrd){
	        //if passwords do not match
            echo '<span style="color:red;text-align:center;">Passwords do not match</span>';
	    }else{
            //create random user id
            $user_id = id_gen();
	        //encrypt password
	        $pass=encrypt($passwrd);
            //store user info into database
            $query = "INSERT INTO USER (First, Last, uID, Email, Pass) VALUES ('$fName', '$lName', $user_id, '$email', '$pass');";
            if(mysqli_query($db, $query)){
                //go to login page if successful
                header("Location: login.php");
            }else{
		        //display error is cannot be stored
		    echo '<span style="color:red;text-align:center;">ERROR: Could not execute sql</span>';
            }
	    }
    }
?>

<html lang="en">
    <head>
        <title>CMPS3640 Project</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta name="keyword" content="signup, project, cmps3640, notification, system">
        <meta name="description" content="The signup page for the cmps3640 project">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    </head>
  
    <body class="text-center" style="background-color:#152530;">
  
        <div class="container-sm" >
            <form method="post" class="form-signin p-4" style="background-color:white;">
		<h1 style="p-2">CMPS3640: Notification System</h1><hr>
		<h1 class="h3 p-2 font-weight-normal">Sign up</h1>
                <label for="fName" class="sr-only">
                    First Name
                </label>
                <input type="text" name="fName" class="form-control" style="margin-bottom:20" placeholder="First Name" required="">
                <label for="lName" class="sr-only">
                    Last Name
                </label>
                <input type="text" name="lName" class="form-control" style="margin-bottom:20" placeholder="Last Name" required="">
                <label for="inputEmail" class="sr-only">
                    Email address
                </label>
                <input type="email" name="email" class="form-control" style="margin-bottom:20" placeholder="Email address" required="" autofocus="">
                <label for="inputPassword" class="sr-only">
                    Password
                </label>
                <input name="passwrd" name="passwrd" type="password" onkeyup='check();' class="form-control" style="margin-bottom:20" placeholder="Password" required="">
                <label for="rePassword" class="sr-only">
                    Re Password
                </label>
                <input type="password" name="repasswrd" onkeyup='check();' class="form-control" style="margin-bottom:20" placeholder="Re-Password" required="">
                <div  style="margin-bottom:20">
                    <span id='message1'></span>
                </div>
                
                <button formaction="" class="btn btn-lg btn-primary btn-block" type="submit" onclick="return check();">
                    Sign Up
                </button>
                <div style="margin-top:10px;">
                    <text>
                        Already have an account?
                    </text>
                    <a href="login.php"  type="submit">
                        Login
                    </a>
                </div>
            </form>
            <div id="shimai-world" style="position: fixed; top: 0px; left: 0px; width: 100%; height: 100%; z-index: 2147483647; pointer-events: none; background: transparent;"></div>
        </div>
    </body>

  </html>

