<style>
  .dropdown-submenu {
    position: relative;
  }

  .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
  }

  .dropdown-submenu:hover>.dropdown-menu {
    display: block;
  }

  .dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
  }

  .dropdown-submenu:hover>a:after {
    border-left-color: #fff;
  }

  .dropdown-submenu.pull-left {
    float: none;
  }

  .dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
  }
</style>

<?php 
$count = count($_SESSION["cart"]); 
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php
          $qrySearchCate = "select * from tbl_categories where status = 'Active'";  // 0
          $resultCategory = mysqli_query($con, $qrySearchCate);
          while ($RecordsCat =  mysqli_fetch_assoc($resultCategory)) {
          ?>
            <li class="dropdown-submenu">
              <a class="test" tabindex="-1" href="#"><?php echo $RecordsCat["cat_name"]; ?> </a>

              <?php
              $qrySearchSubCate = "select * from tbl_sub_cat where status = 'Active' AND cat_id = '" . $RecordsCat["id"] . "'";  // 0
              $resultSUBCategory = mysqli_query($con, $qrySearchSubCate);

              $RecordCounts = mysqli_num_rows($resultSUBCategory); //
              if ($RecordCounts > 0) {
                echo "<ul class='dropdown-menu'>";
                while ($RecordsSubCat =  mysqli_fetch_assoc($resultSUBCategory)) {
              ?>
            <li><a tabindex="-1" href="product.php?id=<?php echo $RecordsSubCat["id"]; ?>"><?php echo $RecordsSubCat["sub_cat_name"]; ?></a></li>
        <?php
                }
                echo "</ul>";
              }

        ?>



      </li>
    <?php
          }
    ?>


    </ul>

    </li>
    <li><a href="#">Page 2</a>

    </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="cartview.php"><span style="color: #fff; font-size: 12px; border: 2px solid red; padding: 5px; background-color: red; border-radius: 50%;"><?= $count; ?></span><span class="glyphicon glyphicon-shopping-cart"></span>Cart View</a></li>

      <?php
      if (isset($_SESSION["UserFullName"])) {
      ?>
        <li><a href="profile.php"><span><img style="width:20px;" src="<?php echo $_SESSION["UserImage"]; ?>" /></span> <?php echo $_SESSION["UserFullName"]; ?></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
      <?php
      } else {
      ?>
        <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <?php
      }
      ?>





    </ul>
  </div>
</nav>




<script>
  $(document).ready(function() {
    $('.dropdown-submenu a.test').on("click", function(e) {
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
</script>