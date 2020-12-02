
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST["disconnect"])) {
        echo $_SESSION["user_id"];

        session_unset();
        session_destroy();

        header("location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Your Cart</title>
    
    <link rel="icon" href="images/favicon.ico">
    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global-styles.css">
    <link rel="stylesheet" href="css/product-style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/footer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="javascript/cookie.js" defer></script>
    <script src="javascript/header.js" defer></script>
    <script src="javascript/product.js" defer></script>
    
</head>
<body>
    <?php include "entities/header.php"; ?>
    
    <main>
        <div class="global-container">
            <div class="master-section">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                    <input type="submit" name="disconnect" value="disconnect">
                </form>
            </div>
        </div>
    <?php include "entities/footer.php" ?>
</body>
</html>
