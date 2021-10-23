<?php session_start();
error_reporting(0); 
$title = 'Thêm nhân viên';?>
<?php
$open = "nhanvien";
require("../../autoload/autoload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['MA']) && !empty($_POST['HO']) && !empty($_POST['TEN']) && !empty($_POST['NS'])  && !empty($_POST['GT']) && !empty($_POST['DC']) && !empty($_POST['fileUpload']) && !empty($_POST['loainv']) && !empty($_POST['phongban'])) {
        $MA = $_POST['MA'];
        $HO = $_POST['HO'];
        $TEN = $_POST['TEN'];
        $NS = $_POST['NS'];
        $GT = $_POST['GT'];
        $DC = $_POST['DC'];
        $ANH = $_POST['fileUpload'];
        $LOAINV = $_POST['loainv'];
        $PHONGBAN = $_POST['phongban'];

        /* Upload file */
        if ($_FILES['fileUpload']['name'] != null) {
            //Bước 1: Tạo đường dẫn upload file ảnh
            $target_dir = "../../../public/uploads/anhnhanvien/";
            //Bước 2: kiểm tra file hình ảnh và thực hiện upload file
            $ten_hinh = $_FILES['fileUpload']['name'];
            $type = $_FILES['fileUpload']['type'];
            $size = $_FILES['fileUpload']['size'];
            $tmp = $_FILES['fileUpload']['tmp_name'];
            if (($type == 'image/jpeg' || ($type == 'image/jpg') || ($type == 'image/png') && $size < 8000)) {
                move_uploaded_file($tmp, $target_dir . $ten_hinh);
            }
        }

        $query = "INSERT INTO `nhanvien`(`MANV`,`HO`,`TEN`,`NGAYSINH`,`GIOITINH`,`DIACHI`,`ANH`,`MALOAINV`,`MAPHONG`) VALUES ('$MA','$HO','$TEN','$NS','$GT','$DC','$ANH','$LOAINV','$PHONGBAN')";
        $result = mysqli_query($connect, $query);
        $_SESSION['success'] = 'Thêm mới thành công';
        redirectUrl('/personal_PHP_exercise/admin/module/nhanvien/index.php');
    } else {
        echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
    }
}
?>

<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Thêm Mới Nhân viên</h1>
<div class="col-md-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">MÃ NV</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="MA" value="<?php echo $MA ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Họ NV</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="HO" value="<?php echo $HO ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tên NV</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="TEN" value="<?php echo $TEN ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ngày sinh</label>
            <input type="date" class="form-control" id="exampleInputEmail1" name="NS" value="<?php echo $NS ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Giới tính</label>
            <select class="form-control" id="exampleInputEmail1" name="GT">
                <?php $selected = $GT; ?>
                <option value="Nam" <?php if ($selected == 'Nam') echo 'selected'; ?>>Nam</option>
                <option value="Nữ" <?php if ($selected == 'Nữ') echo 'selected'; ?>>Nữ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Địa chỉ</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="DC" value="<?php echo $DC ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ảnh</label>
            <input class="form-control-file" type="file" class="form-control" name="fileUpload" id="fileUpload" value="<?php echo $ANH; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Loại nhân viên</label>
            <select class="form-control" name="loainv">
                <?php
                $query1 = "SELECT * FROM loainv";
                $result = mysqli_query($connect, $query1);
                while ($row = mysqli_fetch_array($result)) {
                    $LOAINV = $row[0];
                    echo "<option value='$LOAINV' ";
                    if (isset($_REQUEST['loainv']) && $_REQUEST['loainv'] == $LOAINV) echo 'selected';
                    echo ">$row[1]</option>";
                }
                mysqli_free_result($result);
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phòng ban</label>
            <select class="form-control" name="phongban">
                <?php
                $query2 = "SELECT * FROM phongban";
                $result = mysqli_query($connect, $query2);
                if (mysqli_num_rows($result) <> 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $PHONGBAN = $row[0];
                        echo "<option value='$PHONGBAN' ";
                        if (isset($_REQUEST['phongban']) && $_REQUEST['phongban'] == $PHONGBAN) echo 'selected';
                        echo ">$row[1]</option>";
                    }
                }
                mysqli_free_result($result);
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
<?php require("../../layout/footer.php"); ?>