<?php
include_once "lib/User.php";
include_once "inc/header.php";
Session::checkSession();

if (isset($_GET['id'])){
    $userid = (int)$_GET['id'];
}
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
    $updateUser = $user->updateUserData($userid, $_POST);
}



$userData = $user->getUserById($id);
if ($userData){
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2>User Profile <span><a href="index.php" class="btn btn-info float-right">Back</a></span></h2>

                </div>
                <div class="card-body">
                    <?php if (isset($updateUser)){
                        echo $updateUser;
                    }?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name" >Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $userData->name;?>">
                        </div>
                        <div class="form-group">
                            <label for="uname" >User Name</label>
                            <input type="text" id="uname" name="username" class="form-control"value="<?php echo $userData->user_name;?>">
                        </div>
                        <div class="form-group">
                            <label for="email" >Email</label>
                            <input type="text" id="email" name="email" class="form-control"value="<?php echo $userData->email;?>">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <a href="changePassword.php?id=<?php echo $userid;?>" class="btn bg-info">Change Password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }?>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>
