<?php
 include "db.php";
 $phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
    echo "<script> alert('Sorry! You need to login First');window.location.href='login.php' </script>";
}
if(isset($_POST['submit']))
  { $id =  $_POST['uid'];
      $name =  $_POST['uname'];
    $phoneno =  $_POST['uphoneno'];
    $password = $_POST['upassword'];
    $role = $_POST['role'];
    $insert = mysqli_query($conn,"UPDATE `users` SET `name`='$name',`phoneno`='$phoneno',`password`='$password',`role`='$role' WHERE id='$id'");
     if($insert){
        echo "<script> alert('User Information is Updated Successfully!');window.location.href='index.php' </script>";
    }
}

?>
 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

 

    

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  $print['name']?></span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#EditModal">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            
           
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
 <!--Update user info Modal-->
 <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Your Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="uid" value="<?php echo  $print['id']?>">
                    <label for="">Full Name</label>
                       <input type="text" class=" form-control " name="uname"  value="<?php echo $print['name']?>">
                       <label for="">Phone NO:</label>
                       <input type="tel" class=" form-control "  pattern="[0]{1}[3]{1}[0-9]{9}" title="03XXXXXXXXX" required
                        name="uphoneno"  value="<?php echo $print['phoneno']?>">
                       <label for="">Password:</label>
                       <input type="text" class=" form-control " name="upassword" pattern=".{8,}"
                       title="پاس واڈ میں 8 حرف ہوں" value="<?php echo $print['password']?>">
                       <label for="">Select User Role:</label>
                       <select name="urole"  class="  form-control ">
                          <option value="admin" <?php  $role=$print['role']; if($role==='admin'){ echo "selected";}?>>Admin </option>
                            <option value="assistant"<?php  $role=$print['role']; if($role==='assistant'){ echo "selected";}?>>Assistant </option>
                        </select> 
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit" class="btn btn-warning" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Topbar -->