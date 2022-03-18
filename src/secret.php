<?php
    session_start();
    if (!isset($_SESSION['username'])) { // make sure the user is logged-in (we wouldn't want anyone else to see this top-secret info!)
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Secret Page</title>
</head>
<body>
    <p>< insert super top secret info that only logged-in users should be able to see here ></p>
</body>
</html>