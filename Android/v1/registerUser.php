<?php
require_once('../includes/DbOperations.php');
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
        // create an object 
        $db = new DbOperations();

        $result = $db->createUser($_POST['username'], $_POST['password'], $_POST['email']);


        if($result == 1){
            $response['error'] = false;
            $response['message'] = "User registered successfully.";
        }elseif($result == 2){
            $response['error'] = true;
            $response['message'] = "Some error occurred please try again";
        }elseif($result == 0){
            $response['error'] = true;
            $response['message'] = "User already exists. Please choose a diffent email and username.";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
}else{
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}


echo  json_encode($response);
