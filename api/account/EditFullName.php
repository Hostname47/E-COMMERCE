<?php

    // Because the id is stored within a hidden input along with the first and last name, before editing the account,
    // make sure that the id is no changed by comparing the submitted id with the session id, if they match, then OK,
    // otherwise print an error message

    include "../../config/DB.php";
    include "../../modules/account.php";

    header("Access-Control-Allow-Origin: *");
    header("Control-Type: Application/json");
    header("Access-Control-allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-allow-Methods, Authorization, X-Requested-Width");

    $database = new Database();
    $db = $database->connect();

    $account = new Account($db);

    $data = json_decode(file_get_contents("php://input"));

    $account->userid = $data->user_id;
    $account->firstname = $data->first_name;
    $account->lastname = $data->last_name;

    if($account->EditFullName()) {
        echo "Account edited successfully.";
    } else {
        echo "Account not edited.";
    }
    
?>