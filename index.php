<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/admin/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">
</head>

<?php
session_start();
error_reporting(0);
require("admin/autoload/autoload.php"); // kết nối dữ liệu
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) header("location: admin/");
else {
    header("location: ");
}

if (isset($_POST["btn_submit"])) {
    // lấy thông tin người dùng
    $email = $_POST["email"];
    $password = $_POST["password"];
    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection

    if ($email == "" || $password == "") {
        echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ các trường!');</script>";
    } else {
        $sql = "select * from user where email = '$email' and password = '$password'";
        $query = mysqli_query($connect, $sql); 
        $num_rows = mysqli_num_rows($query);

        if ($num_rows == 0) {
            echo "<script type='text/javascript'>alert('Tên đăng nhập hoặc mật khẩu không đúng!');</script>";
        } else {
            // Lấy ra thông tin người dùng và lưu vào session
            while ($data = mysqli_fetch_array($query)) {
                $_SESSION["email"] = $data["email"];
                $_SESSION["password"] = $data["password"];
                $_SESSION["name"] = $data["name"];
                $_SESSION["login"] = true;
            }
            // Thực thi hành động sau khi lưu thông tin vào session
            header("location: admin/");
        }
    }
}
?>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background: url('https://comdy.vn/content/images/2020/05/php-26.jpg'); background-position: center;
  background-size: cover;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter Email Address..." value="<?php if (isset($_POST['email'])) echo $_POST['email'];
                                                                                                                                                                                                                    else echo ""; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary btn-user btn-block" type="submit" name="btn_submit" value="Login">
                                        <hr>
                                        <a href="#" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
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
    <script src="public/admin/vendor/jquery/jquery.min.js"></script>
    <script src="public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/admin/js/sb-admin-2.min.js"></script>

</body>


</html>