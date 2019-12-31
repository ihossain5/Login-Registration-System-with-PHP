<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Session.php";
    Session::init();

    if (isset($_GET['action']) && $_GET['action']== 'logout'){
        Session::destroy();
        header('location:login.php');
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login System in PHP</title>
    <link rel="stylesheet" href="inc/bootstrap.min.css">
</head>
<body>
<!-- As a link -->
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/../login_system/index.php">Login System in PHP</a>
    <ul class="nav justify-content-center">
        <?php
                $id = Session::get('id');
                $userLogin = Session::get('login');
                if ($userLogin == true){ ?>
        <li class="nav-item">
             <a class="nav-link active" href="/../login_system/profile.php?id=<?php echo $id?>">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?action=logout">Logout</a>
        </li>
                <?php } else{ ?>
         <li class="nav-item">
            <a class="nav-link" href="/../login_system/login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/../login_system/register.php">Register</a>
        </li>
             <?php  } ?>


    </ul>
</nav>
