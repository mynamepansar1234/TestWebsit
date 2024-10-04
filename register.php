
<?php
session_start();
include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
<h1>Register</h1>
</div>

<form action="register_db.php" method="post">
    <!-- notification message -->
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="error">
            <h3>
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); // ลบค่าข้อความหลังจากแสดง
                ?>
            </h3>
        </div>
    <?php endif ?>

    <?php include('errors.php'); ?>

    <div class="input-group">
    <label for="username">Username</label>
        <input type="text" name="username">
    </div>

    <div class="input-group">
    <label for="email">Email</label>
        <input type="email" name="email">
    </div>

    <div class="input-group">
    <label for="password_1">Password</label>
        <input type="password" name="password_1">
    </div>

    <div class="input-group">
    <label for="password_2">Confirm Password</label>
    <input type="password" name="password_2">
    </div>

    <div class="input-group">
    <br><button type="submit" name="reg_user" class="btn">Register</button>
    </div>

    <p>Alredy a member? <a href="login.php">Sign in</a></p>
</form>
    
</body>
</html>