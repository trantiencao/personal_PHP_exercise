<?php session_start();
error_reporting(0);
$title = 'Xóa loại nhân viên'; ?>
<?php
    $open = "loainv";
    require ("../../autoload/autoload.php");
        $id= $_GET['id'];
        $query ="DELETE FROM `loainv` WHERE loainv.MALOAINV=$id";
        $resultd= mysqli_query($connect,$query);

        if($resultd)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/personal_PHP_exercise/admin/module/loainv/index.php');
        }
?>