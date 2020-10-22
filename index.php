<?php

    session_start();

    if(!isset($_SESSION["user_id"])) {
        header("location: login-entities/login.php");
    }

    if(isset($_POST["logout"])) {
        unset($_SESSION['user_id']);
        session_destroy();
        header("location: login-entities/login.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/index.js" defer></script>
</head>
<body>
    <?php include "entities/header.php"; ?>
    <main>



        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="submit" name="logout" id="logout" value="logout">
        </form>
    </main>
    
</body>
</html>