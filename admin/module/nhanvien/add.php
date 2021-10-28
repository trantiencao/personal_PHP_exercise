<?php session_start();
error_reporting(0);
$title = 'Thêm nhân viên'; ?>
<?php
$open = "nhanvien";
require("../../autoload/autoload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['MA']) && !empty($_POST['HO']) && !empty($_POST['TEN']) && !empty($_POST['NS'])  && !empty($_POST['GT']) && !empty($_POST['DC']) && !empty($_POST["fileUpload"]) && !empty($_POST['loainv']) && !empty($_POST['phongban'])) {
        $MA = $_POST['MA'];
        $HO = $_POST['HO'];
        $TEN = $_POST['TEN'];
        $NS = $_POST['NS'];
        $GT = $_POST['GT'];
        $DC = $_POST['DC'];
        $ANH = $_POST['fileUpload'];
        $LOAINV = $_POST['loainv'];
        $PHONGBAN = $_POST['phongban'];

        $query = "INSERT INTO `nhanvien`(`MANV`,`HO`,`TEN`,`NGAYSINH`,`GIOITINH`,`DIACHI`,`ANH`,`MALOAINV`,`MAPHONG`) VALUES ('$MA','$HO','$TEN','$NS','$GT','$DC','$ANH','$LOAINV','$PHONGBAN')";
        $result = mysqli_query($connect, $query);
        if ($result) {
            /* Upload file */
            if ($_FILES['fileUpload']['type'] == 'image/jpeg' || ($_FILES['fileUpload']['type'] == 'image/jpg') || ($_FILES['fileUpload']['type'] == 'image/png')) {
                if ($_FILES['fileUpload']['size'] < 8000) {
                    //Bước 1: Tạo đường dẫn upload file ảnh
                    $target_save = "../../../public/uploads/anhnhanvien/";
                    //Bước 2: thực hiện upload file
                    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_save . $_FILES['fileUpload']['name']);
                } else
                    echo "<script type='text/javascript'>alert('Vui lòng tải tệp có kích thước dưới 8MB');</script>";
            } else
                echo "<script type='text/javascript'>alert('Định dạng không phù hợp, đảm bảo tải lên tệp: PNG, JPG, JPEG');</script>";
            $_SESSION['success'] = 'Cập nhật thành công';
            redirectUrl('/personal_PHP_exercise/admin/module/nhanvien/index.php');
        } else
            echo "<script type='text/javascript'>alert('Cập nhập thất bại');</script>";
    } else
        echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
}
?>

<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Thêm Mới Nhân viên</h1>
<div class="col-md-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">MÃ NV</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="MA" value="<?php echo isset($_POST["MA"]) ? $_POST["MA"] : '' ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Họ NV</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="HO" value="<?php echo isset($_POST["HO"]) ? $_POST["HO"] : '' ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tên NV</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="TEN" value="<?php echo isset($_POST["TEN"]) ? $_POST["TEN"] : '' ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ngày sinh</label>
            <input type="date" class="form-control" id="exampleInputEmail1" name="NS" value="<?php echo isset($_POST["NS"]) ? $_POST["NS"] : '' ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Giới tính</label>
            <select class="form-control" id="exampleInputEmail1" name="GT">
                <?php isset($_POST["GT"]) ? $selected = $_POST["GT"] : '' ?>
                <option value="Nam" <?php if ($selected == 'Nam') echo 'selected'; ?>>Nam</option>
                <option value="Nữ" <?php if ($selected == 'Nữ') echo 'selected'; ?>>Nữ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Địa chỉ</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="DC" value="<?php echo isset($_POST["DC"]) ? $_POST["DC"] : '' ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ảnh</label>
            <input class="form-control-file" type="file" class="form-control" name="fileUpload" value="<?php if (isset($_POST['fileUpload'])) echo $_POST['fileUpload']; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Loại nhân viên</label>
            <select class="form-control" name="loainv">
                <?php isset($_POST["loainv"]) ? $selected1 = $_POST["loainv"] : '' ?>
                <?php
                $query1 = "SELECT * FROM loainv";
                $result = mysqli_query($connect, $query1);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='$row[0]' ";
                    if ($selected1 == $row[0]) echo 'selected';
                    echo ">$row[1]</option>";
                }
                mysqli_free_result($result);
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phòng ban</label>
            <select class="form-control" name="phongban">
                <?php isset($_POST["phongban"]) ? $selected2 = $_POST["phongban"] : '' ?>
                <?php
                $query2 = "SELECT * FROM phongban";
                $result = mysqli_query($connect, $query2);
                if (mysqli_num_rows($result) <> 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='$row[0]' ";
                        if ($selected2 == $row[0]) echo 'selected';
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