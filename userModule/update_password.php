<?php

include_once '../db_conn.php';

if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $current_pass = $_POST['current_pass'];
    $new_pass = password_hash($_POST['new_pass'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT password FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

        if(password_verify($current_pass, $row['password'])) {
            $stmt = $conn->prepare("UPDATE user SET password = ? WHERE user_id = ?");
            $stmt->bind_param("si", $new_pass, $user_id);

            if($stmt->execute()) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }
    } 
}

?>