<?php  session_start(); include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM stock ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
$sql2 = mysqli_query($conn, "SELECT * FROM stock_purchase  ");
$output2 = mysqli_fetch_all($sql2,MYSQLI_ASSOC);

if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
//Add new stock Form Submit
if(isset($_POST['add']))
  {  
     $petrol_type =  $_POST['petrol_type'];
    $dip =  $_POST['dip'];
    $pr_lt =  $_POST['pr_lt'];
    $date =  $_POST['date'];
    $insert = mysqli_query($conn,"INSERT INTO `stock_purchase`(`p_type`, `dip`,`pr_lt`,`date`)
	VALUES('$petrol_type','$dip','$pr_lt','$date')");
    $up = mysqli_query($conn,"UPDATE `stock` SET `dip`=`dip`+'$dip' WHERE petrol_type='$petrol_type'");
     if($up){
        echo "<script> alert('Stock is Added Successfully!');window.location.href='stock.php' </script>";
    }
}
 //Delete Stock
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
   echo $dip=$_POST['dip'];
   echo  $p_type=$_POST['p_type'];
    $up = mysqli_query($conn,"UPDATE `stock` SET `dip`=`dip`-'$dip' WHERE petrol_type='$p_type'");
    $sql = "DELETE FROM stock_purchase WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('stock purchase is Deleted Successfully!');window.location.href='stock.php' </script>";
        }
 }
  //UPDATE Stock
  if(isset($_POST['up']))
  { $eid =  $_POST['eid'];
     $liters =  $_POST['liters'];
     $sql = "UPDATE `stock` SET `dip`='$liters' WHERE id='$eid'";
     $up=mysqli_query($conn, $sql);
         if($up){
             echo "<script> alert('Stock is Updated Successfully!');window.location.href='stock.php' </script>";
         }
  }
    //UPDATE Stock 2
    if(isset($_POST['up2']))
    { $sid =  $_POST['sid'];
    $p_type =  $_POST['p_type'];
    $dip =  $_POST['dip'];
    $pr_lt =  $_POST['pr_lt'];
    $date =  $_POST['date'];
    // $up2 = mysqli_query($conn,"UPDATE `stock` SET `dip`=`dip`+'$dip' WHERE petrol_type='$p_type'");
       $sql = "UPDATE `stock_purchase` SET `p_type`='$p_type',`dip`='$dip',`pr_lt`='$pr_lt',`date`='$date' WHERE id='$sid'";
       $up=mysqli_query($conn, $sql);
           if($up){
               echo "<script> alert('Stock is Updated Successfully!');window.location.href='stock.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">ڈپ</h1>
<button class='btn btn-success'  data-toggle="modal" data-target="#AddempModal">نیا ڈپ شامل کریں</button> <br><br>
<div class='row'>
<!-- DataTales Example -->
<div class="col-md-7 ">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ڈپ</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>پٹرولیم کی قسم</th>
                        <th>ڈپ (لیٹر)</th>
                        <th class="<?php echo $dadmin?>">Action</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php $i=1; foreach($output as $out) {?>
                    <tr>
                        <td><?php echo $out['petrol_type']?></td>
                        <td ><?php echo $out['dip']?> لیٹر</td>
                        <input type="hidden" name="liter" id="l<?php echo $i++;?>" value="<?php echo $out['dip']?>">
                        <td class="<?php echo $dadmin?>">    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['dip']?>')" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                          </a></td>
                    </tr> 
           <?php }?>
                 
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
  <!-- Donut Chart -->
  <div class="col-md-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">ڈپ چارٹ</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <hr>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> پیٹرول
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> ڈیزل 
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- /.container-fluid end-->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ڈپ کی خریداری</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>پٹرولیم کی قسم</th>
                        <th>ڈپ (لیٹر)</th>
                        <th>فی لیٹر قیمت</th>
                        <th> Date </th>
                        <th class="<?php echo $dadmin?>">Action</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php $i=1; foreach($output2 as $out2) {?>
                    <tr>
                        <td><?php echo $out2['p_type']?></td>
                        <td ><?php echo $out2['dip']?> لیٹر</td>
                        <td ><?php echo $out2['pr_lt']?> </td>
                        <td ><?php echo $out2['date']?> </td>
                        <input type="hidden" name="liter" id="l<?php echo $i++;?>" value="<?php echo $out['dip']?>">
                        <td class="<?php echo $dadmin?>">    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal2('<?php echo $out2['id']?>','<?php echo $out2['dip']?>','<?php echo $out2['p_type']?>','<?php echo $out2['pr_lt']?>','<?php echo $out2['date']?>')" 
                        data-toggle="modal" data-target="#editModal2">
                                        <i class="fas fa-edit"></i>
                          </a>
                          <a href="#" class="btn btn-danger btn-circle" onclick="Getdel('<?php echo $out2['id']?>','<?php echo $out2['dip']?>','<?php echo $out2['p_type']?>')" data-toggle="modal" data-target="#delModal">
                                        <i class="fas fa-trash" ></i>
                          </a></td>
                    </tr> 
     <?php }?>
                 
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
 <!-- Add stock Modal-->
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
                         <label for="jdate">پٹرولیم کی قسم منتخب کریں:</label>
                        <select name="petrol_type" id="" class="  form-control ">
                          <option value="petrol">Petrol </option>
                            <option value="diesel">Diesel </option>
                        </select> <br> 
                        <label for="role" >ڈپ میں لیٹر داخل کریں</label>
                        <input type="number" step="0.01"name="dip" class=" form-control form-control-user"   placeholder="ڈپ میں لیٹر داخل کریں" required>
                        <label for="role" >فی لیٹر قیمت</label>
                        <input type="number" step="0.01"name="pr_lt" class=" form-control form-control-user"   placeholder="فی لیٹر قیمت" required> <br>
                        <input type="date"  name="date" class='form-control form-control-user' max="<?php echo date('Y-m-d')?>">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="add" class="btn btn-success" value="Add New">
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-- Update Stock Modal-->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ڈپ کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="eid" id="eid">
                    <label for="role" >ڈپ میں لیٹر کو اپ ڈیٹ کریں</label>
                    <input type="number" step="0.01"name="liters" id="liters" class=" form-control form-control-user" required> <br>
                        
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="up" class="btn btn-warning" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="dip" id="dip" >
                        <input type="hidden" name="p_type" id="p_type" >
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="del" class="btn btn-danger" value="Yes, Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
      <!-- Update Stock Purchase Modal-->
 <div class="modal fade" id="editModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ڈپ کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="sid" id="sid">
                    <label for="jdate">پٹرولیم کی قسم منتخب کریں:</label>
                        <select name="p_type" id="p_type2" class="  form-control ">
                          <option value="petrol">Petrol </option>
                            <option value="diesel">Diesel </option>
                        </select> <br> 
                        <label for="role" >ڈپ میں لیٹر داخل کریں</label>
                        <input type="number" step="0.01"name="dip" id="dip2" class=" form-control form-control-user"   placeholder="ڈپ میں لیٹر داخل کریں" required>
                        <label for="role" >فی لیٹر قیمت</label>
                        <input type="number" step="0.01"name="pr_lt"  id="pr_lt" class=" form-control form-control-user"   placeholder="فی لیٹر قیمت" required> <br>
                        <input type="date"  name="date"  id="date" class='form-control form-control-user' max="<?php echo date('Y-m-d')?>">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="up2" class="btn btn-warning" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"?>
<script>
function GetEModal(eid,liters) {
    document.getElementById("eid").value=eid ;
    document.getElementById("liters").value =liters;
}
function Getdel(id,dip,p_type) {
    document.getElementById("id").value=id ;
    document.getElementById("dip").value=dip ;
    document.getElementById("p_type").value=p_type ;
}
function GetEModal2(id,dip,p_type,pr_lt,date) {
    document.getElementById("sid").value=id ;
    document.getElementById("dip2").value=dip ;
    document.getElementById("p_type2").value=p_type ;
    document.getElementById("pr_lt").value=pr_lt ;
    document.getElementById("date").value=date ;
}
</script>
</div>
</div>