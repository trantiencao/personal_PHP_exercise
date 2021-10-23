<?php session_start();
error_reporting(0);
$title = 'Sửa loại nhân viên'; ?>
<?php
    $open = "loainv";
     require ("../../autoload/autoload.php");

     $id= $_GET['id'];
     $query = "SELECT * FROM `loainv` WHERE loainv.MALOAINV = $id";
     $result = mysqli_query($connect, $query);

     while($row = mysqli_fetch_array($result))
     {
        $maold=$row['MALOAINV'];
         $nameold=$row['TENLOAINV'];
     }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['name']) && $_POST['name'] != NULL && isset($_POST['ma']) && $_POST['ma'] != NULL)
        {
            $name = $_POST['name'];
            $ma = $_POST['ma'];
            $query = "UPDATE `loainv` SET `TENLOAINV`='$name', `MALOAINV`='$ma' WHERE loainv.MALOAINV=$id";
            $result = mysqli_query($connect, $query);
            
            if($result)
            {
                if($name == $nameold)
                {
                    $_SESSION['success'] = 'Không có gì thay đổi';
                    redirectUrl('/qlbanlinhkienmaytinh/admin/module/loainv/index.php');
                }
                else
                {
                    $_SESSION['success'] = 'Cập nhật thành công';
                    redirectUrl('/qlbanlinhkienmaytinh/admin/module/loainv/index.php');
                }
            }
        }
        else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
    }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Sửa Loai nhân viên</h1>
                    <div class="col-md-12">
                        <form action="" method="POST">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Mã loại</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="ma" value="<?php echo $maold?>" >
                                <label for="exampleInputEmail1">Tên loại</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $nameold?>" >
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>