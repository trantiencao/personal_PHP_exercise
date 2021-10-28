<?php session_start();
error_reporting(0);
$title = 'Tìm phòng ban'; ?>
<?php
$open = "phongban";
require("../../autoload/autoload.php");
require("../../../libraries/database.php");
?>
<?php require("../../layout/header.php"); ?>

<font color="blue">
    <h1 align="center">TÌM KIẾM PHÒNG BAN</h3>
</font>
<form class="form-inline" action="" method="GET">
    <div class="input-group" style="margin: auto;">
        <input type="text" name="tenphongban" class="form-control bg-gray-300 border-primary" placeholder="Tên phòng ban ... " aria-label="Search" aria-describedby="basic-addon2" value="<?php echo isset($_REQUEST["tenphongban"]) ? $_REQUEST["tenphongban"] : '' ?>">
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
    if (!empty($_GET['tenphongban'])) {
        $tenphongban = trim($_GET['tenphongban']);
        $sql = "SELECT * FROM `phongban` WHERE TENPHONG like '%$tenphongban%' LIMIT $perRow,$rowPerpage";
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
                    <th width="10%">STT</th>
                    <th width="20%">Mã phòng</th>
                    <th width="50%">Tên phòng ban</th>
                    <th width="20%">Hành động</th>
                </thead>
                <tbody>';
                while ($rows = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $rows['MAPHONG'] ?></td>
                            <td><?php echo $rows['TENPHONG'] ?></td>
                            <td>
                                <a class="btn btn-info" href="edit.php?MAPHONG=<?php echo $rows['MAPHONG'] ?>"> <i class="fa fa-edit"></i>&nbsp;Edit</a>
                                <a class="btn btn-danger" href="delete.php?MAPHONG=<?php echo $rows['MAPHONG'] ?>"><i class="fas fa-trash"></i>&nbsp;Delete</a>
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