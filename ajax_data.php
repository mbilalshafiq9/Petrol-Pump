<?php
include "db.php";
//Get Borrow price of customer borrow_payment.php
if(isset($_GET['cid'])){
  $cid=$_GET['cid'];
 $sql = mysqli_query($conn, "SELECT * FROM customers where id='$cid'");
 $result = mysqli_fetch_assoc($sql);
    echo $result['b_amount'];
}
//Get Borrow price of Owner borrow_payment.php
if(isset($_GET['oid'])){
  $oid=$_GET['oid'];
 $sql = mysqli_query($conn, "SELECT * FROM owners where id='$oid'");
 $result = mysqli_fetch_assoc($sql);
    echo $result['b_amount'];
}
//Get Borrow price of customer borrow_payment.php
if(isset($_GET['b_liters'])){
  $cid=$_GET['b_liters'];
 $sql1 = mysqli_query($conn, "SELECT * FROM customers where id='$cid'");
 $result1 = mysqli_fetch_assoc($sql1);
    echo $result1['b_liters'];
}// Get Borrow Pr-Liter in borrow_payment.php
if(isset($_GET['pr_liter'])){
  $cid=$_GET['pr_liter'];
 $sql2 = mysqli_query($conn, "SELECT * FROM customers where id='$cid'");
 $result2 = mysqli_fetch_assoc($sql2);
    echo $result2['pr_liter'];
}
//Get Petrol Type in sale.php
if(isset($_GET['ptr_type'])){
 $ptr_type=$_GET['ptr_type'];
 $meterno=$_GET['meterno'];
 $sql1 = mysqli_query($conn, "SELECT * FROM meters where meterno='$meterno' and ptrol_type='$ptr_type' ");
 $result1 = mysqli_fetch_assoc($sql1);
    echo $result1['c_reading'];
    
}
//Get Petrol Type in sale.php
if(isset($_GET['ptr_type2'])){
  $ptr_type=$_GET['ptr_type2'];
  $sql3= mysqli_query($conn, "SELECT * FROM stock where  petrol_type='$ptr_type' ");
  $result3 = mysqli_fetch_assoc($sql3);
     echo $result3['dip'];
     
 }
//Get Phone No in Account.php
if(isset($_GET['phoneno'])){
  $phoneno=$_GET['phoneno'];
  $v_email = "SELECT 1 FROM users WHERE phoneno = '$phoneno'";
	$result = mysqli_query($conn,$v_email);
	if(mysqli_num_rows($result)>0)
	{
	echo	$msg = 'Phone no already exists';
  }
}
 //Get Stock Quantity No in Stock_SAle.php
if(isset($_GET['sid'])){
  $sid=$_GET['sid'];
  $nsql= mysqli_query($conn, "SELECT * FROM stock2 where  id='$sid' ");
  $nresult = mysqli_fetch_assoc($nsql);
     echo $nresult['quantity'];
 }
  //Get Stock Price No in Stock_SAle.php
 if(isset($_GET['quantity'])){
  $quantity=$_GET['quantity'];
  $sid=$_GET['sid'];
  $sql5= mysqli_query($conn, "SELECT * FROM stock2 where  id='$sid' ");
  $result5 = mysqli_fetch_assoc($sql5);
    $amount=$result5['amount'];
 echo $tamount=$quantity*$amount;

 }
  //Get Customer in customer report
  if(isset($_GET['cname'])){
    $cname=$_GET['cname'];
    $sql6= mysqli_query($conn, "SELECT * FROM customers where  name LIKE '$cname%' OR phoneno LIKE '$cname%' OR cnic LIKE '$cname%' ");
    $result6 = mysqli_fetch_assoc($sql6); $name[0]=$result6['id'];
    $name[1]=$result6['name'];
    echo json_encode($name);
  
   }
     //Get Owner in owner report
  if(isset($_GET['oname'])){
    $oname=$_GET['oname'];
    $sql6= mysqli_query($conn, "SELECT * FROM owners where  name LIKE '$oname%' OR phoneno LIKE '$oname%' OR cnic LIKE '$oname%' ");
    $result6 = mysqli_fetch_assoc($sql6); $name[0]=$result6['id'];
    $name[1]=$result6['name'];
    echo json_encode($name);
  
   }
?>