<?php

session_start();
include('server.php');
$errors = array();
if(isset($_POST['login_user'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($username)){
        array_push($errors, "Username Is required");
    }

    if(empty($password)){
        array_push($errors, "Password Is required");
    }

    if (count($errors) == 0){
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email']; // เพิ่มบรรทัดนี้เพื่อเก็บอีเมลใน session
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }        
        else{
            array_push($errors, "Wrong Username/Password combination");
            $_SESSION['error'] = "Wrong Username or Password try again!";
            header("location: login.php");
        }
    }
}
?>