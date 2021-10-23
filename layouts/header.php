<!DOCTYPE HTML>
<html>
<head>
<title>Trang Chủ</title>
<link href="public/frontend/css/style.css" rel="stylesheet" type="text/css" media="all" />

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="public/frontend/css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="public/frontend/css/nivo-slider.css" rel="stylesheet" type="text/css" media="all" />
<script src="public/frontend/js/jquery-1.9.0.min.js"></script>
<script src="public/frontend/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() 
	{
        $('#slider').nivoSlider();
    });
    </script>
<!-- thumbs -->
<script src="public/frontend/js/home.js"></script>
<script src="public/frontend/js/jquery.carouFredSel-6.0.5-packed.js"></script>
	<script type="text/javascript">
       $("#foo1").carouFredSel();
    </script>
</head>
<body>
<?php
    session_start();
	if(isset($_POST['login']))
	{
        header('Location: '.'login.php');
		// redirectUrl('../login.php');
	}
	if(isset($_POST['logout']))
	{
        // session_unset($_SESSION["login"]);
        if(isset($_SESSION['login'])){
            $_SESSION['login'] = false;
            //session_unset($_SESSION["login"]);

        }
            
        if(isset($_SESSION['email']))
        unset($_SESSION['email']);
        if(isset($_SESSION['password']))
        unset($_SESSION['password']);
        
	}
?>
<div class="wrap">
    <div>
		<div class="header">
            <div class="container">
            <div class="container header__inner">
                <a href="index.html" class="header__logo">
                    HNTTcomputer
                </a>
				
				<form action="" method="POST">
                <div class="header__menu">
                    <ul class="header__menu-list">
                        <li class="header__menu-item">
                            <a href="/qlbanlinhkienmaytinh/index.php" class="header__menu-link">Home</a>
                        </li>
                        <li class="header__menu-item">
                            <a href="/qlbanlinhkienmaytinh/category.php" class="header__menu-link">Categoty</a>
                        </li>
                        <!-- <li class="header__menu-item">
                            <a href="/qlbanlinhkienmaytinh/archives.php" class="header__menu-link">Archives</a>
						</li> -->
						<li class="header__menu-item">
                            <a href="/qlbanlinhkienmaytinh/contact.php" class="header__menu-link">Contact</a>
						</li>
					

						<?php if(isset($_SESSION['login']) && $_SESSION['login'] == true) : ?>
							<li class="header__menu-item">
								<input type="submit" name="logout" href="" value="Logout" class="header__menu-link header__login">
							</li>
						<?php else : ?>
							<li class="header__menu-item">
                            <input type="submit"  name="login" href="" value="Login" class="header__menu-link header__login">
						</li>
						<?php endif; ?>
                    </ul>
				</div>
				</form>
            </div>
        </div>
        </div>
