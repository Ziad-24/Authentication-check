<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Current css -->
        <link rel="stylesheet" href="./css/signup.css">
    <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
</head>
<body>
    
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <div id="form">
                <div class="image">
                    <img src="./images/th.jpg" alt="user pic" class="mx-auto d-block img-fluid">
                </div>
                <div class="inputs">
                    <label for="username">Username</label> <br>
                        <input type="text" placeholder="Enter your username" name ="username" required class="form-control"> <br>
                    <label for="fullname">Full Name</label> <br>
                        <input type="text" placeholder="Enter your full name" name="fullname" required class="form-control"> <br>
                    <label for="password">Password</label> <br>
                        <input type="password" placeholder="Enter your password" name="password" required class="form-control"> <br>

                    <div class="last_line">
                        <span class="Login">Already have an account?  <span><a href="Log_In.php" class="link">Log In</a></span></span>
                        <button type="submit" value="submit" name="signup-button" class="btn btn-outline-dark submit">Sign Up</button> <br>
                    </div>
                   
                    
                    <span id="exists"> <br> This username already exists , please enter another username</span>
                </div>
               
            </div>
        </form>
    
    <?php
    
        $host = "localhost";    $user = "root";     $pass = "";     $db = "authentication";
        $found = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $conn = mysqli_connect($host , $user , $pass , $db);

            $r = mysqli_query($conn , "select * from user_info");
            $insert = "";
        
            // Check connection
            if($conn === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            //when a button is pressed fetch all the data
            if(     isset($_POST['signup-button'])   )
            {

                $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
                $fullname = mysqli_real_escape_string($conn, $_REQUEST['fullname']);
                $password = mysqli_real_escape_string($conn, $_REQUEST['password']);

               
                $insert = "INSERT INTO user_info (Username, FullName, Userpass) VALUES ('$username', '$fullname', '$password')";
                                             
                //loop through each record of the database
                while( $record =  mysqli_fetch_array($r) )
                {
                    //then check if the entered username already exists
                    if($record['Username'] == $username)
                    {
                        $found = true;
                        break;
                    }
                }
                if ($found == false)
                {
                    $insert_query = mysqli_query($conn, $insert);
                    header("Location: Log_In.php");
                    exit();
                    echo "Data inserted successfully";    
                }
                
            }

            mysqli_close($conn);
        }
        
    ?>
    <!-- if username exists show the span -->
       <?php
       if($found) {
        ?>
            <style type="text/css">
                #exists{
                        display: block;
                }
                #form{
                    height: 670px;
                }
        <?php
       }
        ?>
</body>
</html>