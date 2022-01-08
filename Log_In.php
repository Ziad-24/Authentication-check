<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Current css -->
        <link rel="stylesheet" href="./css/signup.css">
    <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <!-- create a log in form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div id="form">
            <label for="username">Username</label> <br>
                <input type="text" placeholder="Enter your username" name ="username" required > <br>
            <label for="password">Password</label> <br>
                <input type="password" placeholder="Enter your password" name="password" required> <br>

                <div class="last_line">
                        <span class="Login">Don't have an account?  <span><a href="Sign_Up.php" class="link">Sign Up</a></span></span>
                        <button type="submit" value="submit" name="login-button">Sign Up</button>
                    </div>
                
            </div>
        </form>
        <?php
        // initialize connection with the database
           $host = "localhost";    $user = "root";     $pass = "";     $db = "authentication";
            $entereduser = $enteredpass = false;
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
                    $_SESSION['FullName'] = $record['FullName'];
                    header("Location: index.php");
                    exit();
                }
                else
                {
                    echo "The username or the password you entered are not correct";
                }

                mysqli_close($conn);
               }
           }

        ?>
</body>
</html>