<?php  session_start(); 
include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM stock_sale ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);
$data2 = mysqli_query($conn, "SELECT * FROM stock2 ");
$output2 = mysqli_fetch_all($data2,MYSQLI_ASSOC);
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
//Add new stock_sale Form Submit
if(isset($_POST['add']))
  {  
     $sid =  $_POST['sid'];
    $quantity =  $_POST['quantity'];
    $tamount =  $_POST['tamount'];
    $date =  $_POST['date'];
    $insert = mysqli_query($conn,"INSERT INTO `stock_sale`(`sid`, `quantity`,`tamount`,`date`)
    VALUES('$sid','$quantity','$tamount','$date')");
  $sql = "UPDATE `stock2` SET `quantity`=`quantity`-'$quantity' where id='$sid'";
  $update=mysqli_query($conn, $sql);
     if($insert){
        echo "<script> alert('Stock sale is Added Successfully!');window.location.href='stock_sale.php' </script>";
    }
}
 //Delete Partty
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM stock_sale WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('stock sale is Deleted Successfully!');window.location.href='stock_sale.php' </script>";
        }
 }
  //UPDATE Expenses
  if(isset($_POST['up']))
  { $eid =  $_POST['eid'];
    $sid =  $_POST['sid'];
    $quantity =  $_POST['quantity'];
    $quantity_pre =  $_POST['quantity_pre'];
    $tamount =  $_POST['tamount'];
    $date =  $_POST['date'];
    $remq=$quantity_pre-$quantity;
    $sql2 = "UPDATE `stock2` SET `quantity`=`quantity`+'$remq' where id='$sid'";    $up2=mysqli_query($conn, $sql2);
     $sql = "UPDATE `stock_sale` SET `sid`='$sid',`quantity`='$quantity',`tamount`='$tamount',`date`='$date' WHERE id='$eid'";
     $up=mysqli_query($conn, $sql);
         if($up){
             echo "<script> alert('Stock SaLe is Updated Successfully!');window.location.href='stock_sale.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">اسٹاک فروخت</h1>
<button class='btn btn-success'  data-toggle="modal" data-target="#AddempModal">نیا اسٹاک فروخت کریں</button> <br><br>
<div class='row'>
<!-- DataTales Example -->
<div class="col-md-12 ">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">اسٹاک فروخت</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>اسٹاک کا عنوان</th>
                        <th>مقدار</th>
                        <th>کل قیمت </th>
                        <th>تاریخ </th>
                        <th class="<?php echo $dadmin?>">عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php $i=1; foreach($output as $out) {?>
                    <tr>
                        <td><?php $sid=$out['sid']; $data3 = mysqli_query($conn, "SELECT * FROM stock2 where id='$sid'");
                            $output3 = mysqli_fetch_assoc($data3); echo $output3['name']?></td>
                        <td ><?php echo $out['quantity']?> </td>
                        <td ><?php echo $out['tamount']?> </td>
                        <td ><?php echo $out['date']?> </td>
                        <td class="<?php echo $dadmin?>">    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['sid']?>'
                        ,'<?php echo $out['quantity']?>','<?php echo $out['tamount']?>','<?php echo $out['date']?>')" data-toggle="modal" data-target="#editModal">
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
 <!-- Add stock_sale Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نیا اسٹاک فروخت کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <label for="">اسٹاک منتخب کریں</label>
                    <select name="sid" id="sid" onchange="GetSquantity(); " class="  form-control " required>
                    <option value="">اسٹاک منتخب کریں</option>
                            <?php foreach($output2 as $out2){?>
                                <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?> </option>
                          <?php  } ?>
                     </select> <br>
                        <input type="number" step="0.01"name="quantity"  id="quantity" onchange="GetSPrice()" min='0' class=" form-control form-control-user"   placeholder="اسٹاک کی مقدار" required> <br>
                        <input type="number" step="0.01"name="tamount" id='tamount' min='0' class=" form-control form-control-user"    placeholder="اسٹاک کی کل قیمت" required> <br>
                        <input type="date" name="date" class=" form-control form-control-user" required>
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
                    <input type="hidden" name='quantity_pre' id="quantity3">
                    <label for="">اسٹاک منتخب کریں</label>
                    <select name="sid" id="sid2" onchange="GetSquantity(); " class="  form-control " required>
                            <?php foreach($output2 as $out2){?>
                            <option value="">اسٹاک منتخب کریں</option>
                                <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?> </option>
                          <?php  } ?>
                     </select> <br>
                        <input type="number" step="0.01"name="quantity"  id="quantity2" onchange="GetSPrice()" min='0' class=" form-control form-control-user"   placeholder="اسٹاک کی مقدار" required> <br>
                        <input type="number" step="0.01"name="tamount" id='tamount2' min='0' class=" form-control form-control-user"    placeholder="اسٹاک کی کل قیمت" required>
                        <input type="date" name="date" id="date" class=" form-control form-control-user" required>
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
function GetEModal(eid,sid,quantity,tamount,date) {
   
    document.getElementById("eid").value=eid ;
    document.getElementById("sid2").value =sid;
    document.getElementById("quantity2").value =quantity;
    document.getElementById("quantity3").value =quantity;
    document.getElementById("tamount2").value =tamount;
    document.getElementById("date").value =date;
}
function GetSquantity() {
   var sid = document.getElementById("sid").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("quantity").max =
      this.responseText;
    }
  };
  xhttp.open("GET", "ajax_data.php?sid="+sid, true);
  xhttp.send();
}
// function GetSPrice() {
//    var quantity = document.getElementById("quantity").value;
//    var sid = document.getElementById("sid").value;
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//       document.getElementById("tamount").value =
//       this.responseText;
//     }
//   };
//   xhttp.open("GET", "ajax_data.php?sid="+sid+"&quantity="+quantity, true);
//   xhttp.send();
// }
</script>
</div>
</div>