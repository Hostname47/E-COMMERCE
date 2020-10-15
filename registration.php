<?php

    echo $_GET["name"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php  echo $_SERVER["PHP_SELF"]; ?>">

        <input type="submit" name="sub" id="sub" value="go">
    </form>
</body>
</html>