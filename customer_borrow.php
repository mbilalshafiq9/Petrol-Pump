<?php session_start();
include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM customer_borrow ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);

$data2 = mysqli_query($conn, "SELECT * FROM customers ");
$output2 = mysqli_fetch_all($data2,MYSQLI_ASSOC);

$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
//Add new customer Form Submit
if(isset($_POST['add']))
  {  
     $cid =  $_POST['cid'];
    $p_type =  $_POST['p_type'];
    $quantity = $_POST['quantity'];
    $pr_lt = $_POST['pr_lt'];
    $tamount= $_POST['tamount'];
    $date= $_POST['date'];
    $data5 = mysqli_query($conn, "SELECT * FROM customers where id='$cid'");
    $output5 = mysqli_fetch_assoc($data5);
    if($tamount > $output5['a_amount']){   $b_amount=$tamount-$output5['a_amount']; $a_amount=0;   }
    else{$b_amount=$output5['a_amount']-$tamount; $b_amount=0;  }
    $insert = mysqli_query($conn,"INSERT INTO `customer_borrow`(`cid`, `p_type`,`quantity`,`pr_lt`,`tamount`,`date`)
    VALUES('$cid','$p_type','$quantity','$pr_lt','$tamount','$date')");
    $sql = "UPDATE `customers` SET `b_amount`=`b_amount`+'$b_amount',`a_amount`='$a_amount' WHERE id='$cid'";
    $up=mysqli_query($conn, $sql);
     if($insert){
        echo "<script> alert('Customer Borrow is Added Successfully!');window.location.href='customer_borrow.php' </script>";
    }
}
 //Delete Customer
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM customer_borrow WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Customer Borrow is Deleted Successfully!');window.location.href='customer_borrow.php' </script>";
        }
 }
//UPDATE customer
if(isset($_POST['up']))
{ $bid =  $_POST['bid'];
    $cid =  $_POST['cid'];
    $p_type =  $_POST['p_type'];
    $quantity = $_POST['quantity'];
    $pr_lt = $_POST['pr_lt'];
    $tamount= $_POST['tamount'];
    $tamount2= $_POST['tamount3'];
    $tbamount=$tamount2-$tamount;
    $date= $_POST['date'];
    $nsql = "UPDATE `customers` SET `b_amount`=`b_amount`+'$tbamount' WHERE id='$cid'";
    $nup=mysqli_query($conn, $nsql);
   $sql = "UPDATE `customer_borrow` SET `cid`='$cid',`p_type`='$p_type',`quantity`='$quantity',`pr_lt`='$pr_lt' ,`tamount`='$tamount',`date`='$date'
   WHERE id='$bid'";
   $update=mysqli_query($conn, $sql);

       if($update){
           echo "<script> alert('Customer Borrow Details is Updated Successfully!');window.location.href='customer_borrow.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">گاهک کا قرض</h1>
<button class='btn btn-success mr-2'  data-toggle="modal" data-target="#AddempModal">نیا گاهک کا قرض شامل کریں</button><br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">گاهک کا قرض </h6> 
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>نام گاهک کا</th>
                        <th>مصنوعات کی قسم</th> 
                        <th>مصنوعات کی مقدار</th>
                        <th>فی اکائی قیمت</th>
                        <th>کل قرض کی رقم</th>
                        <th>تاریخ</th>
                        <th class="<?php echo $dadmin?>">عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                        <td><?php $cid=$out['cid'];$data3 = mysqli_query($conn, "SELECT * FROM customers where id='$cid'");
                        $output3 = mysqli_fetch_assoc($data3); echo $output3['name']?></td>
                        <td><?php echo $out['p_type']?></td>
                        <td><?php echo $out['quantity']?></td>
                        <td><?php echo $out['pr_lt']?></td>
                        <td><?php echo $out['tamount']?></td>
                        <td><?php echo $out['date']?></td>
                        <td class="<?php echo $dadmin?>">    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['cid']?>','<?php echo $out['p_type']?>','<?php echo $out['quantity']?>'
                            ,'<?php echo $out['pr_lt']?>' ,'<?php echo $out['tamount']?>' ,'<?php echo $out['date']?>')" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                          </a>
                          <a href="" class="btn btn-danger btn-circle"  onclick="GetdelModal( '<?php echo  $out['id']?>')" data-toggle="modal" data-target="#delModal">
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
        </div>
    </div> 
 <!-- Add customer borrow Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نیا گاهک کا قرض شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <label for="">کسٹمر منتخب کریں</label>
                          <input type="text" class="form-control" name="customer" id="customer" placeholder="نام / فون نمبر / CNIC" onkeyup="GetCustomer(this.value)">
             	 <label for=""> Customer:</label>
                
              	<input type="text" name="cust" class="form-control" id="cust"  readonly>
             	<input type="hidden" name="cid" id="custid">
                        <input type="text" name="p_type" id="" class=' form-control mt-4' placeholder="مصنوعات کی قسم" required>
                        <div class="row">
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="quantity" id="quantity" onchange="GetTamount()" class=' form-control mt-4' placeholder="مصنوعات کی مقدار" required>
                            <input type="number" step="0.01"name="tamount" id="tamount" class=' form-control mt-4' placeholder="کل قرض کی رقم" readonly>
                            </div>
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="pr_lt" id="pr_lt" onchange="GetTamount()" class=' form-control mt-4' placeholder="فی اکائی قیمت" required>
                            <input type="date" name="date" id="" class=' form-control mt-4' required>
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
          <!-- Update customer  Modal-->
 <div class="modal fade" id="editModal" tabindex="-1" address="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" address="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-purpose" id="exampleModalLabel">صارفین کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="bid" class="form-control" id="bid"  readonly>
             	 <label for=""> Customer:</label>
                  <select name="cid" id="cid2" class=" form-control"   >
                       <option value="">کسٹمر منتخب کریں</option>
                          <?php foreach($output2 as $out2){?>
                          <option value="<?php echo $out2['id']?>"><?php echo $out2['name']?> </option>
                          <?php }?>
                        </select>
           
                        <input type="text" name="p_type" id="p_type" class=' form-control mt-4' placeholder="مصنوعات کی قسم" required>
                        <div class="row">
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="quantity" id="quantity2" onchange="GetTamount2()" class=' form-control mt-4' placeholder="مصنوعات کی مقدار" required>
                            <input type="number" step="0.01"name="tamount" id="tamount2" class=' form-control mt-4' placeholder="کل قرض کی رقم" readonly>
                            </div>
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="pr_lt" id="pr_lt2" onchange="GetTamount2()" class=' form-control mt-4' placeholder="فی اکائی قیمت" required>
                            <input type="date" name="date" id="date" class=' form-control mt-4' required>
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
    function GetTamount()
    {
       var quantity=document.getElementById("quantity").value ;
      var  prlt=document.getElementById("pr_lt").value ;
       var tamount=quantity * prlt;
        document.getElementById("tamount").value=tamount ;
    }
    function GetTamount2()
    {
       var quantity=document.getElementById("quantity2").value ;
      var  prlt=document.getElementById("pr_lt2").value ;
       var tamount=quantity * prlt;
        document.getElementById("tamount2").value=tamount ;
    }
    function GetEModal(id,cid,p_type,quantity,pr_lt,tamount,date) {
        document.getElementById("bid").value=id ;
     document.getElementById("cid2").value=cid ;
     document.getElementById("p_type").value =p_type;
     document.getElementById("quantity2").value =quantity;
     document.getElementById("pr_lt2").value =pr_lt;
     document.getElementById("tamount2").value =tamount;
     document.getElementById("tamount3").value =tamount;
     document.getElementById("date").value =date;
 
 }
 function GetdelModal(cid){
    document.getElementById("cid").value=cid ;
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