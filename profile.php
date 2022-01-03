<?php
    include('config.php');
    date_default_timezone_set("Asia/Karachi");
    $dt =date("dmyhis");
    
    session_start();
    if(!isset($_SESSION["UserID"]))
    {
        header('Location: index.php');
    }

    // For Get User Detail
    $qrySelect = "select * from tbl_users where id = '".$_SESSION["UserID"]."'";
    $resultSelect = mysqli_query($con, $qrySelect);
    $RecordCountselect = mysqli_num_rows($resultSelect);
    $UserPfile = mysqli_fetch_assoc($resultSelect);
    if ($RecordCountselect > 0) {
        $varFN = $UserPfile["first_name"];
        $varLastN = $UserPfile["last_name"];
        $varUserN = $UserPfile["username"];
    }
    else {
        header("Location: index.php");
    }
    //================================


    if(isset($_POST["btnReg"]))
    {
        $getFirstName = $_POST["firstname"];
        $getLastName = $_POST["lastname"];
        $getEmail = $_POST["email"];
        
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
        <h2>Update Profile</h2>
        <hr />
        <?php
            if(isset($_ErrorMessage))
            {
                echo $_ErrorMessage;
            }
        ?>
        
        <form class="form-horizontal" action="profile.php" method="post" enctype="multipart/form-data">
            
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
                <input type="text" class="form-control" value="<?php if(isset($varFN)) { echo $varFN;} else { echo "";} ?>" name="firstname" id="firstname" placeholder="Enter First Name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" >Last Name:</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php if(isset($varLastN)) { echo $varLastN;} else { echo "";} ?>"  name="lastname" id="lastname" placeholder="Enter Last Name">
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                <input type="email" readonly class="form-control" value="<?php if(isset($varUserN)) { echo $varUserN;} else { echo "";} ?>" name="email" id="email" placeholder="Enter email">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="btnReg" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>