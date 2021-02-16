<?php  session_start(); include "db.php";
include "header.php";
$data = mysqli_query($conn, "SELECT * FROM expenses ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);

$phoneno=$_SESSION['phoneno'];
$mysql = mysqli_query($conn, "SELECT * FROM users where phoneno=$phoneno and role='admin' ");
$print = mysqli_fetch_assoc($mysql);
if(!$print){
   $dadmin='d-none';
}else{  $dadmin='';}
//Add new expense Form Submit
if(isset($_POST['add']))
  {  
     $title =  $_POST['title'];
    $description =  $_POST['description'];
    $amount = $_POST['amount'];
    $date= $_POST['date'];
    $insert = mysqli_query($conn,"INSERT INTO `expenses`(`title`, `description`,`amount`,`date`)
	VALUES('$title','$description','$amount','$date')");
     if($insert){
        echo "<script> alert('Expense is Added Successfully!');window.location.href='expenses.php' </script>";
    }
}
 //Delete expense
  if(isset($_POST['del']))
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM expenses WHERE id='$id'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('Expense is Deleted Successfully!');window.location.href='expenses.php' </script>";
        }
 }
 //UPDATE Expenses
 if(isset($_POST['up']))
 { $eid =  $_POST['eid'];
    $title =  $_POST['title'];
    $description =  $_POST['description'];
    $amount = $_POST['amount'];
    $date= $_POST['date'];
    $sql = "UPDATE `expenses` SET `title`='$title',`description`='$description',`amount`='$amount' ,`date`='$date'  WHERE id='$eid'";
    $del=mysqli_query($conn, $sql);
        if($del){
            echo "<script> alert('expense Details is Updated Successfully!');window.location.href='expenses.php' </script>";
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
<h1 class="h3 mb-2 text-gray-800">اخراجات</h1>
<button class='btn btn-success mr-2'  data-toggle="modal" data-target="#AddempModal">نیا خرچ شامل کریں</button> <br><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">اخراجات</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>اخراجات کا عنوان</th>
                        <th>تفصیل</th>
                        <th>رقم</th>
                        <th>تاریخ</th>
                        <th class='<?php echo $dadmin?>'>عمل</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach($output as $out) {?>
                    <tr>
                        <td><?php echo $out['title']?></td>
                        <td><?php echo $out['description']?></td>
                        <td><?php echo $out['amount']?></td>
                        <td><?php echo $out['date']?></td>
                      
                        <td class='<?php echo $dadmin?>'>    <a href="#" class="btn btn-warning btn-circle"  onclick="GetEModal('<?php echo $out['id']?>','<?php echo $out['title']?>','<?php echo $out['description']?>'
                            ,'<?php echo $out['amount']?>','<?php echo $out['date']?>')" data-toggle="modal" data-target="#editModal">
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
                    <h5 class="modal-title" id="exampleModalLabel">کیا آپ واقعی حذف کرنا چاہتے ہیں؟!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center ">
                <i class="fas fa-exclamation-triangle btn-warning btn-lg  btn-circle"></i> <br>
                حذف پر کلک کرنے کے بعد آپ اس اخراجات کو واپس نہیں کرسکتے ہیں۔
                    نیز نظام سے متعلق معلومات کے اخراجات بھی ختم ہوجائیں گے
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
 <!-- Add expense Modal-->
 <div class="modal fade" id="AddempModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نیا خرچ شامل کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="text" name="title" class=" form-control form-control-user" placeholder="اخراجات کا عنوان درج کریں" required> <br>
                        <input type="text" name="description" class=" form-control form-control-user"  
                         placeholder="تفصیل درج کریں" >  <br>
                         <div class="row">
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="amount" class=" form-control form-control-user " placeholder="اخراجات کی رقم" required> <br>
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
                    <h5 class="modal-title" id="exampleModalLabel">ادھار کی رقم کو اپ ڈیٹ کریں</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                    <input type="hidden" name="eid" id="eid">
                    <input type="text" name="title" id="title" class=" form-control form-control-user" placeholder="Enter Expense Title" required> <br>
                        <input type="tel" name="description"  id="description" class=" form-control form-control-user"  
                         placeholder="Enter description" >  <br>
                         <div class="row">
                            <div class="col-md-6">
                            <input type="number" step="0.01"name="amount" id="amount"  class=" form-control form-control-user " placeholder=" Expense Amount" required> <br>
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

function GetEModal(eid,title,description,amount,date) {
    document.getElementById("eid").value=eid ;
    document.getElementById("title").value =title;
    document.getElementById("description").value =description;
    document.getElementById("amount").value =amount;
    document.getElementById("date").value =date;
}

</script>

</div>