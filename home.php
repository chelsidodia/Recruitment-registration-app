<?php
session_start();
if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}

$success_message = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if ($_SESSION['step'] == 1) {
            $_SESSION['full_name'] = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
            $_SESSION['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $_SESSION['phone'] = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
            $success_message = "Personal Information saved successfully!";
        } elseif ($_SESSION['step'] == 2) {
            $_SESSION['degree'] = filter_var($_POST['degree'], FILTER_SANITIZE_STRING);
            $_SESSION['field_of_study'] = filter_var($_POST['field_of_study'], FILTER_SANITIZE_STRING);
            $_SESSION['institution'] = filter_var($_POST['institution'], FILTER_SANITIZE_STRING);
            $_SESSION['graduation_year'] = filter_var($_POST['graduation_year'], FILTER_SANITIZE_NUMBER_INT);
            $success_message = "Educational Background saved successfully!";
        } elseif ($_SESSION['step'] == 3) {
            $_SESSION['job_title'] = filter_var($_POST['job_title'], FILTER_SANITIZE_STRING);
            $_SESSION['company'] = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
            $_SESSION['years_of_experience'] = filter_var($_POST['years_of_experience'], FILTER_SANITIZE_NUMBER_INT);
            $_SESSION['responsibilities'] = filter_var($_POST['responsibilities'], FILTER_SANITIZE_STRING);
            $success_message = "Work Experience saved successfully!";
        }
    } elseif (isset($_POST['next'])) {
        $_SESSION['step']++;
    } elseif (isset($_POST['previous'])) {
        $_SESSION['step']--;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Application - Form</title>
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
            width: 50%;
            margin: 1% auto;
            background-color: white;
            padding: 2%;
            text-align: center;
            height: 500px;
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
        h1{
            text-align: center;
            text-shadow: 2px 2px 4px white;
        }
        .success-message {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="hero">
    </div>
    <h1>Job Application</h1>
    <form method="POST" action="">
    <div>
        <p>Step <?php echo $_SESSION['step']; ?> of 3</p>
    </div>
    <?php if ($success_message): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <br>
        <?php if ($_SESSION['step'] == 1): ?>
            <h3>Personal Information</h3>
            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?php echo isset($_SESSION['full_name']) ? htmlspecialchars($_SESSION['full_name']) : ''; ?>" required>
            <br><br><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
            <br><br><br>
            <label>Phone Number:</label>
            <input type="text" name="phone" value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : ''; ?>" required>
            <br><br><br>
        <?php elseif ($_SESSION['step'] == 2): ?>
            <h3>Educational Background</h3>
            <label>Highest Degree Obtained:</label>
            <input type="text" name="degree" value="<?php echo isset($_SESSION['degree']) ? htmlspecialchars($_SESSION['degree']) : ''; ?>" required>
            <br><br><br>
            <label>Field of Study:</label>
            <input type="text" name="field_of_study" value="<?php echo isset($_SESSION['field_of_study']) ? htmlspecialchars($_SESSION['field_of_study']) : ''; ?>" required>
            <br><br><br>
            <label>Name of Institution:</label>
            <input type="text" name="institution" value="<?php echo isset($_SESSION['institution']) ? htmlspecialchars($_SESSION['institution']) : ''; ?>" required>
            <br><br><br>
            <label>Year of Graduation:</label>
            <input type="number" name="graduation_year" value="<?php echo isset($_SESSION['graduation_year']) ? htmlspecialchars($_SESSION['graduation_year']) : ''; ?>" required>
            <br><br><br>
        <?php elseif ($_SESSION['step'] == 3): ?>
            <h3>Work Experience</h3>
            <label>Previous Job Title:</label>
            <input type="text" name="job_title" value="<?php echo isset($_SESSION['job_title']) ? htmlspecialchars($_SESSION['job_title']) : ''; ?>" required>
            <br><br><br>
            <label>Company Name:</label>
            <input type="text" name="company" value="<?php echo isset($_SESSION['company']) ? htmlspecialchars($_SESSION['company']) : ''; ?>" required>
            <br><br><br>
            <label>Years of Experience:</label>
            <input type="number" name="years_of_experience" value="<?php echo isset($_SESSION['years_of_experience']) ? htmlspecialchars($_SESSION['years_of_experience']) : ''; ?>" required>
            <br><br><br>
            <label>Key Responsibilities:</label>
            <textarea name="responsibilities" required><?php echo isset($_SESSION['responsibilities']) ? htmlspecialchars($_SESSION['responsibilities']) : ''; ?></textarea>
            <br><br><br>
        <?php endif; ?>
        <div>
            <button type="submit" name="save">Save</button>
            <?php if ($_SESSION['step'] > 1): ?>
                <button type="submit" name="previous">Previous</button>
            <?php endif; ?>
            <?php if ($_SESSION['step'] < 3): ?>
                <button type="submit" name="next">Next</button>
            <?php else: ?>
                <button type="submit" formaction="review.php">Review</button>
            <?php endif; ?>
        </div>
    </form>
</body>
</html>
