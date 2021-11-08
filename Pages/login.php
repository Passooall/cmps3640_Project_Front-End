<?php
    session_start();

    //connect to database
include("connect.php");
include("functions.php");
    if(mysqli_connect_errno())
    {
        //display error if connection cant be made
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }

    //if user posts something
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = $_POST['email'];
	$password = $_POST['password'];

        $salt = salt($password);
	$pass = hash('sha256', $password.$salt);

        //check to see if user is in database
        $query = mysqli_query($db, "SELECT Email, Pass FROM USER WHERE Email='".$email."' AND Pass='".$pass."'");
    
        if(mysqli_num_rows($query) > 0)
        {
            //login if found
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header('Location: home.php');
        }else{
            //display error if not found
            echo "Incorrect password or email";
        }
    }
?>

<html lang="en">
    <head>
        <title>APEA Project</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta name="keyword" content="project, cmps3640, distributed, computing, notification, system">
        <meta name="description" content="The login page for the cmps3640 project">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    </head>
    <body class="text-center" style="background-color:#152530;">
        <div class="container-sm" >
            <form method="post" class="form-signin m-4 p-4" style="background-color:white;">            
                <h1 class="p-2">CMPS3640: Notification System</h1><hr>
                <h1 class="h3 p-3 font-weight-normal">
                    Please Login
                </h1>
                <label for="inputEmail" class="sr-only">
                    Email address
                </label>
                <input type="email" name="email" class="form-control" style="margin-bottom:20" placeholder="Email address" required="" autofocus="">
                <label for="inputPassword" class="sr-only">
                    Password
                </label>
                <input type="password" name="password" class="form-control" style="margin-bottom:20" placeholder="Password" required="">
                <button formaction="" class="btn btn-lg btn-primary btn-block" type="submit">
                    Login
                </button>
                <a href="signup.php" class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:30">
                    Sign up
                </a>
            </form>
            <div id="shimai-world" style="position: fixed; top: 0px; left: 0px; width: 100%; height: 100%; z-index: 2147483647; pointer-events: none; background: transparent;"></div>
        </div>
    </body>
</html>
