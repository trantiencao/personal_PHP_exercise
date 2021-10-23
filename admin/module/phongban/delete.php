<?php session_start();
error_reporting(0);
$title = 'Xóa phòng ban'; ?>
<?php
    $open = "phongban";
    require ("../../autoload/autoload.php");
        $id= $_GET['MAPHONG'];
        $query ="DELETE FROM `phongban` WHERE phongban.MAPHONG='$id'";
        $resultd= mysqli_query($connect,$query);

        if($resultd)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/personal_PHP_exercise/admin/module/phongban/index.php');
        }
?>