<?php session_start(); include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM employees ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);

$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
//Add new Employee Form Submit
if(isset($_POST['add']))
  {  
     $name =  $_POST['name'];
    $phoneno =  $_POST['phoneno'];
    $cnic =  $_POST['cnic'];
    $jdate = $_POST['jdate'];
    $role = $_POST['role'];
    $insert = mysqli_query($conn,"INSERT INTO `employees`(`name`, `phoneno`,`cnic`,`jdate`,`role`)
	VALUES('$name','$phoneno','$cnic','$jdate','$role')");
     if($insert){
        echo "<script> alert('Employee is Added Successfully!');window.location.href='employees.php' </script>";
    }
}
 //UPDATE employee
 if(isset($_POST['up']))
 { $eid =  $_POST['eid'];
    $name =  $_POST['name'];
    $phoneno =  $_POST['phoneno'];
    $cnic =  $_POST['cnic'];
    $jdate= $_POST['jdate'];
    $role= $_POST['role'];
    $sql = "UPDATE `employees` SET `name`='$name',`phoneno`='$phoneno',`cnic`='$cnic',`jdate`='$jdate' ,`role`='$role'  WHERE id='$eid'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('employee Details is Updated Successfully!');window.location.href='employees.php' </script>";
        }
 }
 //Delete Partty
  if(isset($_POST['del']))
 {
    $id = $_POST['eid2'];
    $sql = "DELETE FROM employees WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Employee is Deleted Successfully!');window.location.href='employees.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">ملازمین</h1>

<button class='btn btn-success'  data-toggle="modal" data-target="#AddempModal">نیا ملازم شامل کریں</button>
<a class='btn btn-primary' href='employee_sale.php'>روزانہ فروخت شامل کریں</a> <br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ملازمین</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>نام</th>
                        <th>کردار</th>
                        <th>فون نمبر</th>
                        <th>CNIC</th>
                        <th>شامل ہونے کی تاریخ</th>
                        <th class="<?php echo $dadmin ?>">عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                        <td><?php echo $out['name']?></td>
                        <td><?php echo $out['role']?></td>
                        <td><?php echo $out['phoneno']?></td>
                        <td><?php echo $out['cnic']?></td>
                        <td><?php echo $out['jdate']?></td>
                      
                        <td class="<?php echo $dadmin ?>"><a class="btn btn-warning btn-circle" onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['name']?>','<?php echo $out['phoneno']?>'
                            ,'<?php echo $out['cnic']?>','<?php echo $out['jdate']?>','<?php echo $out['role']?>')" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                          </a>
                          <a href="" class="btn btn-danger btn-circle"  onclick="GetdelModal('<?php echo $out['id']?>')" data-toggle="modal" data-target="#delModal">
                                        <i class="fas fa-trash"></i>
                          </a></td>
                    </tr> 
<?php }?>
                 
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid end-->
         <!-- Delete Confirmation Modal-->
                     <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">کیا آپ واقعی حذف کرنا چاہتے ہیں؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center ">
                <i class="fas fa-exclamation-triangle btn-warning btn-lg  btn-circle"></i> <br>
                حذف پر کلک کرنے کے بعد آپ اس ملازم کو واپس نہیں لے سکتے ہیں۔
                    نیز معلومات سے متعلق ملازمین کو سسٹم سے نکال دیں گے
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <input type="hidden" name="eid2" id="eid2">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="del" class="btn btn-danger" value="Yes, Delete">
                    </form>
                </div>
            </div>
        </div>
    </div> 
 <!-- Add Employee Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نیا ملازم شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="text" name="name" class=" form-control form-control-user" placeholder="ملازم کا نام درج کریں" required> <br>
                        <input type="tel" name="phoneno" class=" form-control form-control-user"  pattern="[0]{1}[3]{1}[0-9]{9}"
                         placeholder=" گیارہ ہندسوں کا فون نمبر درج کریں" title="03XXXXXXXXX" required>  <br>
                         <input type="tel" name="cnic" class=" form-control form-control-user"  pattern="[0-9]{13}"
                         placeholder=" نمبر درج کریں CNIC تیرہ ہندسوں کا  " title="Please Enter 13 digit Valid CNIC Number" required> <br>
                         <label for="jdate">شمولیت کی تاریخ درج کریں:</label><label for="role" class='float-right mr-5'>ملازمین کا کردار منتخب کریں</label>
                        <input type="date" name="jdate" class=" form-control form-control-user w-50"  placeholder="Enter joinig date" max="<?php echo  date("Y-m-d")?>" required>
                        <select name="role" id="" class="float-right  form-control w-50" style="margin-top:-38px">
                          <option value="worker">Worker </option>
                            <option value="assistant">Assistant </option>
                            <option value="admin">Admin </option>
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
      <!-- Update Employee  Modal-->
 <div class="modal fade" id="editModal" tabindex="-1" address="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" address="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-purpose" id="exampleModalLabel">ملازمین کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="eid" id='eid'  >
                    <input type="text" id="name" name="name" class=" form-control form-control-user" placeholder="Enter employee Name" required> 
                    <label for="">Phone No :</label>
                        <input type="tel" id="phoneno" name="phoneno" class=" form-control form-control-user"  
                        pattern="[0]{1}[3]{1}[0-9]{9}"   placeholder="Enter 11 digit Phone No" title="03XXXXXXXXX"  >  
                        <label for="">CNIC No :</label>
                        <input type="text" id='cnic' name='cnic'  class=" form-control form-control-user">
                         <div class="row">
                         <div class="col-md-6">
                         <label for="">شمولیت کی تاریخ :</label>
                         <input type="date" name="jdate" id="jdate" class="form-control">
                            </div>
                            <div class="col-md-6">
                            <label for="">کردار منتخب کریں:</label>
                            <select name="role" id="role" class="  form-control form-control-user">
                          <option value="worker">Worker </option>
                          <option value="assistant">Assistant</option>
                            </select>  </div>
                </div> </div>
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
</div>
<script>
    function GetEModal(eid,name,phoneno,cnic,jdate,role) {
    document.getElementById("eid").value=eid ;
    document.getElementById("name").value =name;
    document.getElementById("phoneno").value =phoneno;
    document.getElementById("cnic").value =cnic;
    document.getElementById("jdate").value =jdate;
    document.getElementById("role").value =role;
}
function GetdelModal(eid) {
    document.getElementById("eid2").value=eid ;}
</script>