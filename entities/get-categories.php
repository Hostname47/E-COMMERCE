<?php
    try {
        $database = new Connection();
        $conn = $database->openConnection();

        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt -> execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $result){
?>
            <option value="<?php echo $result['cat_id']; ?>"><?php echo $result["cat_title"]?></option>
<?php   }
    } catch(PDOException $ex) {
        echo "There is some problem in connection: " . $ex->getMessage();
    }
?>