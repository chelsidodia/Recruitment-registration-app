<?php
session_start();
if (!isset($_SESSION['full_name']) || !isset($_SESSION['degree']) || !isset($_SESSION['job_title'])) {
    header('Location: home.php');
    exit;
}

$isSubmitted = isset($_SESSION['submitted']) ? $_SESSION['submitted'] : false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $_SESSION['submitted'] = true;
        $isSubmitted = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Information Review</title>
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
        form, .details{
            z-index: 100;
            width: 50%;
            margin: 1% auto;
            background-color: white;
            padding: 2%;
            text-align: left;
            border-radius: 5px;
            box-shadow: 3px 3px 7px grey;
        }
        button{
            background-color: black;
            color: white;
            border-radius: 15px;
            padding: 1.5% 3%;
            border: 1px solid black;
            cursor: pointer;
        }
        a{
            font-size: 13px;
        }
        h1, h2, h3{
            text-align: center;
            text-shadow: 2px 2px 4px white;
        }
        .info {
            margin-bottom: 15px;
        }
        .info label {
            font-weight: bold;
        }
        .info span {
            display: inline-block;
            margin-left: 10px;
        }
        .success {
            background-color: lightgreen;
            color: green;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="hero"></div>
    <h1>Review Your Application</h1>

    <?php if ($isSubmitted): ?>
        <div class="success">
            Your application has been submitted successfully!
        </div>
    <?php endif; ?>

    <div class="details">
        <h2>Personal Information</h2>
        <div class="info">
            <label>Full Name:</label><span><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
        </div>
        <div class="info">
            <label>Email:</label><span><?php echo htmlspecialchars($_SESSION['email']); ?></span>
        </div>
        <div class="info">
            <label>Phone Number:</label><span><?php echo htmlspecialchars($_SESSION['phone']); ?></span>
        </div>
    </div>

    <div class="details">
        <h2>Educational Background</h2>
        <div class="info">
            <label>Highest Degree Obtained:</label><span><?php echo htmlspecialchars($_SESSION['degree']); ?></span>
        </div>
        <div class="info">
            <label>Field of Study:</label><span><?php echo htmlspecialchars($_SESSION['field_of_study']); ?></span>
        </div>
        <div class="info">
            <label>Name of Institution:</label><span><?php echo htmlspecialchars($_SESSION['institution']); ?></span>
        </div>
        <div class="info">
            <label>Year of Graduation:</label><span><?php echo htmlspecialchars($_SESSION['graduation_year']); ?></span>
        </div>
    </div>

    <div class="details">
        <h2>Work Experience</h2>
        <div class="info">
            <label>Job Title:</label><span><?php echo htmlspecialchars($_SESSION['job_title']); ?></span>
        </div>
        <div class="info">
            <label>Company Name:</label><span><?php echo htmlspecialchars($_SESSION['company']); ?></span>
        </div>
        <div class="info">
            <label>Years of Experience:</label><span><?php echo htmlspecialchars($_SESSION['years_of_experience']); ?></span>
        </div>
        <div class="info">
            <label>Key Responsibilities:</label><span><?php echo htmlspecialchars($_SESSION['responsibilities']); ?></span>
        </div>
    </div>
    <form method="POST" action="">
        <div style="text-align: center;">
            <button type="submit" name="previous" formaction="home.php">Previous</button>

            <?php if (!$isSubmitted): ?>
                <button type="submit" name="submit">Submit Application</button>
            <?php endif; ?>

            <?php if ($isSubmitted): ?>
                <button type="submit" formaction="logout.php">Logout</button>
            <?php endif; ?>
        </div>
    </form>
</body>
</html>
