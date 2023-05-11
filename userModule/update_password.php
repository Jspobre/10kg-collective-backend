<?php

include_once '../db_conn.php';

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $current_pass = $_POST['current_pass'];
    $new_pass = password_hash($_POST['new_pass'], PASSWORD_BCRYPT);
    
      $result = query($conn, "SELECT * FROM user WHERE user_id = $user_id");


    if(password_verify( $current_pass, $result[0]['password'] )){
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
  
}

?>