<?php
include_once "inc/header.php";
include_once "lib/User.php" ;
Session::checkLogin();
$user = new User() ;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    $user_login = $user->userLogin($_POST);
}
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <h2 class="card-header">User Login</h2>
                    <div class="card-body">
                        <?php
                        if (isset($user_login)){
                            echo $user_login;
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email" >Email</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pass" >Password</label>
                                <input type="password" id="pass" name="password" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="login" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div></div>

        </div>
    </div>

<?php
include_once "inc/footer.php";
?>