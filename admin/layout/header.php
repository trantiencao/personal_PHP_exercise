<?php session_start();
error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title ?></title>
    <link href="/personal_PHP_exercise/public/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/personal_PHP_exercise/public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/personal_PHP_exercise/public/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<?php
if (isset($_SESSION["login"]) && $_SESSION["login"] != true)
    header('location: /personal_PHP_exercise/');
if (isset($_POST['logout'])) {
    if (isset($_SESSION["login"]))
        unset($_SESSION["login"]);
    // session_unset($_SESSION["login"]);
    if (isset($_SESSION['email']))
        unset($_SESSION['email']);
    if (isset($_SESSION['password']))
        unset($_SESSION['password']);
    header('location: /personal_PHP_exercise/');
}
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/personal_PHP_exercise/admin/">
                <div class="sidebar-brand-icon rotate-n-15">
                    QL
                </div>
                <div class="sidebar-brand-text mx-3">Nhân VIên</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản Lí
            </div>

            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item active">
                <a class="nav-link" href="./">
                    <i class="fas fa-home"></i>
                    <span>Đơn hàng</span></a>
            </li> -->

            <!-- Nav Item - Charts -->
            <li class="<?php echo isset($open) && $open == 'phongban' ? 'active' : '' ?> nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePagesPB"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-list-ul"></i>
                    <span>Phòng ban</span>
                </a>
                <div id="collapsePagesPB" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/personal_PHP_exercise/admin/module/phongban/add.php">Thêm mới</a>
                        <a class="collapse-item" href="/personal_PHP_exercise/admin/module/phongban/index.php">Danh sách phòng ban</a>
                    </div>
                </div>
            </li>

            <li class="<?php echo isset($open) && $open == 'loainhanvien' ? 'active' : '' ?> nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePagesLNV"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-list-ul"></i>
                    <span>Loại Nhân viên</span>
                </a>
                <div id="collapsePagesLNV" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/personal_PHP_exercise/admin/module/loainhanvien/add.php">Thêm mới</a>
                        <a class="collapse-item" href="/personal_PHP_exercise/admin/module/loainhanvien/index.php">Danh sách loại nhân viên</a>
                    </div>
                </div>
            </li>

            <li class="<?php echo isset($open) && $open == 'nhanvien' ? 'active' : '' ?> nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePagesNV"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-list-ul"></i>
                    <span>Nhân viên</span>
                </a>
                <div id="collapsePagesNV" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/personal_PHP_exercise/admin/module/nhanvien/add.php">Thêm mới</a>
                        <a class="collapse-item" href="/personal_PHP_exercise/admin/module/nhanvien/index.php">Danh sách nhân viên</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Crossbar and Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-success topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if (isset($_SESSION['login']) && $_SESSION['login'] == true) echo $_SESSION['name']; else echo '#error';?></span>
                                <i class="fas fa-user-shield"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <input type="button" value="Profile"
                                        style="background: transparent; color: black; border: none; cursor: pointer;">
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item">
                                    <form action="" method="post">
                                        <input type="submit" name="logout" value="Logout"
                                            style="background: transparent; color: black; border: none; cursor: pointer;">
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
            

        
