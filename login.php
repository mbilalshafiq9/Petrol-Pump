
<?php include "db.php";
include "header.php";
$error='d-none';
error_reporting(0);
if(isset($_POST['submit']))
  {
    $phoneno =  $_POST['phoneno'];
    $password = $_POST['password'];
    $v_data = "SELECT * FROM users WHERE phoneno = '$phoneno'  and Password = '$password'";
    $result = mysqli_query($conn,$v_data);
    $final = mysqli_fetch_assoc($result);
    $name=$final['name'];
     $phoneno=$final['phoneno'];
        if(mysqli_num_rows($result)>0)
        {session_start();
            $_SESSION['phoneno']=$phoneno;
            $_SESSION['name']=$name;
          echo "<script> alert('Congratulations $name! you are successfully login.');window.location.href='index.php' </script>";
           
        }
    else{ $error="d-block";
       $msg="Email and Password not matched. Try Again";
    }
}
?>
?>
<body class="bg-gradient-primary">
    <div class="bg-color">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
            <h1 class='text-light text-center mt-5'>پٹرول پمپ مینجمنٹ سسٹم </h1> 
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="img/login.jpg" width="550" class='mt-5 pt-5'alt="" srcset="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-3">!خوش آمدید   </h1>
                                        <h5 class='mb-3'>آپ کے اکاؤنٹ میں لاگ ان کریں</h5>
                                    </div>
                                     <!--Display error message -->
            <h6 class=" text-danger p-3   <?php echo $error ?> " style="background-color:rgba(255,0,0,0.1)">*  <?php echo $msg ?> *
                </h6>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="tel"  pattern="[0]{1}[3]{1}[0-9]{9}" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="phoneno"
                                                placeholder=" گیارہ (11) ہندسوں کا فون نمبر درج کریں" title="03XXXXXXXXX" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="exampleInputPassword" placeholder="پاس واڈ"  pattern=".{8,}" required  title="پاس واڈ میں 8 حرف ہوں">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">یاد رکھنا
                                                    مجھے</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" value="لاگ ان کریں" href="index.html" class="btn btn-primary btn-user btn-block">
                                      </form>
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">?پاسورڈ بھول گے</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>