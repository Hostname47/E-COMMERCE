
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Help</title>
    <link rel="stylesheet" href="css/help.css">
    <link rel="stylesheet" href="../css/header.css">

    <link rel="icon" href="../../assets/icons/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/help.js" defer></script>
</head>
<body>
    <?php include "../entities/header.php" ?>
    <main class="help-container">
        <div class="top-section-container">
            <h1 class="help-title">DEVELOPER DOC</h1>
            <a href="#" class="its-a-link github">project on github</a>
        </div>
        <hr class="underline">
        <div id="help-section">
            <?php include "Help-pages-container/help1.php"; ?>
        </div>
    </main>
</body>
</html>