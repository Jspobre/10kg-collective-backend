<?php

include_once '../db_conn.php';

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    // $user_id = 

    $sql = "SELECT items.item_name, SUM(orders.order_qty) AS total_order_qty
            FROM orders
            JOIN items ON orders.item_id = items.item_id
            WHERE orders.user_id = $user_id AND orders.order_status != 'Canceled'
            GROUP BY items.item_name";

    $result = query($conn, $sql);


    echo json_encode($result);
}