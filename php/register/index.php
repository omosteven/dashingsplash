<?php
//This is script to serve creating a new account as API

header("Access-Control-Allow-Origin: *");

include "../config/";

$check = mysqli_query($conn, "SELECT * FROM users WHERE EMAIL = '$_POST[email]'");

if (mysqli_num_rows($check) == 0) {

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $regTime = gmdate('Y-m-d G:i:s');

    $create = mysqli_query(

        $conn,

        "INSERT INTO users (

                FIRSTNAME, LASTNAME, EMAIL, PASSWORD, REGTIME, REGCODE, REFCODE, MYCODE, AMOUNT, ADMIN

            )   VALUES(

                '$_POST[firstName]', '$_POST[lastName]', '$_POST[email]', '$password', '$regTime', '$_POST[regCode]', '$_POST[refCode]', '$_POST[myCode]', '$_POST[amount]', 1

            )"
    );

    if ($create) {
        
        $res = array("type" => "registration", "response" => "success", "email" => $_POST['email'], "status" => 200);
        
        http_response_code(200);

        echo json_encode($res);
    
    } else {
    
        $res = array("type" => "registration", "response" => "failed", "email" => $_POST['email'], "status" => 400);
    
        http_response_code(400);

        echo json_encode($res);
    
    }

} else {

    $res = array("type" => "registration", "response" => "existing_account", "email" => $_POST['email'], "status" => 400);
    
    http_response_code(404);
    
    echo json_encode($res);

}