<?php
session_start();

if (isset($_COOKIE['username'])) {
    $savedUsername = $_COOKIE['username'];
} else {
    $savedUsername = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('users.json'), true) ?? [];
    $userFound = false;

    foreach ($users as $user) {
        if ($user['username'] == $username && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $userFound = true;
            if (isset($_POST['remember'])) {
                setcookie('username', $username, time() + (7 * 24 * 60 * 60));
            }
            header('Location: home.php');
            break;
        }
    }

    if (!$userFound) {
        echo "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            background-image: url("photo_1.jpg");
            background-repeat: no-repeat;
            background-size:cover;
        }
        #hero{
            width: 100%;
            height: cover;
            background-color: white;
            position:absolute;
            top:0;
            bottom:0;
            opacity: 0.3;
            z-index: -1;
        }
        form{
            z-index: 100;
            width: 20%;
            margin: 10% auto;
            background-color: white;
            padding: 2%;
            text-align: center;
            height: 300px;
            border-radius: 5px;
            box-shadow: 3px 3px 7px grey;
        }
        button{
            background-color: black;
            color: white;
            border-radius: 15px;
            padding: 3% 5%;
            border: 1px solid black;
            cursor: pointer;
        }
        a{
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div id="hero">
    
    
    </div>
    
    <form method="POST" action="">
        <h2>LOGIN</h2>
        <br><br>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($savedUsername); ?>" required>
        <br><br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <input type="checkbox" name="remember"> Remember Me
        <br><br>
        <button type="submit">Login</button>
        <br><br>
        <a href="registration.php" target="_blank">Not a member?<br>Sign Up Here</a>
    </form>
</body>
</html>
