<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php if (isset($_SESSION['username'])) { ?>
        <p>Welcome, <?php echo $_SESSION['username']; // always want to make our users feel welcome! ?>!</p>
    <?php } else { ?>
        <p>Click here to <a href="/register.php">register</a> and here to <a href="/login.php">login</a>.</p>
    <?php } ?>
</body>
</html>