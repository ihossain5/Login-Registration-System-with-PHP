<?php
    include_once "inc/header.php";
    include_once "lib/User.php";
    Session::checkSession();
    $user =new User() ;?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <?php
                    $loginmsg = Session::get('loginmsg');
                    if (isset($loginmsg)){
                        echo $loginmsg;
                    }
                    Session::set('loginmsg', NULL);

                ?>
                <div class="card-header">
                    <h2>User List <span class="float-right"><strong>Welcome </strong>
                           <?php $name = Session::get('name');
                           if (isset($name)){
                               echo $name;
                           }
                           ?></span> </h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
              <?php
                $userData = $user->getUserData();
                if ($userData){
                    $i = 0;
                    foreach ($userData as $data){
                        $i++;
              ?>
                        <tr>
                            <td scope="col"><?php echo $i?></td>
                            <td scope="col"><?php echo $data['name']?></td>
                            <td scope="col"><?php echo $data['user_name']?></td>
                            <td scope="col"><?php echo $data['email']?></td>
                            <?php $session_id = Session::get('id');
                                    if ($session_id == $data['id']){ ?>
                                        <td scope="col"><a href="profile.php?id=<?php echo $data['id']?>" class="btn btn-info">View</a></td>
                                <?php    } ?>

                        </tr>
             <?php } }?>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include_once "inc/footer.php";
?>