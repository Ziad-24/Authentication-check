<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Current css -->
        <link rel="stylesheet" href="./css/signup.css">
        <link rel="stylesheet" href="./css/update.css">
</head>
<body>
    <!-- create an update form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <div id="form" class="form">

            <div class="image">
                <img src="./images/th.jpg" alt="user pic" class="mx-auto d-block img-fluid">
            </div>

            <h3 class="h3">Update</h3>

            <label for="username">Username</label> <br>
                <input type="text" placeholder="Enter your username" name ="username" required  class="form-control" disabled value="<?php echo $_SESSION['username'];?>"> <br>
            <label for="fullname">Full Name</label> <br>
                <input type="text" placeholder="Enter your full name" name="fullname"  class="form-control" value="<?php echo $_SESSION['FullName'];?>"> <br>
            <label for="password">Password</label> <br>
                <input type="password" placeholder="Enter your password" name="password"  class="form-control"  maxlength ="16"> <br>

            <div class="last_line">
                <button name="homepage" class="submit btn btn-outline-dark">Home Page<span><a href="index.php" class="link"></a></span></button>
                <button type="submit" value="submit" name="update-button" class="btn btn-outline-dark submit update">Update</button>
            </div>
            <span id="success"><br>Your data has been updated successfully</span>
        </div>
    </form>


    <?php
    
        // initialize connection with the database
        $host = "localhost";    $user = "root";     $pass = "";     $db = "authentication";
        $success_update=false;
       if ($_SERVER["REQUEST_METHOD"] == "POST")
       {
           $conn = mysqli_connect($host , $user , $pass , $db);

           if($conn === false)
           {
                die("ERROR: Could not connect. " . mysqli_connect_error());
           }

            $username = $_SESSION['username'];
           

           $select = "SELECT * FROM user_info";
           $select_query = mysqli_query($conn, $select);

           
           while(   $record = mysqli_fetch_array($select_query) )
           {    
               if($record['Username']   ==  $username)
               {
                   $ID = $record['UserID'];
                  
                   if( isset($_POST['update-button'])  )
                   {
                       $fullname = mysqli_real_escape_string($conn, $_REQUEST['fullname']);
                       $password = mysqli_real_escape_string($conn, $_REQUEST['password']);
                       if( strlen($fullname) > 0  &&     strlen($password) > 0 )
                       { 
                           $update1 ="UPDATE user_info SET FullName='$fullname' , Userpass='$password' WHERE UserID=$ID";
                           $_SESSION['FullName'] = $fullname;
                        //    $update2 = "UPDATE user_info SET WHERE UserID=$ID";
                          
                           $update_query = mysqli_query($conn,$update1);
                        //    $update_query2 = mysqli_query($conn,$update2);
                           $success_update=true;
                       }
                   }
               }
           }

            if(  isset($_POST['homepage'])   )
            {
            header("Location: index.php");
            exit();
            }
           

           mysqli_close($conn);
      }


    ?>

    <?php
    if($success_update==true)
    { //first bracket 
    ?>
    <style>
        #success{
            display: block;
        }
        #form{
            height:700px;
        }
    </style>
    <?php
    }//bracket close
    ?>
</body>
</html>