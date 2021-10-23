<?php session_start();
error_reporting(0);
$title = 'Thêm loại nhân viên'; ?>
<?php
$open = "loainhanvien";
require("../../autoload/autoload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && $_POST['name'] != NULL && isset($_POST['ma']) && $_POST['ma'] != NULL) {
        $name = $_POST['name'];
        $ma = $_POST['ma'];
        $query = "INSERT INTO `loainhanvien`(`MALOAINV`,`TENLOAINV`) VALUES ('$ma','$name')";
        $result = mysqli_query($connect, $query);
        if ($result) {
            $_SESSION['success'] = 'Thêm mới thành công';
            redirectUrl('/personal_PHP_exercise/admin/module/loainhanvien/index.php');
        }
    } else
        echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
}
?>

<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Thêm Mới Danh Mục</h1>
<div class="col-md-12">
    <form action="" method="POST">
        <div class="form-group">
        <label for="exampleInputEmail1">Mã loại nhân viên</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Vui lòng nhập tên danh mục vào đây" name="ma">
            <label for="exampleInputEmail1">Tên Loại nhân viên</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Vui lòng nhập tên danh mục vào đây" name="name">
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
<?php require("../../layout/footer.php"); ?>