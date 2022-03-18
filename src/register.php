<?php
    session_start();

    $errors = array(); // contains form errors which will be rendered

    $db = mysqli_connect('localhost', 'root', '', 'db');

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($username) || empty($email) || empty($password)) {
            array_push($errors, "Please fill in all required fields.");
        } else {
            $user_exists_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1"; // just a harmless SQL query...
            $result = mysqli_query($db, $user_exists_query);
            $user = mysqli_fetch_assoc($result);
                
            if ($user) { 
                if ($user['username'] === $username) {
                    array_push($errors, "Username already exists.");
                }

                if ($user['email'] === $email) {
                    array_push($errors, "Email already exists.");
                }
            }
        }

        if (count($errors) === 0) {
            $register_query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')"; // just a harmless SQL query...
            mysqli_query($db, $register_query);
            $_SESSION['username'] = $username;
            header('location: index.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php if (count($errors) > 0) { ?>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <form action="/register.php" method="POST">
        <input type="text" name="username" required />
        <input type="email" name="email" required />
        <input type="password" name="password" required />
        <button type="submit" name="register">Register</button>
        <footer>Already have an account? <a href="/login.php">Login here</a></footer>
    </form>
</body>
</html>