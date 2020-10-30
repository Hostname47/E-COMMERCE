<?php 

    session_start();
    $host = 'localhost';
    $status = "";
    if($socket =@ fsockopen($host, 80, $errno, $errstr, 30)) {
        $status = 'online.';
    fclose($socket);
    } else {
        $status = 'offline.';
    }

    if(!isset($_SESSION["user_id"])) {
        header("location: ../login-entities/login.php");
    }

    if(isset($_POST["logout"])) {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        header("location: ../login-entities/login.php");
    }

?>

<header>
    <div class="top-strip">
        <div class="logo-and-title">
            <a href="https://localhost/E-COMMERCE/Admin/dashboard.php"; ?><img id="lg" src="https://localhost/E-COMMERCE/Admin/assets/icons/logo.png" class="top-logo" alt="logo"></a>
            <a style="text-decoration: none; color: black;" href="https://localhost/E-COMMERCE/Admin/dashboard.php"><p class="big-title">Admin Space</p></a>
        </div>
        <div>
            <p class="admin-name-top">admin: <span style="font-weight: bold;"><?php if(isset($_SESSION["username"])) {echo $_SESSION["username"];} ?></span></p>
        </div>
        <div>
            <p style="margin-left: 12px" class="admin-name-top">Website status: <span style="font-weight: bold;"><?php echo $status; ?></span></p>
        </div>
        <div class="move-it-to-right">
            <nav class="top-nav-menu-container">
                <a href="../Admin/dashboard.php" class="menu-button" id="home">Home</a>
                <a href="https://localhost/E-COMMERCE/index.php" class="menu-button" id="view-website" target="_blank">View site</a>
                <a href="../Admin/dashboard.php" class="menu-button" id="help" target="_blank">Help</a>
                <!-- Logout button -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="submit" name="logout" id="logout" value="Logout" class="menu-button">
                </form>
            </nav>
        </div>
    </div>
</header>