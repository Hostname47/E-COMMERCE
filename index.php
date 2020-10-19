<?php

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header("location: login.php");
    }

    if(isset($_POST["logout"])) {
        unset($_SESSION['user_id']);

        header("location: login.php");
    }
    session_destroy();

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="javascript/dynamics.js" defer></script>
</head>
<body>
    <?php include "header.php"; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="submit" name="logout" id="logout">
    </form>
</body>
</html>