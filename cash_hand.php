<?php  session_start(); include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM cash_hand ORDER BY ID DESC LIMIT 1");
$output = mysqli_fetch_assoc($data);
$data2 = mysqli_query($conn, "SELECT * FROM cash_payment ");
$output2 = mysqli_fetch_all($data2,MYSQLI_ASSOC);
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
//Add new stock Form Submit
if(isset($_POST['add']))
  {  
     $amount =  $_POST['amount'];
    $date =  $_POST['date'];
    $insert = mysqli_query($conn,"INSERT INTO `cash_payment`(`amount`, `date`)
    VALUES('$amount','$date')");
    $sql = "UPDATE `cash_hand` SET `cash`=`cash`-'$amount'";
    $update=mysqli_query($conn, $sql);
     if($insert){
        echo "<script> alert('Payment is Added Successfully!');window.location.href='cash_hand.php' </script>";
    }
}
 //Update Cash in Hand
 if(isset($_POST['up2']))
 {
    $id = $_POST['id'];
     $cash = $_POST['cash_hand'];
    $sql2 = "UPDATE `cash_hand` SET `cash`='$cash' where id='$id'";
    $up2=mysqli_query($conn, $sql2);
        if($up2){
            echo "<script> alert('Cash in Hand is Updated Successfully!');window.location.href='cash_hand.php' </script>";
        }
 }
 //Delete Cash Payment
 if(isset($_POST['del2']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM cash_payment WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Cash Payment is Deleted Successfully!');window.location.href='cash_hand.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">نقد رقم</h1>
<button class='btn btn-success'  data-toggle="modal" data-target="#AddempModal">نقد رقم ادا کریں</button> <br><br>
<div class='row'>
<!-- DataTales Example -->
<div class="col-md-7 ">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">نقد رقم ادائیگی</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>نقد رقم ادائیگی</th>
                        <th>Date</th>
                        <th class="<?php echo $dadmin?>">Action</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php $i=1; foreach($output2 as $out2) {?>
                    <tr>
                        <td><?php echo $out2['amount']?></td>
                        <td ><?php echo $out2['date']?> </td>
                        <td class="<?php echo $dadmin?>">   
                          <a href="" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delModal">
                                        <i class="fas fa-trash"></i>
                          </a></td>
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
                حذف پر کلک کرنے کے بعد آپ اس اسٹاک کو واپس نہیں لے سکتے ہیں۔
                    نیز نظام سے متعلق معلومات کا ذخیرہ بھی ختم ہوجائے گا
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $out2['id']?>">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="del2" class="btn btn-danger" value="Yes, Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>        </tr>  <?php }?>
                 
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
  <!-- Donut Chart -->
  <div class="col-md-5 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">نقد رقم</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>نقد رقم</th>
                        <th>Action</th>
                    </tr>
                </thead>
              
                <tbody>
                    <tr> <input type="hidden" value="<?php echo $output['cash']?>" id="cash">
                        <td>Rs.<?php echo $output['cash']?></td>
                        <td class="<?php echo $dadmin?>">   
                          <a href="" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                          </a></td>
                    </tr> 
                 
                                
                                
                                </tbody>
                            </table>
                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- /.container-fluid end-->
 <!-- Add Payment Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نقد رقم کی ادائیگی</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <label for="amount" >نقدی</label>
                         <input type="number" step="0.01"name="gcash" id='gcash' class=" form-control form-control-user"  readonly>
                         <label for="amount" >نقد ادائیگی</label>
                         <input type="number" step="0.01"name="amount" id='amount' class=" form-control form-control-user"   placeholder=" نقد رقم ادائیگی درج کریں" required>
                         <label for="date">تاریخ</label>
                        <input type="date" name="date" class=" form-control form-control-user"   placeholder="نقد ادائیگی درج کریں" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="add" class="btn btn-success" value="Add New">
                    </form>
                </div>
            </div>
        </div>
    </div>
         <!-- Edit Cash Hand Modal-->
         <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">تفصیلات کی تازہ کاری کریں</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center ">
                                <form action="" method="post">
                                <label for="">Cash in Hand Amount</label>
                                <input type="number" step="0.01"name='cash_hand' class="form-control" value="<?php echo $output['cash']?>">
                                </div>
                                <div class="modal-footer">
                                        <input type="hidden" name="id" value="<?php echo $output['id']?>">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <input type="submit" name="up2" class="btn btn-warning" value="Update">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
<?php include "footer.php"?>
<script>
var cash=document.getElementById('cash').value;
document.getElementById('gcash').value=cash;
document.getElementById('amount').max=cash;
</script>
</div>
</div>