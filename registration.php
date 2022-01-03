<?php
    date_default_timezone_set("Asia/Karachi");
    $dt =date("dmyhis");
    
    session_start();
    if(isset($_SESSION["UserID"]))
    {
        header('Location: index.php');
    }



    include('config.php');

    if(isset($_POST["btnReg"]))
    {
        $getFirstName = $_POST["firstname"];
        $getLastName = $_POST["lastname"];
        $getEmail = $_POST["email"];
        $getPassword = $_POST["pwd_1"];
        $getConfirmPassword = $_POST["pwd_2"];

        
        //=========For File Uploading....
        $varFileName = $_FILES["txtFile"]["name"];  //array
        $varFileType = $_FILES["txtFile"]["type"];  //array
        $varFileError = $_FILES["txtFile"]["error"];  //array
        $varFileTempName = $_FILES["txtFile"]["tmp_name"];  //array
        $varFileSize = $_FILES["txtFile"]["size"];  //array

        $varFilePath = "profile/noprofile.png";
        if($varFileError == 0)
        {
            $varFilePath = "profile/".$getFirstName."_".$dt."_".$varFileName;
        }

        
       
        //===============================


        
        $_ErrorMessage  ="";
        
        if($getFirstName == "")
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Please Enter First Name</div>";
        }
        else if($getLastName =="")
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Please Enter Last Name</div>";
        }
        else if($getEmail =="")
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Please Enter Email Name</div>";
        }
        else if($getPassword =="")
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Please Enter Password</div>";
        }
        else if($getConfirmPassword =="")
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Please Enter Confirm Password</div>";
        }

        else if($getPassword != $getConfirmPassword)
        {
            $_ErrorMessage = "<div class='alert alert-danger'>Error: Password Does Not Match!</div>";
        }


        if($_ErrorMessage == "")
        {
            //Check for UserName
                $qrySearch = "select * from tbl_users where username = '".$getEmail."'";  // 0
                $result = mysqli_query($con, $qrySearch);
                $RecordCount = mysqli_num_rows($result);
                if($RecordCount > 0)
                {
                    $_ErrorMessage = "<div class='alert alert-danger'>Error: UserName already Exist!</div>";  
                }
                else
                {
                    

                    $SetPasswordEncrypt = md5($getPassword);
                    $Query  = "insert into tbl_users (first_name,last_name,username,password,profile_pic) values('". $getFirstName."','".$getLastName."','". $getEmail ."','".$SetPasswordEncrypt."','".$varFilePath."')";
                    $rslt = mysqli_query($con,$Query);
        
                    if($rslt)
                    {
                       if($varFileError == 0)
                       {
                           $varNM = $getFirstName."_".$dt."_".$varFileName;
                           move_uploaded_file($varFileTempName,"profile/".$varNM);
                       }     

                        $_ErrorMessage = "<div class='alert alert-success'>Account Created</div>";
                    }
                    else{
                        $_ErrorMessage = "<div class='alert alert-danger'>Please try again !</div>";
                    }
                }
            //=================

           
        }
       
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>My First Web Site</title>
</head>

<body>
<?php
    include('navbar.php');
?>

    <div class="container">
        <h2>Create New Account</h2>
        <hr />
        <?php
            if(isset($_ErrorMessage))
            {
                echo $_ErrorMessage;
            }
        ?>
        
        <form class="form-horizontal" action="registration.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                
                <div class="col-sm-10">
                    <img id="uploadPreview"  src="" style="width:100px; height:100px; border:1px solid black;" />
                </div>
            </div>   

            <div class="form-group">
                <label class="control-label col-sm-2" >Profile Pciture:</label>
                <div class="col-sm-10">
                <input type="file" class="form-control"  name="txtFile" id="txtFile" onchange="PreviewImage();">
                </div>
            </div>
            <script>
                function PreviewImage() {
                var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("txtFile").files[0]);

                    oFReader.onload = function (oFREvent) {
                        document.getElementById("uploadPreview").src = oFREvent.target.result;
                    };
                };
            </script>
        
            <div class="form-group">
                <label class="control-label col-sm-2" >First Name:</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php if(isset($getFirstName)) { echo $getFirstName;} else { echo "";} ?>" name="firstname" id="firstname" placeholder="Enter First Name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" >Last Name:</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php if(isset($getLastName)) { echo $getLastName;} else { echo "";} ?>"  name="lastname" id="lastname" placeholder="Enter Last Name">
                </div>
            </div>


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
                <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="pwd_2" id="pwd_2" placeholder="Enter Confirm password">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="btnReg" class="btn btn-success">Create Account</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>