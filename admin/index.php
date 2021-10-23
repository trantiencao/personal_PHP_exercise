<?php
session_start();
error_reporting(0);
$title = 'Admin';
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    require("autoload/autoload.php");
    require("layout/header.php");
} else {
    # code...
}
?>

<?php if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    require("layout/footer.php");
} else {
    # code...
}
?>