<?php session_start();
error_reporting(0);
$title = 'Xóa nhân viên'; ?>
<?php
    $open = "nhanvien";
    require ("../../autoload/autoload.php");
    $id= $_GET['id'];
    $query ="DELETE FROM `nhanvien` WHERE nhanvien.MANV=$id";
    $resultd= mysqli_query($connect,$query);

        if($resultd)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/personal_PHP_exercise/admin/module/nhanvien/index.php');
        }
?>