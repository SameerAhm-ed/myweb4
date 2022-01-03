<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

      
      <?php
        if(isset($_SESSION["UserFullName"]))
        {
          ?>
            <li><a href="profile.php"><span><img style="width:20px;" src="<?php echo $_SESSION["UserImage"];?>" /></span> <?php echo $_SESSION["UserFullName"]; ?></a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
         <?php 
        }
        else
        {
          ?>
            <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
         <?php 
        }
      ?>


     
   
   
    </ul>
  </div>
</nav>