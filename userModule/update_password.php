<?php

include_once '../db_conn.php';

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    
      $result = query($conn, "SELECT * FROM user WHERE user_id = $user_id");


    if($result[0]['password'] == $current_pass){
        $stmt = $conn->prepare("UPDATE user SET password = ?");
        $stmt->bind_param("s", $new_pass);
        if($stmt->execute()){
            echo 1;
        }else {
            echo 2;
        }
    }else {
        echo 3;
    }
    // print_r($result);
    // echo $result[0]["password"];
}

?>