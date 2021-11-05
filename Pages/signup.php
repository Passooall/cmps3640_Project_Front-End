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

        //Check to see if email is already in use
        $query = mysqli_query($db, "SELECT Email FROM USER WHERE Email='".$email."'");
        if(mysqli_num_rows($query) != 0){
            //if in use display error
            echo '<span style="color:red;text-align:center;">E-mail is already registered</span>';
        } elseif(strlen($passwrd)<8 || strlen($passwrd)>20){
            //if password does not meet criteria display error
            echo '<span style="color:red;text-align:center;">Password must between 8 and 20 characters</span>';
        } else{
            //create random user id
           $user_id = random_num(20);
            //encrypt password
            $pass = hash('sha256', $passwrd.$salt);
            //store user info into database
            $query = "INSERT INTO USER (First, Last, Password, uID, Email) VALUES ($fName, $lName, $pass, $user_id, $email);";
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

<script type="text/javascript">
    var check = function() {
      if (document.getElementById('inputPassword').value ==
        document.getElementById('repassword').value) {
        document.getElementById('message1').innerHTML = '';
        return true;
      } else {
        document.getElementById('message1').style.color = 'red';
        document.getElementById('message1').innerHTML = 'Password and re-password are not matching';
        return false;
      }
    }
</script>

<html lang="en">
    <head>
        <title>CMPS3640 Project</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta name="keyword" content="signup, project, cmps3640, notification, system">
        <meta name="description" content="The signup page for the cmps3640 project">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    </head>
  
    <body class="text-center" style="background-color: white;">
  
        <div class="box" >
            <form method="post" class="form-signin">
                <h1 style="margin-bottom:30">CMPS3640: Notification System</h1>
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