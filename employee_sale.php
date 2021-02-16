<?php session_start(); include "db.php";
include "header.php";
// $sql = mysqli_query($conn, "SELECT * FROM meters ");
// $total = mysqli_fetch_all($sql,MYSQLI_ASSOC);
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
$data = mysqli_query($conn, "SELECT * FROM employee_sale ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);

$data2 = mysqli_query($conn, "SELECT * FROM employees where role='worker'");
$output2 = mysqli_fetch_all($data2,MYSQLI_ASSOC);
$data3 = mysqli_query($conn, "SELECT * FROM stock ");
$output3 = mysqli_fetch_all($data3,MYSQLI_ASSOC);
//Add new Employee Sale Form Submit
if(isset($_POST['add']))
  {   $meterno =  $_POST['meterno'];
    $meter_reading =  $_POST['end_r'];
    $liters = $_POST['liters'];
    
    $petrol_type = $_POST['petrol_type'];
    $query = mysqli_query($conn, "UPDATE `meters` SET `c_reading`='$meter_reading' WHERE meterno='$meterno' and ptrol_type='$petrol_type'");

    $query2 = mysqli_query($conn, "UPDATE `stock` SET `dip`=`dip`-$liters WHERE petrol_type='$petrol_type'");
    $pr_lt =  $_POST['pr_lt'];
    $t_amount = $_POST['t_amount'];
    $b_amount = $_POST['b_amount'];
    $cash_hand = $_POST['cash_hand'];
    $date = $_POST['date'];
    $e_id = $_POST['e_id'];  $e_salary = $_POST['e_salary'];
    $insert = mysqli_query($conn,"INSERT INTO `employee_sale`(`meterno`, `meter_reading`,`liters`,`petrol_type`, `pr_lt`,`t_amount`,`b_amount`,`cash_hand`, `date`,`e_id`,`e_salary`)
	VALUES('$meterno','$meter_reading','$liters','$petrol_type','$pr_lt','$t_amount','$b_amount','$cash_hand','$date','$e_id','$e_salary')");
     if($insert){
        echo "<script> alert('Employee Daily Sale is Added Successfully!');window.location.href='employee_sale.php' </script>";
    }
}
 //Delete Employee Sale
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM employee_sale WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Employee Sale is Deleted Successfully!');window.location.href='employee_sale.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">ملازمین کی روزانہ فروخت</h1>
<button class='btn btn-success'  data-toggle="modal" data-target="#AddempModal">ملازم روزانہ فروخت شامل کریں</button> <br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ملازمین ڈیلی سیل</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>ملازم</th>
                        <th>میٹر نمبر</th>
                        <th>میٹر پڑھنے</th>
                        <th>لٹر</th>
                        <th>پٹرولیم کی قسم</th>
                        <th>کل فروخت (Rs.)</th>
                        <th>ملازمین کی تنخواہ</th>
                        <th>قرضے کی رقم</th>
                        <th>ہاتھ میں نقد</th>
                        <th>تاریخ</th>
                        <th class="<?php echo $dadmin?>">عمل</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                        <td><?php   $eid=$out['e_id'];
                         $data3 = mysqli_query($conn, "SELECT * FROM employees where id='$eid' ");
                        $output3 = mysqli_fetch_assoc($data3); echo $output3['name'];?> </td>
                         <td><?php echo $out['meterno']?></td>
                        <td><?php echo $out['meter_reading']?></td>
                        <td><?php echo $out['liters']?></td>
                        <td><?php echo $out['petrol_type']?></td>
                        <td><?php echo $out['t_amount']?></td>
                        <td><?php echo $out['e_salary']?></td>
                        <td><?php echo $out['b_amount']?></td>
                        <td><?php echo $out['cash_hand']?></td>
                        <td><?php echo $out['date']?></td>
                        <td class="<?php echo $dadmin?>">   
                          <!-- <a href="" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#editModal" onclick="Getdel(<?php echo $out['id']?>)">
                                        <i class="fas fa-edit"></i> </a> -->
                        <a href="" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delModal" onclick="Getdel(<?php echo $out['id']?>)">
                        <i class="fas fa-trash"></i>  </a> </td>
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
 <!-- Add Employee Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">روزانہ ملازم کی فروخت شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <div class="row">
                    <!-- COlumn 1 of Form -->
                    <div class="col-md-6">
                    <label for="role">پٹرولیم کی قسم منتخب کریں</label>  
                      <select name="petrol_type" id="ptr_type" onchange=" GetStock(); GetMeters(); GetCreading(); " class="  form-control " required>
                      <option value="">پٹرولیم کی قسم منتخب کریں </option>  <option value="petrol">Petrol </option>
                            <option value="diesel">Diesel </option>
                            </select> 
                    <label for="role" class=''>Meter Current Reading:</label>  
                      <input type="text" name="start_r" id="start_r" class=" form-control form-control-user " value=""
                        readonly> 
                    <input type="number" step="0.01" name="pr_lt" id="prlt" class='form-control form-control-user mt-4'
                    onchange="CalPrice()" Placeholder="فی لیٹر قیمت درج کریں" required>
                    <label for="role" class=' mt-1 '>Select Employee:</label>  
                      <select name="e_id" id="" class="  form-control form-control-user">
                          <?php foreach($output2 as $out2){?>
                          <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?> </option>
                          <?php }?>
                            </select> 
                        <input type="number" step="0.01" name="e_salary" class=" form-control form-control-user mt-4"  Placeholder="ملازم روزانہ تنخواہ" id="" required>
                        <label for=""> ہاتھ میں نقد</label>
                        <input type="number" step="0.01"name="cash_hand" class=" form-control form-control-user "  Placeholder="ہاتھ میں نقد" id="gcash" readonly>
                    </div> 
                    <!-- Column 2 of Form -->
                    <div class="col-md-6">
                    <label for="role" class=''>میٹر نمبر منتخب کریں</label>  
                      <select name="meterno" id="meterno" class=" form-control" onchange="GetCreading()">
                          <option value="1" id="opt1">1 </option>
                            <option value="2" id="opt2">2 </option>
                            <option value="3" id="opt3">3 </option>
                            <option value="4" id="opt4">4 </option>
                            </select>
                  
                    <input type="number" step="0.01"name="end_r" id="end_r"  class=" form-control form-control-user mt-4"
                        onchange="CalLiter(); CalPrice(); CalCashHand();" placeholder="Enter End Reading" required> 
                        <label for="role" class=''>Liter:</label>  
                         <input type="number" step="0.01"class=" form-control form-control-user" name="liters" id="liters" value="" style=" pointer-events: none;background-color:#eaecf4 "> 
                       Total Amount (Rs.): <input type="text" class=" form-control form-control-user mt-1" name="t_amount" id="amount" value="" readonly>  
                      <input type="number" step="0.01"name="b_amount" class=" form-control form-control-user mt-4" min='0' Placeholder="قرض کی رقم درج کریں" id="gbamount" required onchange="CalCashHand()">
                      <input type="date" name="date" class=" form-control form-control-user mt-3" max="<?php echo  date("Y-m-d")?>" required id="">
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
                        <input type="hidden" name="id" id="id" value="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="del" class="btn btn-danger" value="Yes, Delete">
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
                    <div class="row">
                    <!-- COlumn 1 of Form -->
                    <div class="col-md-6">
                    <label for="role">پٹرولیم کی قسم منتخب کریں</label>  
                      <select name="petrol_type" id="ptr_type" onchange=" GetStock(); GetMeters(); GetCreading(); " class="  form-control " required>
                      <option value="">پٹرولیم کی قسم منتخب کریں </option>  <option value="petrol">Petrol </option>
                            <option value="diesel">Diesel </option>
                            </select> 
                    <label for="role" class=''>Meter Current Reading:</label>  
                      <input type="text" name="start_r" id="start_r" class=" form-control form-control-user " value=""
                        readonly> 
                    <input type="number" step="0.01"name="pr_lt" id="prlt" class='form-control form-control-user mt-4'
                    onchange="CalPrice()" Placeholder="فی لیٹر قیمت درج کریں" required>
                    <label for="role" class=' mt-1 '>Select Employee:</label>  
                      <select name="e_id" id="" class="  form-control form-control-user">
                          <?php foreach($output2 as $out2){?>
                          <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?> </option>
                          <?php }?>
                            </select> 
                        <input type="number" step="0.01"name="e_salary" class=" form-control form-control-user mt-4"  Placeholder="ملازم روزانہ تنخواہ" id="" required>
                        <label for=""> ہاتھ میں نقد</label>
                        <input type="number" step="0.01"name="cash_hand" class=" form-control form-control-user "  Placeholder="ہاتھ میں نقد" id="gcash" readonly>
                    </div> 
                    <!-- Column 2 of Form -->
                    <div class="col-md-6">
                    <label for="role" class=''>میٹر نمبر منتخب کریں</label>  
                      <select name="meterno" id="meterno" class=" form-control" onchange="GetCreading()">
                          <option value="1" id="opt1">1 </option>
                            <option value="2" id="opt2">2 </option>
                            <option value="3" id="opt3">3 </option>
                            <option value="4" id="opt4">4 </option>
                            </select>
                  
                    <input type="number" step="0.01"name="end_r" id="end_r"  class=" form-control form-control-user mt-4"
                        onchange="CalLiter(); CalPrice(); CalCashHand();" placeholder="Enter End Reading" required> 
                        <label for="role" class=''>Liter:</label>  
                         <input type="number" step="0.01"class=" form-control form-control-user" name="liters" id="liters" value="" style=" pointer-events: none;background-color:#eaecf4 "> 
                       Total Amount (Rs.): <input type="text" class=" form-control form-control-user mt-1" name="t_amount" id="amount" value="" readonly>  
                      <input type="number" step="0.01"name="b_amount" class=" form-control form-control-user mt-4" min='0' Placeholder="قرض کی رقم درج کریں" id="gbamount" required onchange="CalCashHand()">
                      <input type="date" name="date" class=" form-control form-control-user mt-3" max="<?php echo  date("Y-m-d")?>" required id="">
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
<script>
    function Getdel($id){
        document.getElementById("id").value=$id; 
    }


 function GetMeters(){
    var ptr_type = document.getElementById("ptr_type").value;
    
    if(ptr_type.match('petrol')){ 
        document.getElementById("opt1").innerHTML='1';   document.getElementById("opt2").innerHTML='2';
        document.getElementById("opt3").innerHTML='3'; document.getElementById("opt4").innerHTML='4';
        document.getElementById("opt1").value='1';   document.getElementById("opt2").value='2';
        document.getElementById("opt3").value='3'; document.getElementById("opt4").value='4';
    } 
    else{
        document.getElementById("opt1").innerHTML='5';document.getElementById("opt2").innerHTML='6';
        document.getElementById("opt3").innerHTML='7'; document.getElementById("opt4").innerHTML='8';
        document.getElementById("opt1").value='5';document.getElementById("opt2").value='6';
        document.getElementById("opt3").value='7'; document.getElementById("opt4").value='8';
    }
    }
    function CalCashHand(){
        var tamount = document.getElementById("amount").value;
        var bamount = document.getElementById("gbamount").value;
        var cash_hand=tamount-bamount;
      document.getElementById("gcash").value=cash_hand;
    }
    function CalLiter(){
        var x = document.getElementById("start_r").value;
        var y = document.getElementById("end_r").value;
        document.getElementById("end_r").min=x;
        var z=y-x;
        document.getElementById("liters").value = z;
    }
    function CalPrice(){
        var a = document.getElementById("liters").value;
        var b = document.getElementById("prlt").value;
        var c=a*b;
        document.getElementById("amount").value = c;
        document.getElementById("gbamount").max = c;
    }
    function GetCreading() {
   var meterno = document.getElementById("meterno").value;
   var ptr_type = document.getElementById("ptr_type").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("start_r").value =
      this.responseText;
    }
  };
  xhttp.open("GET", "ajax_data.php?ptr_type="+ptr_type+"&meterno="+meterno, true);
  xhttp.send();
}

function GetStock() {
   var ptr_type = document.getElementById("ptr_type").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("liters").max =
      this.responseText;
    }
  };
  xhttp.open("GET", "ajax_data.php?ptr_type2="+ptr_type, true);
  xhttp.send();
}

    </script>
</div>
</div>