<?php  session_start(); include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM owner_withdraw");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);
$data2 = mysqli_query($conn, "SELECT * FROM owners ");
$output2 = mysqli_fetch_all($data2,MYSQLI_ASSOC);
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
    echo "<script> alert('Sorry! Only Admin can Acceess this Page ');window.location.href='index.php' </script>";
}
//Add new borrow Form Submit
if(isset($_POST['add']))
  {  
    $oid =  $_POST['oid'];
     $purpose =  $_POST['purpose'];
    $description =  $_POST['description'];
    $b_amount = $_POST['b_amount'];
    $date= $_POST['date'];
    $sql = "UPDATE `owners` SET `b_amount`=`b_amount`+'$b_amount' WHERE id='$oid'";
    $up=mysqli_query($conn, $sql);
    $insert = mysqli_query($conn,"INSERT INTO `owner_withdraw`(`purpose`, `description`,`amount`,`date`,`oid`)
	VALUES('$purpose','$description','$b_amount','$date','$oid')");
     if($insert){
        echo "<script> alert('borrow is Added Successfully!');window.location.href='owner_borrow.php' </script>";
    }
}
 //Delete borrow
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM owner_withdraw WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('borrow is Deleted Successfully!');window.location.href='owner_borrow.php' </script>";
        }
 }
 //UPDATE borrow
 if(isset($_POST['up']))
 {   $oid =  $_POST['oid'];
     $eid =  $_POST['eid'];
    $purpose =  $_POST['purpose'];
    $description =  $_POST['description'];
    $b_amount = $_POST['b_amount'];
    $p_amount = $_POST['pre_amount'];
    $tb_amount=$b_amount-$p_amount;
    $date= $_POST['date'];
    $sql = "UPDATE `owners` SET `b_amount`=`b_amount`+'$tb_amount' WHERE id='$oid'";
    $up=mysqli_query($conn, $sql);
    $sql = "UPDATE `owner_withdraw` SET `purpose`='$purpose',`description`='$description',`amount`='$b_amount' ,`date`='$date',`oid`='$oid'  WHERE id='$eid'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Owner borrow Details is Updated Successfully!');window.location.href='owner_borrow.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">مالک اخراجات</h1>
<button class='btn btn-success mr-2'  data-toggle="modal" data-target="#AddempModal">نیا خرچ شامل کریں</button> <br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">مالک اخراجات</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                    <th> مالک</th>
                        <th> مقصد</th>
                        <th>تفصیل</th>
                        <th>رقم</th>
                        <th>تاریخ</th>
                        <th>عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                    <td><?php $oid=$out['oid'];$sql = mysqli_query($conn, "SELECT * FROM owners where  id='$oid' ");
                            $result = mysqli_fetch_assoc($sql); echo $result['name'] ?></td>
                        <td><?php echo $out['purpose']?></td>
                        <td><?php echo $out['description']?></td>
                        <td><?php echo $out['amount']?></td>
                        <td><?php echo $out['date']?></td>
                      
                        <td>    <a href="#" class="btn btn-warning btn-circle" onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['purpose']?>','<?php echo $out['description']?>'
                            ,'<?php echo $out['amount']?>','<?php echo $out['date']?>','<?php echo $out['oid']?>')" data-toggle="modal" data-target="#editModal">
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
                    <h5 class="modal-purpose" id="exampleModalLabel">کیا آپ واقعی حذف کرنا چاہتے ہیں؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center ">
                <i class="fas fa-exclamation-triangle btn-warning btn-lg  btn-circle"></i> <br>
                حذف پر کلک کرنے کے بعد آپ اس واپسی کو واپس نہیں لے سکتے ہیں۔
                    نیز نظام سے دستبرداری سے متعلق معلومات کو بھی ہٹا دیا جائے گا
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
 <!-- Add borrow Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-purpose" id="exampleModalLabel">نیا خرچ شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <label for="">کسٹمر منتخب کریں</label>
                       <select name="oid"  class='form-control' required>
                       <?php foreach($output2 as $out2){?>
                        <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?></option>
                        <?php }?>
                         </select> <br>
                        <input type="text" name="purpose" class=" form-control form-control-user" placeholder="اخراجات کا مقصد درج کریں" required> <br>
                        <input type="txet" name="description" class=" form-control form-control-user"  
                         placeholder="تفصیل درج کریں" >  <br>
                         <div class="row">
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="b_amount" class=" form-control form-control-user " placeholder="اخراجات کی رقم" required> <br>
                            </div>
                            <div class="col-md-6">
                            <input type="date" name="date" class=" form-control form-control-user " max="<?php echo  date("Y-m-d")?>" placeholder=" date" required>
                            </div>
                         </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="add" class="btn btn-success" value="Add New">
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-- Update expense Borrow Modal-->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-purpose" id="exampleModalLabel">رقم واپس کرنے کی تازہ کاری کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="eid" id="eid">
                    <input type="hidden" name="pre_amount" id="pre_amount">
                    <select name="oid" id='oid'  class='form-control' required>
                       <?php foreach($output2 as $out2){?>
                        <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?></option>
                        <?php }?>
                         </select> <br>
                    <input type="text" name="purpose" id="purpose" class=" form-control form-control-user" placeholder="اخراجات کا مقصد درج کریں" required> <br>
                        <input type="tel" name="description"  id="description" class=" form-control form-control-user"  
                         placeholder="Enter description" >  <br>
                         <div class="row">
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="b_amount" id="b_amount"  class=" form-control form-control-user " placeholder=" borrow amount" required> <br>
                            </div>
                            <div class="col-md-6">
                            <input type="date" name="date" id="date" class=" form-control form-control-user " max="<?php echo  date("Y-m-d")?>" placeholder=" date" required>
                            </div>
                         </div>
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
function GetEModal(eid,purpose,description,b_amount,date,oid) {
    document.getElementById("eid").value=eid ;
    document.getElementById("purpose").value =purpose;
    document.getElementById("description").value =description;
    document.getElementById("b_amount").value =b_amount;
    document.getElementById("pre_amount").value =b_amount;
    document.getElementById("date").value =date;
    document.getElementById("oid").value =oid;
}

</script>

</div>