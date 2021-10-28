<?php session_start();
error_reporting(0);
$title = 'Sửa phòng ban'; ?>
<?php
$open = "phongban";
require("../../autoload/autoload.php");

$id = $_GET['MAPHONG'];
$query = "SELECT * FROM `phongban` WHERE phongban.MAPHONG = '$id'";
$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)) {
    $maold = $row['MAPHONG'];
    $nameold = $row['TENPHONG'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && $_POST['name'] != NULL && isset($_POST['ma']) && $_POST['ma'] != NULL) {
        $ma = $_POST['ma'];
        $name = $_POST['name'];
        $query = "UPDATE `phongban` SET `MAPHONG`='$ma',`TENPHONG`='$name' WHERE phongban.MAPHONG= '$id'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            if ($name == $nameold) {
                $_SESSION['success'] = 'Không có gì thay đổi';
                redirectUrl('/personal_PHP_exercise/admin/module/phongban/index.php');
            } else {
                $_SESSION['success'] = 'Cập nhật thành công';
                redirectUrl('/personal_PHP_exercise/admin/module/phongban/index.php');
            }
        }
    } else
        echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
}
?>

<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Sửa Phòng ban</h1>
<div class="col-md-12">
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Mã Phòng ban</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="ma" value="<?php echo $maold ?>">
            <label for="exampleInputEmail1">Tên Phòng ban</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $nameold ?>">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
<?php require("../../layout/footer.php"); ?>