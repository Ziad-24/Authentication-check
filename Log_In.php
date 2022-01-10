<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
        #form{
            height: 640px;
        }
    </style>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Current css -->
        <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
    <!-- create a log in form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <div id="form" class="form">

                <div class="image">
                    <img src="./images/th.jpg" alt="user pic" class="mx-auto d-block img-fluid">
                </div>

                <h3 class="h3">Log In</h3>

                <label for="username">Username</label> <br>
                    <input type="text" placeholder="Enter your username" name ="username" required  class="form-control"> <br>
                <label for="password">Password</label> <br>
                    <input type="password" placeholder="Enter your password" name="password" required class="form-control" maxlength ="16"> <br>

                <div class="last_line">
                    <span class="Login">Don't have an account?  <span><a href="Sign_Up.php" class="link">Sign Up</a></span></span>
                    <button type="submit" value="submit" name="login-button" class="btn btn-outline-dark submit">Log In</button>
                </div>
                
                <span id="exists"><br>The username or the password you entered are not correct </span>
            </div>
        </form>
        
        <?php
        // initialize connection with the database
           $host = "localhost";    $user = "root";     $pass = "";     $db = "authentication";
            $entereduser = $enteredpass = false;
            $found = false;
           if ($_SERVER["REQUEST_METHOD"] == "POST")
           {
               $conn = mysqli_connect($host , $user , $pass , $db);

               if($conn === false)
               {
                    die("ERROR: Could not connect. " . mysqli_connect_error());
               }

               if(     isset($_POST['login-button'])   )
               {
                   
                //put form text into variables
                $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
                $password = mysqli_real_escape_string($conn, $_REQUEST['password']);
                
                $r = mysqli_query($conn , "SELECT * FROM user_info WHERE Username='$username' AND Userpass='$password' ");
                

                while(  $record = mysqli_fetch_array($r)    )
                { 
                    //if user is correct check if the pass is correct as well
                    if($record['Username'] == $username)
                    {
                        $entereduser = true;
                        if($record['Userpass']==$password)
                        {
                            $enteredpass = true;
                            break;
                        }
                    }
                }
                //if true send to another page
                if( $entereduser ==  true    &&    $enteredpass ==  true)
                {
                    $_SESSION['username'] = $record['Username'];
                    $_SESSION['flag'] = true;
                    $_SESSION['FullName'] = $record['FullName'];
                    $found = false;
                    header("Location: index.php");
                    exit();
                }
                else
                {
                   // echo "The username or the password you entered are not correct";
                   $_SESSION['flag'] = false;
                   $found = true;
                }

                mysqli_close($conn);
               }
           }

        ?>

<?php
    if($found) {
    ?>
            <style type="text/css">
                #exists{
                        display: block;
                }
               
        <?php
       }
?>
</body>
</html>