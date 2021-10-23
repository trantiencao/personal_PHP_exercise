<?php session_start();
error_reporting(0);
$title = 'Sửa nhân viên'; ?>
<?php
$open = "nhanvien";
require("../../autoload/autoload.php");

$id = $_GET['id'];
$query = "SELECT * FROM `nhanvien` WHERE MANV = '$id'";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) {
    $MA = $row[0];
    $HO = $row[1];
    $TEN = $row[2];
    $NS = $row[3];
    $GT = $row[4];
    $DC = $row[5];
    $ten_hinh = $row[6];
    $LOAINV = $row[7];
    $PHONGBAN = $row[8];
}


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
        $query = "UPDATE `nhanvien` SET `MANV`='$MA',`HO`='$HO',`TEN`='$TEN',`NGAYSINH`='$NS',`GIOITINH`='$GT',`DIACHI`='$DC',`ANH`='$ANH',`MALOAINV`='$LOAINV',`MAPHONG`='$PHONGBAN' WHERE MANV='$id'";
        $result = mysqli_query($connect, $query);

        $_SESSION['success'] = 'Cập nhật thành công';
        redirectUrl('/personal_PHP_exercise/admin/module/nhanvien/index.php');
    } else echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
}
?>

<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Chỉnh Sửa NHÂN VIÊN</h1>
<div class="col-md-12">
    <form action="" method="POST">
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
            <input class="form-control-file" type="file" class="form-control" name="fileUpload" value="<?php echo $ten_hinh; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Loại nhân viên</label>
            <select class="form-control" name="loainv">
                <?php
                $selected = $LOAINV;
                $query1 = "SELECT * FROM loainv";
                $result = mysqli_query($connect, $query1);
                while ($row = mysqli_fetch_array($result)) {
                    if ($row[0] == $selected) {
                        echo "<option value='$row[0]' selected>$row[1]</option>";
                    } else echo "<option value='$row[0]'>$row[1]</option>";
                }
                mysqli_free_result($result);
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phòng ban</label>
            <select class="form-control" name="phongban">
                <?php
                $selected = $PHONGBAN;
                $query2 = "SELECT * FROM phongban";
                $result = mysqli_query($connect, $query2);
                if (mysqli_num_rows($result) <> 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row[0] == $selected) {
                            echo "<option value='$row[0]' selected>$row[1]</option>";
                        } else echo "<option value='$row[0]'>$row[1]</option>";
                    }
                }
                mysqli_free_result($result);
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
<?php require("../../layout/footer.php"); ?>