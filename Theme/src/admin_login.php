<?php
include "db_connect.php";

$email = $password = "";
if(isset($_POST['submit'])){
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }else{
        setcookie('login_error','Ju lutem vendosni emailin.');
    }
    if(isset($_POST['password'])){
        $password = md5($_POST['password']);
    }else{
        setcookie('login_error','Ju lutem vendosni passwordin.');
    }

    $query = "SELECT * FROM user WHERE email='{$email}' AND password='{$password}' AND role='1'";
    $result = $conn->query($query);

    if ($result->num_rows < 1) {
        setcookie('login_error','Kredencialet jane te gabuara.');
        header('Location: ../login.php');
    }else{
        $user= $result->fetch_assoc();
        session_start();
        $_SESSION['logged_in'] = 1;
        $_SESSION['email'] = $user['email'];
        header('Location: ../index.php');
    }


}
?>