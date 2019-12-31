<?php
    include_once "Session.php";
    include_once "Database.php";

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function userRegistration($data){
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        if (strlen($password) < 6){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Password must be 6 character length</div>";
            return $msg;
       }elseif (!preg_match('#[A-Z]+#', $password)){
           $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Password must contain 1 uppercase letter</div>";
           return $msg;
       }elseif (!preg_match('#[a-z]+#', $password)){
           $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Password must contain 1 lowercase letter</div>";
           return $msg;
       }elseif (!preg_match('#[0-9]+#', $password)){
           $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Password must contain 1 number</div>";
           return $msg;
        }else{
            $pass_hash = password_hash( $password, PASSWORD_BCRYPT );
        }

        $check_email = $this->checkEmail($email);

        if ($name == '' || $username == '' || $email == '' || $password == ''){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Filed must not be empty</div>";
            return $msg;
        }
        if (strlen($username) < 3){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Username is too short</div>";
            return $msg;
        }
        elseif (preg_match('/[^a-z0-9_-]/i', $username)){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Username only contain alphanumeric, dashes and underscores!</div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL ==false)){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Please enter a valid email address</div>";
            return $msg;
        }
        if ($check_email == true){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Email already exits</div>";
            return $msg;
        }

        $sql = "INSERT INTO users (name, user_name, email, password) VALUES (:name, :username, :email, :pass_hash)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name',$name);
        $query->bindValue(':username',$username);
        $query->bindValue(':email',$email);
        $query->bindValue(':pass_hash',$pass_hash);
        $query->execute();
        if ($query){
            $msg = "<div class='alert alert-success'> <strong> Successful!</strong> You have been registered</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Try again</div>";
            return $msg;
        }
    }

    public function checkEmail($email){
        $sql = "SELECT email FROM users WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        if ($query->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }


    public function userLogin($data){
        $email = $data['email'];
        $password = $data['password'];
        $check_email = $this->checkEmail($email);

        if ( $email == '' || $password == ''){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Filed must not be empty</div>";
            return $msg;
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL ==false)){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Please enter a valid email address</div>";
            return $msg;
        } else if ($check_email == false){
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Email not found</div>";
            return $msg;
        }
        $result = $this->getLoginUser($email, $password);
        if ($result){
            Session::init();
            Session::set('login', true);
            Session::set('id', $result->id);
            Session::set('name', $result->name);
            Session::set('username', $result->user_name);
            Session::set('loginmsg',"<div class='alert alert-success'> <strong> Success!</strong> You are logged in</div>" );
            header("location:index.php");
        }else{
            $msg = "<div class='alert alert-danger'> <strong> Error!</strong> Try Again</div>";
            return $msg;
        }
    }

    
    public function getLoginUser($email,$password ){
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        if (password_verify($password,$pass_hash)){
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email',$email);
            $query->bindValue(':password',$pass_hash);
            $query->execute();
            $value = $query->fetch(PDO::FETCH_OBJ);
            return $value;
        }else {
            return false;
        }

    }
}