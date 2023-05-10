<?php

include_once '../db_conn.php';



if(isset($_POST['item_id'])){

    $item_id = $_POST['item_id'];

    $stmt = $conn->prepare("UPDATE items
        SET item_status = 'I'
        WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    if($stmt->execute()){
        $stmt->close();
        $conn->close();
        echo 1;
    }else {
        echo 2;
    }
}