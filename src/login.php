<?php
    session_start();

    $errors = array(); // contains form errors which will be rendered

    $db = mysqli_connect('localhost', 'root', '', 'db');

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            array_push($errors, "Please fill in all required fields.");
        }

        if (count($errors) === 0) {
            $login_query = "SELECT * FROM users WHERE username='$username' AND password='$password'"; // just a harmless SQL query...
            $results = mysqli_query($db, $login_query);
            if (mysqli_num_rows($results) === 1) {
                $_SESSION['username'] = $username;
                header('location: index.php');
                exit();
            } else {
                array_push($errors, "Invalid username and/or password.");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php if (count($errors) > 0) { ?>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <form action="/login.php" method="POST">
        <input type="text" name="username" required />
        <input type="password" name="password" required />
        <button type="submit" name="login">Login</button>
        <footer>Don't have an account? <a href="/register.php">Create one here</a></footer>
    </form>
</body>
</html>