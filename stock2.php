<?php  session_start(); include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM stock2 ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
//Add new stock2 Form Submit
if(isset($_POST['add']))
  {  
     $name =  $_POST['name'];
    $quantity =  $_POST['quantity'];
    $amount =  $_POST['amount'];
    $insert = mysqli_query($conn,"INSERT INTO `stock2`(`name`, `quantity`,`amount`)
	VALUES('$name','$quantity','$amount')");
     if($insert){
        echo "<script> alert('Stock is Added Successfully!');window.location.href='stock2.php' </script>";
    }
}
 //Delete Partty
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM stock2 WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('stock is Deleted Successfully!');window.location.href='stock2.php' </script>";
        }
 }
  //UPDATE Expenses
  if(isset($_POST['up']))
  { $eid =  $_POST['eid'];
     $name =  $_POST['name'];
     $quantity =  $_POST['quantity'];
     $amount =  $_POST['amount'];
     $sql = "UPDATE `stock2` SET `name`='$name',`quantity`='$quantity',`amount`='$amount' WHERE id='$eid'";
     $up=mysqli_query($conn, $sql);
         if($up){
             echo "<script> alert('stock is Updated Successfully!');window.location.href='stock2.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">اسٹاک</h1>
<button class='btn btn-success'  data-toggle="modal" data-target="#AddempModal">نیا اسٹاک شامل کریں</button> <br><br>
<div class='row'>
<!-- DataTales Example -->
<div class="col-md-12 ">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">اسٹاک</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>اسٹاک کا عنوان</th>
                        <th>مقدار</th>
                        <th> فی قیمت</th>
                        <th class="<?php echo $dadmin?>">عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php $i=1; foreach($output as $out) {?>
                    <tr>
                        <td><?php echo $out['name']?></td>
                        <td ><?php echo $out['quantity']?> </td>
                        <td ><?php echo $out['amount']?> </td>
                        <td class="<?php echo $dadmin?>">    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['name']?>'
                        ,'<?php echo $out['quantity']?>','<?php echo $out['amount']?>')" data-toggle="modal" data-target="#editModal">
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
</div> </div> </div>
<!-- /.container-fluid end-->
 <!-- Add stock2 Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نیا اسٹاک شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="text" name="name" class=" form-control form-control-user"   placeholder="اسٹاک کا عنوان" required> <br>
                        <input type="number" step="0.01"name="quantity" min='0' class=" form-control form-control-user"   placeholder="اسٹاک کی مقدار" required> <br>
                        <input type="number" step="0.01"name="amount" min='0' class=" form-control form-control-user"   placeholder="اسٹاک کی قیمت" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="add" class="btn btn-success" value="Add New">
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-- Update Stock Borrow Modal-->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اسٹاک کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" id='eid' name='eid'>
                    <label for="">اسٹاک کا عنوان</label>
                    <input type="text" name="name"  id="name" class=" form-control form-control-user"   placeholder="" required> <br>
                    <label for="">اسٹاک کا مقدار</label>
                        <input type="number" step="0.01"name="quantity" id="quantity" min='0' class=" form-control form-control-user"   placeholder="" required> <br>
                        <label for=""> فی قیمت</label>
                        <input type="number" step="0.01"name="amount" id="amount" min='0' class=" form-control form-control-user"   placeholder="" required>
                        
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
<script>
function GetEModal(eid,name,quantity,amount) {
   
    document.getElementById("eid").value=eid ;
    document.getElementById("name").value =name;
    document.getElementById("quantity").value =quantity;
    document.getElementById("amount").value =amount;
}
</script>
</div>
</div>