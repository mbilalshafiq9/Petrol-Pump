<?php session_start();
include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM users ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);
$error='d-none';
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
    echo "<script> alert('Sorry! Only Admin can Acceess this Page ');window.location.href='index.php' </script>";
}
//Add new User Form Submit
if(isset($_POST['add']))
  {  
     $name =  $_POST['name'];
    $phoneno =  $_POST['phoneno'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $v_email = "SELECT 1 FROM users WHERE phoneno = '$phoneno'";
	$result = mysqli_query($conn,$v_email);
	if(mysqli_num_rows($result)>0)
	{
	echo "<script> alert('Sorry! Phone No Already Exists. Try Another');window.location.href='accounts.php' </script>";
    }
    else{
    $insert = mysqli_query($conn,"INSERT INTO `users`(`name`, `phoneno`,`password`,`role`)
	VALUES('$name','$phoneno','$password','$role')");
     if($insert){
        echo "<script> alert('User Account is Added Successfully!');window.location.href='accounts.php' </script>";
    }}
}
 //Delete User
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('User is Deleted Successfully!');window.location.href='accounts.php' </script>";
        }
 }
//UPDATE User
if(isset($_POST['up']))
{  $uid =  $_POST['uid'];
    $name =  $_POST['name'];
    $phoneno =  $_POST['phoneno'];
    $password = $_POST['password'];
    $role = $_POST['role'];
   $sql = "UPDATE `users` SET `name`='$name',`phoneno`='$phoneno',`password`='$password' ,`role`='$role' WHERE id='$uid'";
   $del=mysqli_query($conn, $sql);
       if($del){
           echo "<script> alert('User Details is Updated Successfully!');window.location.href='accounts.php' </script>";
       }
}
?>   

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
<?php include "sidebar.php";?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        <?php include "topbar.php";?>

   <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">صارف اکاؤنٹس</h1>
<button class='btn btn-success mr-2'  data-toggle="modal" data-target="#AddempModal">نیا اکاؤنٹ شامل کریں</button><br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">صارف اکاؤنٹس</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>نام</th>
                        <th>فون نمبر</th>
                        <th>پاس ورڈ</th>
                        <th>کردار</th>
                        <th>عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                        <td><?php echo $out['name']?></td>
                        <td><?php echo $out['phoneno']?></td>
                        <td><?php echo $out['password']?></td>
                        <td><?php echo $out['role'];?></td>
                        <td>    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['name']?>','<?php echo $out['phoneno']?>'
                            ,'<?php echo $out['password']?>' ,'<?php echo $out['role']?>')" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                          </a>
                          <a href="" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delModal">
                                        <i class="fas fa-trash"></i>
                          </a></td>
                    </tr> 
                     <!-- Delete Confirmation Modal-->
 <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">کیا آپ واقعی حذف کرنا چاہتے ہیں؟!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center ">
                <i class="fas fa-exclamation-triangle btn-warning btn-lg  btn-circle"></i> <br>
                حذف پر کلک کرنے کے بعد آپ اس صارف کو واپس نہیں لے سکتے ہیں۔
                    نیز معلومات سے متعلق صارف نظام کو استعمال کرے گا
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $out['id']?>">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="del" class="btn btn-danger" value="Yes, Delete">
                    </form>
                </div>
            </div>
        </div>
    </div> <?php }?>
                 
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid end-->
 <!-- Add User Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نیا اکاؤنٹ بنانے</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <p id="error" class=" text-danger p-3 error w-100 " style="background-color:rgba(255,0,0,0.1);font-size:18px !important"></p>
                    <form action="" method="POST">
                        <input type="text" name="name" class=" form-control form-control-user" placeholder="صارف کا نام درج کریں" required> <br>
                        <input type="tel" name="phoneno" class=" form-control form-control-user"  pattern="[0]{1}[3]{1}[0-9]{9}"
                         placeholder=" ہندسوں کا فون نمبر درج کریں11"title="03XXXXXXXXX" required onchange="GetPhoneno(this.value)">  <br>
                         <input type="text" name="password" class=" form-control form-control-user" pattern=".{8,}"   title="Passwod must contain 8 characters"
                         placeholder=" User Password" required> <br>
                       
                          <label for="User" >کردار:</label>
                        <select name="role" id="" class=" form-control " >
                          <option value="admin">Admin </option>
                          <option value="assistant">Assistant </option>
                        </select>
                        
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="add" class="btn btn-success" value="Add New">
                    </form>
                </div>
            </div>
        </div>
    </div>
          <!-- Update User  Modal-->
 <div class="modal fade" id="editModal" tabindex="-1" address="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" address="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-purpose" id="exampleModalLabel">صارف کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="uid" id='uid'  >
                    <input type="text" name="name"  id='name' class=" form-control form-control-user" placeholder="Enter User Name" required> <br>
                        <input type="tel" name="phoneno" id='phoneno' class=" form-control form-control-user"  pattern="[0]{1}[3]{1}[0-9]{9}"
                         placeholder="Enter 11 digit Phone No" title="03XXXXXXXXX" required onchange="GetPhoneno(this.value)">  <br>
                         <input type="text" name="password" id='password' class=" form-control form-control-user" pattern=".{8,}"   title="Passwod must contain 8 characters"
                         placeholder=" User Password" required> <br>
                       
                          <label for="User" >صارف کا کردار منتخب کریں:</label>
                        <select name="role" id="role" class=" form-control " >
                          <option value="assistant">Assistant </option>
                          <option value="admin">Admin </option>
                        </select>
                </div> 
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="up" class="btn btn-warning" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php include "footer.php"?>

</div>
<script>

    function GetEModal(id,name,phoneno,password,role) {
    
    document.getElementById("uid").value=id ;
    document.getElementById("name").value =name;
    document.getElementById("phoneno").value =phoneno;
    document.getElementById("password").value =password;
    document.getElementById("role").value =role;

}

function GetPhoneno(phoneno) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("error").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "ajax_data.php?phoneno="+phoneno, true);
  xhttp.send();
}

</script>

</div>