<?php

include_once '../db_conn.php';


if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id'];
    $stmt = $conn->prepare("SELECT * from item_image WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);

    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);
    // print_r($data);

}