<?php
    session_start();
    if(isset($_SESSION["UserID"]))
    {
        header('Location: index.php');
    }



    include('config.php');

    if(isset($_POST["btnLogin"]))
    {
        $getEmail = $_POST["email"];
        $getPassword = $_POST["pwd_1"];


        $_ErrorMessage  ="";
        if($getEmail =="")
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Please Enter Email Name</div>";
        }
        else if($getPassword =="")
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Please Enter Password</div>";
        }

        if($_ErrorMessage == "")
        {
            $SetPasswordEncrypt = md5($getPassword);
            $qrySearch = "select * from tbl_users where username = '".$getEmail."' AND password = '".$SetPasswordEncrypt."'";  // 0
            $result = mysqli_query($con, $qrySearch);
            $RecordCount = mysqli_num_rows($result); // 
            $UserRecords = mysqli_fetch_assoc($result);
            if($RecordCount > 0)
            {
                //$_ErrorMessage = "<div class='alert alert-success'>Success:</div>";  
                $_SESSION["UserID"] = $UserRecords["id"];
                $_SESSION["UserFullName"] = $UserRecords["first_name"] . " " . $UserRecords["last_name"];
                $_SESSION["UserImage"] = $UserRecords["profile_pic"];
                header('Location: index.php');
            }
            else
            {
                $_ErrorMessage = "<div class='alert alert-danger'>Invalid User Name/ Password!</div>"; 
            }
        }
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        include('navbar.php');
    ?>
    <div class="container">
        <h2>Login</h2>
        <hr />
        <?php
            if(isset($_ErrorMessage))
            {
                echo $_ErrorMessage;
            }
        ?>
        
        <form class="form-horizontal" action="login.php" method="post">
            
         

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" value="<?php if(isset($getEmail)) { echo $getEmail;} else { echo "";} ?>" name="email" id="email" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="pwd_1" id="pwd_1" placeholder="Enter password">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="btnLogin" class="btn btn-success">Login</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>