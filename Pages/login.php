<?php
    session_start();

    //connect to database
    include("connect.php");
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
        $passwrd = $_POST['password'];

        $salt = salt($passwrd);
        $pass = hash('sha256', $passwrd.$salt);

        //check to see if user is in database
        $query = mysqli_query($db, "SELECT Email, Password FROM USER WHERE Email='".$email."' AND Password='".$pass."'");
    
        if(mysqli_num_rows($query) > 0)
        {
            //login if found
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header('Location: home.php');
        }else{
            //display error if not found
            echo "incorrect email or password";
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
    <body class="text-center" style="background-color: white;">
        <div class="box" >
            <form method="post" class="form-signin">            
                <h1 style="margin-bottom:40px; font-family:sans-serif;">CMPS3640: Notification System</h1>
                <h1 class="h3 mb-3 font-weight-normal">
                    Please Login
                </h1>
                <label for="inputEmail" class="sr-only">
                    Email address
                </label>
                <input type="email" name="email" class="form-control" style="margin-bottom:20" placeholder="Email address" required="" autofocus="">
                <label for="inputPassword" class="sr-only">
                    Password
                </label>
                <input type="password" name="passwrd" class="form-control" style="margin-bottom:20" placeholder="Password" required="">
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