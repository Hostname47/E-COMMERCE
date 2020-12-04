<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/JSON");

include "../../config/DB.php";
include "../../modules/Account.php";

$database = new Database();
$db = $database->connect();

// The reason why I used plural in naming is because I want to use this object only to get all the users
$users = new Account($db);

$result = $users->read();

$num = $result->rowCount();

if($num > 0) {
    $user_arr = array();
    $user_arr['data'] = array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_item = array(
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

        array_push($user_arr['data'], $user_item);
    }

    // Turn users' data to JSON objects and output
    echo json_encode($user_arr);
} else {
    return json_encode(array(
        "message"=>"No user found"
    ));
}

?>