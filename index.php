<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

// ตรวจสอบว่า session มีค่าอะไรบ้าง
//var_dump($_SESSION);

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="homeheader">
    <h2>Home Page</h2>
</div>
<div class="homecontent">
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="success">
            <h3>
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <?php if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p>Email: <strong><?php echo $_SESSION['email']; ?></strong></p>
        <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
    <?php endif ?>
</div>
</body>
</html>
