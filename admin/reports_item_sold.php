<?php

include_once '../db_conn.php';

if(isset($_POST['date_ordered'])){
    $date = $_POST['date_ordered'];
    $reports = query($conn, "SELECT items.item_name,  COUNT(*) as order_count, SUM(orders.order_qty * items.item_price) as sales_amount
                           FROM orders
                           JOIN items ON orders.item_id = items.item_id
                           WHERE DATE(orders.date_ordered) = '$date'
                           GROUP BY items.item_name");
   
}

echo json_encode($reports);