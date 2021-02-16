<?php session_start();
include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM customers ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);

$data2 = mysqli_query($conn, "SELECT * FROM employees where role='worker'");
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
     $name =  $_POST['name'];
    $phoneno =  $_POST['phoneno'];
    $address = $_POST['address'];
    $cnic = $_POST['cnic'];
    $b_amount = $_POST['b_amount'];
    $c_type = $_POST['c_type'];
    $refer_by = $_POST['refer_by'];
    $raddress = $_POST['raddress'];
    $rcnic = $_POST['rcnic'];
    $insert = mysqli_query($conn,"INSERT INTO `customers`(`name`, `phoneno`,`address`,`cnic`,`b_amount`,`c_type`,`refer_by`,`raddress`,`rcnic`)
	VALUES('$name','$phoneno','$address','$cnic','$b_amount','$c_type','$refer_by','$raddress','$rcnic')");
     if($insert){
        echo "<script> alert('Customer is Added Successfully!');window.location.href='customers.php' </script>";
    }
}
 //Delete Customer
  if(isset($_POST['del']))
 {
    $id = $_POST['cid2'];
    $sql = "DELETE FROM customers WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Customer is Deleted Successfully!');window.location.href='customers.php' </script>";
        }
 }
//UPDATE customer
if(isset($_POST['up']))
{ $cid =  $_POST['cid'];
    $name =  $_POST['name'];
    $phoneno =  $_POST['phoneno'];
    $address = $_POST['address'];
    $cnic = $_POST['cnic'];
    $b_amount = $_POST['b_amount'];
    $a_amount = $_POST['a_amount'];
    $c_type = $_POST['c_type'];
    $refer_by = $_POST['refer_by'];
    $raddress = $_POST['raddress'];
    $rcnic = $_POST['rcnic'];
   $sql = "UPDATE `customers` SET `name`='$name',`phoneno`='$phoneno',`address`='$address',`cnic`='$cnic' ,`b_amount`='$b_amount',`a_amount`='$a_amount',
   `c_type`='$c_type' ,`refer_by`='$refer_by',`raddress`='$raddress',`rcnic`='$rcnic'  WHERE id='$cid'";
   $up=mysqli_query($conn, $sql);
       if($up){
           echo "<script> alert('Customer Details is Updated Successfully!');window.location.href='customers.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">گاهک</h1>
<button class='btn btn-success mr-2'  data-toggle="modal" data-target="#AddempModal">نیا گاہک شامل کریں</button>
<a class='btn btn-info mr-2'  href='customer_borrow.php'> گاهک کا قرض شامل کریں</a>
<a class='btn btn-primary mr-2'  href='borrow_payment.php'> قرض کی ادائیگی شامل کریں</a>
<a class='btn btn-danger mr-2 float-right'  data-toggle="modal" data-target="#repModal" >
<i class="fas fa-download text-white-50" ></i> رپورٹ تیار کریں</a><br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">گاهک</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>نام</th>
                        <th>فون نمبر</th>
                        <th>پتہ</th>
                        <th>CNIC</th>
                        <th>قرضے کی رقم</th>
                        <th>ایڈوانس رقم</th>
                        <th>کسٹمر کی قسم</th>
                        <th>حوالہ نام </th>
                        <th>حوالہ پتہ </th>
                        <th>حوالہ cnic </th>
                        <th class="<?php echo $dadmin?>">عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                        <td><?php echo $out['name']?></td>
                        <td><?php echo $out['phoneno']?></td>
                        <td><?php echo $out['address']?></td>
                        <td><?php echo $out['cnic']?></td>
                        <td><?php echo $out['b_amount']?></td>
                        <td><?php echo $out['a_amount']?></td>
                        <td><?php echo $out['c_type']?></td>
                        <td><?php echo $out['refer_by']; ?></td>
                        <td><?php echo $out['raddress']; ?></td>
                        <td><?php echo $out['rcnic']; ?></td>
                        <td class="<?php echo $dadmin?>">    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['name']?>','<?php echo $out['phoneno']?>','<?php echo $out['cnic']?>'
                            ,'<?php echo $out['address']?>' ,'<?php echo $out['c_type']?>' ,'<?php echo $out['refer_by']?>' ,'<?php echo $out['raddress']?>','<?php echo $out['rcnic']?>'  ,'<?php echo $out['b_amount']?>','<?php echo $out['a_amount']?>'
                             )" data-toggle="modal" data-target="#editModal">
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
                        <input type="hidden" name="cid2" id="cid2">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="del" class="btn btn-danger" value="Yes, Delete">
                    </form>
                </div>
            </div>
        </div>
    </div> 
 <!-- Add customer Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نیا گاہک شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="text" name="name" class=" form-control form-control-user" placeholder="گاہک کا نام درج کریں" required> <br>
                        <input type="tel" name="phoneno" class=" form-control form-control-user"  pattern="[0]{1}[3]{1}[0-9]{9}"
                         placeholder=" گیارہ (11) ہندسوں کا فون نمبر درج کریں" title="03XXXXXXXXX" required>  <br>
                         <input type="text" name="address" class=" form-control form-control-user" placeholder=" گاہک کا پتہ" required> <br>
                         <input type="text" name="cnic"  pattern="[0-9]{13}" class=" form-control form-control-user" placeholder=" نمبر درج کریں CNIC تیرہ ہندسوں کا" required> 
                       
                       <div class="row">
                        <div class="col-md-6">
                        <label for="customer" >کسٹمر کی قسم:</label>
                        <select name="c_type" id="" class=" form-control " >
                        <option value="short term">Short Term</option>
                          <option value="long term">Long Term</option>
                        </select> 
                         <input type="text" class=" form-control form-control-user mt-4" name="refer_by" Placeholder='حوالہ نام دیں'>
                
                            </div> 
                            <div class="col-md-6">
                        <input type="text" name="raddress" class=" form-control form-control-user mt-4" placeholder="حوالہ کا پتہ" required>
                            <input type="text" name="rcnic" pattern="[0-9]{13}" class=" form-control form-control-user mt-3" placeholder="cnic حوالہ" required> <br>
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
                    <h5 class="modal-purpose" id="exampleModalLabel">کسٹمر کی تفصیلات کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="cid" id='cid'  >
                    <input type="text" name="name" id='name' class=" form-control form-control-user" placeholder="گاہک کا نام درج کریں" required> <br>
                        <input type="tel" name="phoneno" id="phoneno" class=" form-control form-control-user"  pattern="[0]{1}[3]{1}[0-9]{9}"
                         placeholder=" گیارہ (11) ہندسوں کا فون نمبر درج کریں" title="03XXXXXXXXX" required>  <br>
                         <input type="text" id="address" name="address"  class=" form-control form-control-user" placeholder=" گاہک کا پتہ" required> <br>
                         <input type="text" id="cnic" name="cnic"  pattern="[0-9]{13}" class=" form-control form-control-user" placeholder=" نمبر درج کریں CNIC تیرہ ہندسوں کا" required> 
                       
                       <div class="row">
                        <div class="col-md-6">
                        <label for="customer" >کسٹمر کی قسم:</label>
                        <select name="c_type" id="c_type" class=" form-control " >
                        <option value="short term">Short Term</option>
                          <option value="long term">Long Term</option>
                        </select>
                        <label for=""> حوالہ کا نام</label>
                         <input type="text" class=" form-control form-control-user " name="refer_by" id="refer_by"  Placeholder='حوالہ نام دیں'>
                         <label for=""> cnic حوالہ</label>
                            <input type="number" step="0.01"name="rcnic" id="rcnic" pattern="[0-9]{13}" title="CNIC MUST CONTAIN 13 digits" class=" form-control form-control-user " placeholder="cnic حوالہ" required> <br>
                            </div> 
                            <div class="col-md-6">
                            <label for="">قرضے کی رقم</label>
                             <input type="number" step="0.01"id='b_amount2' name="b_amount" class=" form-control form-control-user " min='0' placeholder="قرضے کی رقم" >
                             <label for="">ایڈوانس رقم</label>
                             <input type="number" step="0.01"id='a_amount' name="a_amount" class=" form-control form-control-user " min='0' placeholder="ایڈوانس رقم" >
                            <label for=""> حوالہ کا پتہ</label>
                             <input type="text" name="raddress" id="raddress" class=" form-control form-control-user " placeholder="حوالہ کا پتہ" required>
                          
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
     <!--Customer Report Modal-->
  <div class="modal fade" id="repModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">کسٹمر رپورٹ تیار کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center ">
              <h6>  گاہک کو تلاش کریں   </h6>
              <form action="customer_report.php" method="get" >
              <input type="text" class="form-control" name="customer" id="customer" placeholder="نام / فون نمبر / CNIC" onkeyup="GetCustomer(this.value)">
              <label for=""> Customer:</label>
              <input type="text" name="cust" class="form-control" id="cust" readonly>
             <input type="hidden" name="cid" id="custid">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                    <button class="btn btn-danger" type="submit" formtarget="_blank">Generate Report</button>
                    <!-- <input type="submit" name="del" class="btn btn-danger" value="Generate Report"> -->
                    </form>
                </div>
            </div>
        </div></div>
<?php include "footer.php"?>

</div>
<script>

    function GetEModal(cid,name,phoneno,cnic,address,c_type,refer_by,raddress,rcnic,b_amount,a_amount) {
     
    document.getElementById("cid").value=cid ;
    document.getElementById("name").value =name;
    document.getElementById("phoneno").value =phoneno;
    document.getElementById("address").value =address;
    document.getElementById("c_type").value =c_type;
    document.getElementById("cnic").value =cnic;
    document.getElementById("refer_by").value =refer_by;
    document.getElementById("raddress").value =raddress;
    document.getElementById("rcnic").value =rcnic;
    document.getElementById("a_amount").value =a_amount; 
    document.getElementById("b_amount2").value =b_amount;
   

}
function GetdelModal(cid) {
    document.getElementById("cid2").value=cid ;

}

function CAlBorrow(cid) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("cid").value =
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