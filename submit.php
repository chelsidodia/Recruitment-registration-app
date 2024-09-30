<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application = [
        'full_name' => $_SESSION['full_name'],
        'email' => $_SESSION['email'],
        'phone' => $_SESSION['phone'],
    ];

    $applicationsFile = 'applications.json';
    $applications = json_decode(file_get_contents($applicationsFile), true) ?? [];
    $applications[] = $application;
    file_put_contents($applicationsFile, json_encode($applications));

    echo "Application successfully submitted! A confirmation email has been sent to " . $_SESSION['email'];
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Complete</title>
</head>
<body>
    <h2>Application Submitted!</h2>
    <p>Your application has been successfully submitted. A confirmation email has been sent to your email.</p>
    <a href="login.php">Logout</a>
</body>
</html>
