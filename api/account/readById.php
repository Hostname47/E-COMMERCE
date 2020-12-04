
<?php

include "../../config/DB.php";
include "../../modules/Account.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/JSON");

$database = new Database();
$db = $database->connect();

$user = new Account($db);
if(!isset($_GET["uid"])) {
    return;
}

$id = $_GET["uid"];

$result = $user->read_single($id);

$num = $result->rowCount();

if($num > 0) {
    $user_data = array();
    $user_data['data'] = array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $usr = array(
            'user_id'=>$user_id,
            'user_name'=>$user_name,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'password'=>$password,
            'mobile'=>$mobile,
            'address'=>$address,
            'user_type'=>$user_type
        );
        array_push($user_data['data'], $usr);
    }

    // Turn categories data to JSON objects and output
    echo json_encode($user_data);
} else {
    return json_encode(array(
        "message"=>"No user found with this id"
    ));
}

?>