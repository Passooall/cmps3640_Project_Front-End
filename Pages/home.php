<?php
    session_start();

    //check if logged in
    /*if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    }else{
        //if not logged in go to login page
        header('Location: login.php');
    }*/
    
    //connect to database
    include("connect.php");
?>

<html lang='en'>
    <head>
        <title>CMPS3640 Project</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta name="keyword" content="signup, project, cmps3640, notification, system">
        <meta name="description" content="The signup page for the cmps3640 project">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    </head>
    <body>
        <h1>Hello</h1>
        <a class="nav-link" href="logout.php">Log Out</a>
    </body>
</html>