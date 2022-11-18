<?php

require_once 'includes/config.php';
require_once 'includes/classes/FormSanitizer.php';
require_once 'includes/classes/Constants.php';
require_once 'includes/classes/Account.php';

/** @var Account $con */

$account = new Account($con);

if (isset($_POST["submitButton"])) {

    $firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
    $lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST['email2']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST['password2']);

    $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
}

?>

<!doctype html>
<head>
    <title>Welcome to Reeceflix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>

<div class="signInContainer">

    <div class="column">

        <div class="header">
            <img src="https://fontmeme.com/permalink/221117/b81ddace7dac8361622434c55cd86b81.png"
                 title="Logo" alt="Site logo">
            <h3>Sign Up</h3>
            <span>to continue to Reeceflix</span>
        </div>

        <form method="post">
            <?php
            echo $account->getError(Constants::$firstNameCharacters);
            ?>
            <input type="text" name="firstName" placeholder="First name" required>

            <?php
            echo $account->getError(Constants::$lastNameCharacters);
            ?>
            <input type="text" name="lastName" placeholder="Last name" required>

            <?php
            echo $account->getError(Constants::$usernameCharacters);
            echo $account->getError(Constants::$usernameTaken);
            ?>
            <input type="text" name="username" placeholder="Username" required>

            <?php
            echo $account->getError(Constants::$emailsDontMatch);
            echo $account->getError(Constants::$emailInvalid);
            echo $account->getError(Constants::$emailTaken);
            ?>
            <input type="email" name="email" placeholder="Email" required>
            <input type="email" name="email2" placeholder="Confirm email" required>

            <?php
            echo $account->getError(Constants::$passwordsDontMatch);
            echo $account->getError(Constants::$passwordLength);
            ?>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password2" placeholder="Confirm password" required>


            <input type="submit" name="submitButton" value="Submit">

        </form>

        <a href="login.php" class="signInMessage">Already have an account? Sigh in here!</a>

    </div>

</div>

</body>
</html>
