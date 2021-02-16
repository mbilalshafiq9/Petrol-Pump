<?php include "db.php";
include "header.php";
error_reporting(0);
$data = mysqli_query($conn, "SELECT * FROM stock ");
$output = mysqli_fetch_all($data,MYSQLI_ASSOC);
$stock = mysqli_query($conn, "SELECT * FROM stock_purchase where p_type='diesel' ORDER BY id DESC LIMIT 1");
$stockp = mysqli_fetch_assoc($stock);
$stock2 = mysqli_query($conn, "SELECT * FROM stock_purchase where p_type='petrol' ORDER BY id DESC LIMIT 1");
$stockp2 = mysqli_fetch_assoc($stock2);
$result=mysqli_query($conn, "SELECT * FROM users ");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
$tamount=0;$tamount2=0;  $cmonth=date('m');
$data2 = mysqli_query($conn, "SELECT * FROM employee_sale where month(date)='$cmonth'");
 $output2 = mysqli_fetch_all($data2,MYSQLI_ASSOC);
 foreach($output2 as $out2){
    $tamounta=$tamounta+$out2['t_amount'];
}$datan = mysqli_query($conn, "SELECT * FROM stock_sale where month(date)='$cmonth'");
$outputn = mysqli_fetch_all($datan,MYSQLI_ASSOC);
foreach($outputn as $outn){
   $tamountb=$tamountb+$outn['tamount'];
}
$tamount=$tamounta+$tamountb;
$cyear=date('Y');
$data3 = mysqli_query($conn, "SELECT * FROM employee_sale where year(date)='$cyear'");
 $output3 = mysqli_fetch_all($data3,MYSQLI_ASSOC);
 foreach($output3 as $out3){
    $tamount2a=$tamount2+$out3['t_amount'];
}
$datan2 = mysqli_query($conn, "SELECT * FROM stock_sale where year(date)='$cyear'");
 $outputn2 = mysqli_fetch_all($datan2,MYSQLI_ASSOC);
 foreach($output2 as $outn2){
    $tamount2b=$tamount2+$outn2['tamount'];
}
$tamount2=$tamount2a+$tamount2b;
$data4 = mysqli_query($conn, "SELECT * FROM employees ");
$rows4=mysqli_num_rows($data4);
$data6 = mysqli_query($conn, "SELECT * FROM customers  ");
$output6=mysqli_fetch_all($data6,MYSQLI_ASSOC); 
foreach($output6 as $out6){
    $bamount=$bamount+$out6['b_amount'];
}
$result=mysqli_query($conn, "SELECT * FROM users ");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
session_start();
$phoneno=$_SESSION['phoneno'];
$name=$_SESSION['name'];
if($_SESSION['phoneno']==true){
$result1 = mysqli_query($conn,"SELECT * FROM users WHERE phoneno = '$phoneno'");
$final=mysqli_fetch_assoc($result1);
}
else{
    echo "<script> alert('Error! you need to login First ');window.location.href='login.php' </script>";
}
// Queries For Sale Overview
for( $z=0; $z<=12; $z++){$mamount=0;
$sql = mysqli_query($conn, "SELECT * FROM employee_sale where month(date)='$z'");
$result2=mysqli_fetch_all($sql,MYSQLI_ASSOC); 
if($result2){
foreach($result2 as $res2){  $mamount=$mamount+$res2['t_amount'];
   echo" <input type='hidden' name='month' id='month$z' value='$mamount'>";
} }
else{  echo" <input type='hidden' name='month' id='month$z' value='0'>"; }
}

?>
<?php $i=1; foreach($output as $out) {?>
    <input type="hidden" name="liter" id="l<?php echo $i++;?>" value="<?php echo $out['dip']?>">
<?php }?>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">ڈیش بورڈ</h1>
                
                        <a href="" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm " 
                        data-toggle="modal" data-target="#repModal" style="margin-inline-start:auto"><i
                                class="fas fa-download fa-sm text-white-50" ></i> رپورٹ تیار کریں</a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="ReportDropdown">
            <a class="dropdown-item" href="report.php?rep=daily" target="_blank">  روزانہ</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="report.php?rep=monthly" target="_blank"> ماہانہ</a>
        </div>   <a href="create_backup.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm float-right" ><i
                                class="fas fa-download fa-sm text-white-50" ></i> ڈیٹا بیس بیک اپ بنائیں</a>
                    </div>
                 
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            کل فروخت (ماہانہ)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. <?php echo $tamount?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            کل فروخت (سالانہ)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. <?php echo $tamount2?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            کل ادھار </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. <?php echo $bamount?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            کل ملازم</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $rows4?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary">فروخت کا جائزہ</h5>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary">ڈپ</h5>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
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
                        <!-- Content Row -->

                        <div class="row">

<!-- Area Chart -->
<div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">(Diesel)فروخت کا جائزہ</h5>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>پچھلا ڈپ خریداری</th>
                        <th> Pr/liter</th>
                        <th> Total Cost</th>
                    </tr>
                </thead>
              
                <tbody>
                 
                    <tr>
                        <td><?php echo $dipp=$stockp['dip'] ?> liters </td>
                        <td><?php echo $pr=$stockp['pr_lt'] ?> Rs/liter </td>
                        <td> Rs. <?php echo $dpt=$dipp*$pr; ?>  </td></tr>
                        <tr class='bg-light '>
                        <th>Dip Sale</th>
                        <th>Pr/liter </th>
                        <th>Total Amount </th></tr>
                      <?php 
                            $sale = mysqli_query($conn, "SELECT * FROM employee_sale where petrol_type='diesel' order by id desc");
                            $outputf = mysqli_fetch_all($sale,MYSQLI_ASSOC);  
                            foreach($outputf as $outf){$salep=0;
                                $salep=$salep+$outf['liters'];
                               if($dipp > $salep) { 
                              echo "  <tr> <td>   $outf[liters] liters </td>
                              <td> $outf[pr_lt] Rs/liter </td>  ";   $tp=$outf['liters']*$outf['pr_lt'];
                                echo " <td>Rs.  $tp </td>   </tr>"; 
                               $dipp=$dipp-$salep; $ftp=$ftp+$tp;
                            }
                            else{   echo  "<tr> <td>  $dipp liters </td> <td>  $outf[pr_lt] Rs/liter</td>";$tpr=$dipp*$outf['pr_lt'];
                                echo " <td>Rs.  $tpr  </td> </tr>" ; break;}
                        } ?>
                        <tr> <td><h5> <?php echo "Total Selling Price: Rs. "; echo $overt=$ftp+$tpr;?> </h5></td>
                        <td colspan='2'><h5> <?php echo "Profit/Loss: Rs. "; echo $overt- $dpt;?> </h5></td></tr>
                   
                </tbody>
            </table>
        </div>
        </div>  </div>  </div>
    <div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">(Petrol)فروخت کا جائزہ</h5>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class='bg-light '>
                        <th>پچھلا ڈپ خریداری</th>
                        <th> Pr/liter</th>
                        <th> Total Cost</th>
                    </tr>
                </thead>
              
                <tbody>
                 
                <tr>
                        <td><?php echo $dipp=$stockp2['dip'] ?> liters </td>
                        <td><?php echo $pr=$stockp2['pr_lt'] ?> Rs/liter </td>
                        <td> Rs. <?php echo $dpt=$dipp*$pr; ?>  </td></tr>
                        <tr class='bg-light '>
                        <th>Dip Sale</th>
                        <th>Pr/liter </th>
                        <th>Total Amount </th></tr>
                      <?php 
                            $sale = mysqli_query($conn, "SELECT * FROM employee_sale where petrol_type='petrol' order by id desc");
                            $outputf = mysqli_fetch_all($sale,MYSQLI_ASSOC);  
                            foreach($outputf as $outf){$salep=0;
                                $salep=$salep+$outf['liters'];
                               if($dipp > $salep) { 
                              echo "  <tr> <td>   $outf[liters] liters </td>
                              <td> $outf[pr_lt] Rs/liter </td>  ";   $tp=$outf['liters']*$outf['pr_lt'];
                                echo " <td>Rs.  $tp </td>   </tr>"; 
                               $dipp=$dipp-$salep; $ftp2=$ftp2+$tp;
                            }
                            else{   echo  "<tr> <td>  $dipp liters </td> <td>  $outf[pr_lt] Rs/liter</td>";$tpr2=$dipp*$outf['pr_lt'];
                                echo " <td>Rs.  $tpr2  </td> </tr>" ; break;}
                        } ?>
                        <tr> <td><h5> <?php echo "Total Selling Price: Rs. "; echo $overt2=$ftp2+$tpr2;?> </h5></td>
                        <td colspan='2'><h5> <?php echo "Profit/Loss: Rs. "; echo $overt2- $dpt;?> </h5></td></tr>
                      

                 
                   
                </tbody>
            </table>
        </div>
        </div> </div> 
        </div> </div> 
                
                <!-- /.container-fluid -->
  <!--Custom Report Date/Month Modal-->
  <div class="modal fade" id="repModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">روزانہ / ماہانہ رپورٹ تیار کریں!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center ">
              <h6> روزانہ / ماہانہ </h6>
              <form action="report.php" method="get" >
              <select name="rep" id="" class='form-control' >
              <option value="daily">Daily</option>
              <option value="monthly">Monthly</option></select><br>
              <input type="date" name="date" id="date" class='form-control' required> 
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                    <button class="btn btn-danger" type="submit" formtarget="_blank">Generate Report</button>
                    <!-- <input type="submit" name="del" class="btn btn-danger" value="Generate Report"> -->
                    </form>
                </div>
            </div>
        </div>
            </div>
            <!-- End of Main Content -->
      

            <?php include "footer.php"?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <script>
    // GetDM('daily');
    function GetDM(rep){
        if( rep.match('daily')){
            document.getElementById("month").classList.add("d-none");
            document.getElementById("date").classList.remove("d-none");
        }
        else {
            document.getElementById("month").classList.remove("d-none");
            document.getElementById("date").classList.add("d-none");
         }
    }
    </script>
    <!-- End of Page Wrapper -->

  