<?php session_start();
error_reporting(0);
$title = 'Tìm nhân viên'; ?>
<?php
$open = "nhanvien";
require("../../autoload/autoload.php");
require("../../../libraries/database.php");
?>
<?php require("../../layout/header.php"); ?>

<font color="blue">
    <h1 align="center">TÌM KIẾM NHÂN VIÊN</h3>
</font>
<form class="form-inline" action="" method="GET">
    <div class="input-group" style="margin: auto;">
        <input type="text" name="tennv" class="form-control bg-gray-300 border-primary" placeholder="Tên nhân viên ... " aria-label="Search" aria-describedby="basic-addon2" value="<?php echo isset($_REQUEST["tennv"]) ? $_REQUEST["tennv"] : '' ?>">
        <div class="input-group-append">
            <input class="btn btn-primary" type="submit" name="find" value="Tìm">
        </div>
    </div>
</form>
<?php
if (isset($_GET['pages'])) {
    $pages = $_GET['pages'];
} else {
    $pages = 1;
}
$rowPerpage = 3;
$perRow = $pages * $rowPerpage - $rowPerpage;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['tennv'])) {
        $tennv = trim($_GET['tennv']);
        $sql = "SELECT * FROM `nhanvien` WHERE HO like '%$tennv%' or TEN like '%$tennv%' or HO+TEN like '%$tennv%' LIMIT $perRow,$rowPerpage";
        $query = mysqli_query($connect, $sql);
        $totalRows =  mysqli_num_rows($query);
        $totalPages = ceil($totalRows / $rowPerpage); // ceil là làm tròn tăng thôi 4.1 lên 5. 4.4 lên 5
        $listPages  = "";
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($pages == $i) {
                $listPages .= ' <li class="page-item active"><a href="index.php?pages=' . $i . '"></a>' . $i . '</a></li>';
            } else {
                $listPages .= '<li class="page-item"><a href="index.php?pages=' . $i . '"></a>' . $i . '</a></li>';
            }
        }
    }
}
?>
<?php
$stt = $rowPerpage * ($pages - 1) + 1;
if (mysqli_num_rows($query) <> 0)
    echo '<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <th width="4%">STT</th>
                    <th width="6%">Mã NV</th>
                    <th width="16%">Tên nhân viên</th>
                    <th width="10%">Ngày sinh</th>
                    <th width="7%">Giới tính</th>
                    <th width="7%">Địa chỉ</th>
                    <th width="10%">Ảnh</th>
                    <th width="10%">Loại NV</th>
                    <th width="10%">Phòng ban</th>
                    <th width="20%">Hành động</th>
                </thead>
                <tbody>';
                while ($rows = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><?php echo $rows['MANV'] ?></td>
                            <td><?php echo $rows['HO'] . ' ' . $rows['TEN']; ?></td>
                            <td><?php echo $rows['NGAYSINH']; ?></td>
                            <td><?php echo $rows['GIOITINH'] ?></td>
                            <td><?php echo $rows['DIACHI'] ?></td>
                            <td><img style="width:90px; height:120px;" src='../../../public/uploads/anhnhanvien/<?php echo $rows['ANH']; ?>'></td>
                            <td>
                                <?php
                                $MALOAINV = $rows['MALOAINV'];
                                $tbLOAINV = mysqli_query($connect, "SELECT TENLOAINV FROM `loainv` WHERE loainv.MALOAINV = '$MALOAINV'");
                                $TENLOAI = mysqli_fetch_array($tbLOAINV);
                                echo $TENLOAI['TENLOAINV'];
                                ?>
                            </td>
                            <td>
                                <?php
                                $MAPHONG = $rows['MAPHONG'];
                                $tbTENPHONG = mysqli_query($connect, "SELECT TENPHONG FROM `phongban` WHERE phongban.MAPHONG = '$MAPHONG'");
                                $TENPHONG = mysqli_fetch_array($tbTENPHONG);
                                echo $TENPHONG[0];
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-info" href="edit.php?id=<?php echo $rows['MANV'] ?>"> <i class="fa fa-edit"></i>&nbsp;Edit</a>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $rows['MANV'] ?>"><i class="fas fa-trash"></i>&nbsp;Delete</a>
                            </td>
                        </tr>

                    <?php
                        $stt++;
                    }
                    ?>
</tbody>

</table>
<ul class="pagination">
    <?php
    for ($t = 1; $t <= $totalPages; $t++) {

        echo "<li class='page-item'><a class='page-link' href='index.php?pages=$t'>Trang $t</a></li>";
    }
    ?>
</ul>
</div>
</div>
</div>
<?php require("../../layout/footer.php"); ?>