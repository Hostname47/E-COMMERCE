<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Admin space</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/admin-pannel.css">
    <link rel="icon" href="assets/icons/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/admin-pannel-dynamics.js" defer></script>
</head>
<body>
    <?php include "entities/header.php" ?>
    <main>
        <div class="admin-global-layout">
            <?php include "entities/left-pannel.php" ?>

            <div class="admin-main-layout">
                <h2>This is dashboard layout</h2>
                <p>This part of our layout should be for statistics of tranding product and most search product and best reviews and things ..</p>
            </div>
        </div>
    </main>
    <script>
        $("#dashboard-button").addClass("selected-option");
    </script>
</body>
</html>