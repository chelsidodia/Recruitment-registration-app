<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    $usersFile = 'users.json';
    $users = json_decode(file_get_contents($usersFile), true) ?? [];
    $users[] = ['username' => $username, 'email' => $email, 'password' => $password];
    file_put_contents($usersFile, json_encode($users));

    echo "Registration successful! <a href='login.php'>Click here to login</a>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Yourself</title>
    <style>
        body{
            background-image: url("photo_1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        #hero{
            width: 100%;
            height: cover;
            background-color: white;
            position: absolute;
            top: 0;
            bottom: 0;
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
    <div id="hero"></div>
    
    <form method="POST" action="">
        <h2>Register</h2>
        <label>Username:</label>
        <input type="text" name="username" required>
        <br><br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Register</button>
        <br><br>
        <a href="login.php">Go Back</a>
    </form>
</body>
</html>