<?php
include_once "lib/User.php";
include_once "inc/header.php";
Session::checkSession();

if (isset($_GET['id'])){
    $userid = (int)$_GET['id'];
    $session_id = Session::get('id');
    if ($userid != $session_id){
        header('location:index.php');
    }
}
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
    $updatePassword = $user->updatePassword($userid, $_POST);
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2>Change Password <span><a href="profile.php?=<?php echo $userid?>" class="btn btn-info float-right">Back</a></span></h2>

                </div>
                <div class="card-body">
                    <?php if (isset($updatePassword)){
                        echo $updatePassword;
                    }?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="old_pass" >Old Password</label>
                            <input type="password" id="old_pass" name="old_pass" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" >User Name</label>
                            <input type="password" id="password" name="new_pass" class="form-control">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "inc/footer.php";
?>
