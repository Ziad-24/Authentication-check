<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Current css -->
       <link rel="stylesheet" href="./css/index.css">
    <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main>
        <form action="" method="post">
            <section class="logged-in">
                <span>
                    <h3 class="h3">Welcome to this website <?php echo $_SESSION['FullName']; ?></h3> 
                    <button href="./Log_In.php" class="btn btn-outline-dark submit" name="signout">Sign out</button>
                    <button href="./update.php" class="btn btn-outline-dark submit" name="update">Update</button>
                    <!-- button to update data -->
                </span>
            </section>

            <section class="not-loggedin">
                <h3 class="h3" >Hello Guest</h3> <br>
                <a href="Sign_Up.php" class="btn btn-outline-dark submit" name="up">Sign up</a>
                <a href="Log_In.php" class="btn btn-outline-dark submit" name="in">Log in</a>
            </section>
        </form>
       
    </main>
    
    
    
    <?php 
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(-1);
        if(  $_SESSION['flag']    !=  NULL)
        {
            //first if bracket
    ?>
    <style>
        .not-loggedin{
            display: none;
        }
        .logged-in{
            display : block;
        }
    </style>
    <?php
    //closing the first one
        }
        else
        {
            //opening the second one
            ?>
    <style>
        .not-loggedin{
            display: block;
        }
        .logged-in{
            display : none;
        }
    </style>
    <?php
    //closing the second one
        }
     if(    isset($_POST['signout'])    )
     {
         session_destroy();
         header("Location: Log_In.php");
         exit();
     }
     else if(    isset($_POST['update'])    )
     {
         header("Location: update.php");
         exit();
     }

     if(    isset($_POST['up'])    )
     {
         header("Location: Sign_Up.php");
         exit();
     }
     else if(    isset($_POST['in'])    )
     {
         header("Location: Log_In.php");
         exit();
     }
     
    ?>
</body>
</html>