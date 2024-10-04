<?php
    session_start();
    include('server.php');

    $errors = array();

    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
        
        // ตรวจสอบฟิลด์ที่ว่างเปล่า
        if (empty($username)) {
            array_push($errors, "Username is required");
        }

        if (empty($email)) {
            array_push($errors, "Email is required");
        }

        if (empty($password_1)) {
            array_push($errors, "Password is required");
        }

        // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }

        // ตรวจสอบว่าชื่อผู้ใช้หรืออีเมลมีอยู่แล้วหรือไม่
        $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result['username'] === $username) {
                array_push($errors, "Username already exists");
            }

            if ($result['email'] === $email) {
                array_push($errors, "Email already exists");
            }
        }

        // หากไม่มีข้อผิดพลาดให้บันทึกผู้ใช้ลงฐานข้อมูล
        if (count($errors) == 0) {
            $password = md5($password_1); // เข้ารหัสรหัสผ่าน
            $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($conn, $query);
            
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email; // เพิ่มบรรทัดนี้เพื่อเก็บอีเมลใน session
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
        
        else{
            array_push($errors, "Username or Email already exists");
            $_SESSION['error'] = "Username or Email already exists";
            header("location: register.php");
        }
    }
?>
