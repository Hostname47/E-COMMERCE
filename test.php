<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $id = "{1,2}";
        $id = substr($id, 1, -1);
        $id = preg_split("/\,/", $id);
        echo "<p>" . $id[1] . "</p>";
    ?>
</body>
</html>