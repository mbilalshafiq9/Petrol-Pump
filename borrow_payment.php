<?php session_start();
include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM borrow_payment ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);
$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
$data2 = mysqli_query($conn, "SELECT * FROM customers ");
$output2 = mysqli_fetch_all($data2,MYSQLI_ASSOC);
//Add new customer Form Submit
if(isset($_POST['add']))
  {  $cid =  $_POST['customer'];
     $p_amount =  $_POST['p_amount'];
     $a_amount =  $_POST['a_amount'];
     if($a_amount>0){ $b_amount=0;
        $sql = "UPDATE `customers` SET `b_amount`='$b_amount', `a_amount`=`a_amount`+'$a_amount' WHERE id='$cid'";}

  else{   $sql = "UPDATE `customers` SET `b_amount`=`b_amount`-'$p_amount', `a_amount`=`a_amount`+'$a_amount' WHERE id='$cid'";}
    $update=mysqli_query($conn, $sql);
    $date = $_POST['date'];
    $insert = mysqli_query($conn,"INSERT INTO `borrow_payment`(`p_amount`, `date`,`cid`)
	VALUES('$p_amount','$date','$cid')");
     if($insert){
        echo "<script> alert('Customer is Added Successfully!');window.location.href='borrow_payment.php' </script>";
    }
}
//UPDATE customer
if(isset($_POST['up']))
{ $bid =  $_POST['bid'];
    $cid =  $_POST['cid'];
    $pamount3= $_POST['pamount3'];
    $pamount2= $_POST['pamount2'];
      $tpamount=$pamount3-$pamount2;
    $date= $_POST['date'];
    $nsql = "UPDATE `customers` SET `b_amount`=`b_amount`+'$tpamount' WHERE id='$cid'";
    $nup=mysqli_query($conn, $nsql);
   $sql = "UPDATE `borrow_payment` SET `cid`='$cid',`p_amount`='$pamount2',`date`='$date' WHERE id='$bid'";
   $update=mysqli_query($conn, $sql);

       if($update){
           echo "<script> alert('Customer Borrow Details is Updated Successfully!');window.location.href='borrow_payment.php' </script>";
       }
}
 //Delete Customer
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM borrow_payment WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Borrow payment is Deleted Successfully!');window.location.href='borrow_payment.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">ادھار کی ادائیگی</h1>
<button class='btn btn-success mr-2'  data-toggle="modal" data-target="#AddpayModal">نیا ادائیگی شامل کریں</button> <br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ادھار کی ادائیگی</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>گاهک</th>
                        <th>ادائیگی کی رقم</th>
                        <th>تاریخ</th>
                        <th class='<?php echo $dadmin?>'>عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                        <td><?php $cid=$out['cid'];  $data3 = mysqli_query($conn, "SELECT * FROM customers where id='$cid'");
                        $output3 = mysqli_fetch_assoc($data3); echo $output3['name'];?></td>
                        <td><?php echo $out['p_amount']?></td>
                        <td><?php echo $out['date']?></td>
                      
                        <td class='<?php echo $dadmin?>'> <a href="#" class="btn btn-warning btn-circle" onclick="GetEModal('<?php echo $out['cid']?>','<?php echo $out['id']?>','<?php echo $out['p_amount']?>','<?php echo $out['date']?>')
                        ;CAlBorrow2('<?php echo $out['cid']?>');"
                         data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                          </a>
                          <a href="" class="btn btn-danger btn-circle" onclick="GetdelModal('<?php echo $out['id']?>')" data-toggle="modal" data-target="#delModal">
                                        <i class="fas fa-trash"></i>
                          </a></td>
                    </tr> 
   
    </div> <?php }?>
                 
                   
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
                حذف پر کلک کرنے کے بعد آپ اس صارف کو واپس نہیں لے سکتے ہیں۔
                    نیز معلومات سے متعلق صارفین کو سسٹم سے نکال دیں گے
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <input type="hidden" name="id" id="id">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="del" class="btn btn-danger" value="Yes, Delete">
                    </form>
                </div>
            </div>
        </div></div>
 <!-- Add Payment Modal-->
 <div class="modal fade" id="AddpayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">صارفین کے قرض کی ادائیگی شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                 
                    <label for="">کسٹمر منتخب کریں</label>
                          <input type="text" class="form-control" name="" id="customer" placeholder="نام / فون نمبر / CNIC" onkeyup="GetCustomer(this.value);CAlBorrow();" >
             	 <label for=""> Customer:</label>
              	<input type="text" name="cust" class="form-control" id="cust"  readonly >
                  <input type="hidden" name="customer" id="custid" >
                        <div class="row">
                            <div class="col-md-6">
                            <label for="employee" class="mt-2" >قرضے کی رقم</label>
                            <input type="number" step="0.01" id='b_amount' name="b_amount" class=" form-control form-control-user "  onchange="" min='0' readonly>
                             <input type="date" name="date" class=" form-control form-control-user mt-4" max="<?php echo  date("Y-m-d")?>" placeholder=" date" required>
                            </div>
                            <div class="col-md-6">
                            <input type="number" step="0.01" id='p_amount' name="p_amount" onchange="CalAdv(this.value)" class=" form-control form-control-user mt-4" Placeholder="ادائیگی کی رقم درج کریں" min='0' required>
                            <label for="employee" class="mt-2" >ایڈوانس رقم</label>
                            <input type="number" step="0.01" id='a_amount' name="a_amount" class=" form-control form-control-user" min='0' readonly>
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
        <!-- Update Employee  Modal-->
 <div class="modal fade" id="editModal" tabindex="-1" address="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" address="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-purpose" id="exampleModalLabel">قرض کی رقم کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="bid" id='bid'  >
                    <input type="hidden"step="0.01" name="pamount3" id='pamount3'  >
                    <label for="customer" class="" >کسٹمر منتخب کریں</label>
                        <select name="cid" id="cid" class=" form-control" onchange="CAlBorrow2(this.value); " >
                       <option value="">کسٹمر منتخب کریں</option>
                          <?php foreach($output2 as $out2){?>
                          <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?> </option>
                          <?php }?>
                        </select>
                        <div class="row">
                            <div class="col-md-6">
                            <label for="employee" class="mt-2" >قرضے کی رقم</label>
                            <input type="number"step="0.01" id='bamount2' name="b_amount" class=" form-control form-control-user "  onchange="" min='0' readonly>
                             <input type="date" name="date" id="date" class=" form-control form-control-user mt-4" max="<?php echo  date("Y-m-d")?>" placeholder=" date" required>
                            </div>
                            <div class="col-md-6">
                            <label for="">ادائیگی کی رقم درج کریں</label>
                            <input type="number" step="0.01" id='pamount2' name="pamount2"  class=" form-control form-control-user mt-2" Placeholder="ادائیگی کی رقم درج کریں" min='0' required>
                            
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
function GetEModal(cid,id,pamount,date) {
   
   document.getElementById("bid").value=id ;
document.getElementById("cid").value=cid ;
document.getElementById("pamount2").value =pamount;
document.getElementById("pamount3").value =pamount;
document.getElementById("date").value =date;

}

function GetdelModal(id) {
    document.getElementById("id").value=id ;
}

function CAlBorrow() {
   cid=document.getElementById("custid").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("b_amount").value =
      this.responseText;
    }
    
  };
  xhttp.open("GET", "ajax_data.php?cid="+cid, true);
  xhttp.send();
}
function CalAdv(pamount){
    
   bamount=document.getElementById("b_amount").value;
    aamount=pamount-bamount;
    if(aamount>0){ var tamount=aamount;}
    else{var tamount=0;}
    document.getElementById("a_amount").value=tamount;
}
function CAlBorrow2(cid) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("bamount2").value =
      this.responseText;
    }
  };
  xhttp.open("GET", "ajax_data.php?cid="+cid, true);
  xhttp.send();
}
function GetCustomer(cname) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       var name=jQuery.parseJSON(this.responseText);
      document.getElementById("custid").value =name[0];
      document.getElementById("cust").value =name[1];
    }
  };
  xhttp.open("GET", "ajax_data.php?cname="+cname, true);
  xhttp.send();
}
</script>


</div>