<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $nginxVersion = shell_exec('nginx -v 2>&1');
        $mysqlVersion = shell_exec('mysql --version');

        echo $_SERVER['SERVER_SIGNATURE'];

    ?>
</body>
</html>