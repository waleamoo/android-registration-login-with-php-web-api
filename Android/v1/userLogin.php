<?php
require_once('../includes/DbOperations.php');
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['username']) && isset($_POST['password'])){
        $db = new DbOperations();
        if($db->userLogin($_POST['username'], $_POST['password'])){
            $user = $db->getUserByUsername($_POST['username']);
            $response['error'] = false;
            $response['id'] = $user['id'];
            $response['email'] = $user['email'];
            $response['username'] = $user['username'];
        }else{
            $response['error'] = true;
            $response['message'] = "Sorry, combination of email and password does not match";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
}


echo  json_encode($response);
