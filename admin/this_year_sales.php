<?php

include_once '../db_conn.php';

if(isset($_POST['get_year'])){

    $result = query($conn, "SELECT YEAR(date_ordered) AS year,
       COALESCE(SUM(order_qty), 0) AS total_order_count,
       COALESCE(SUM(order_qty * item_price), 0) AS total_sales
        FROM ORDERS
        JOIN ITEMS ON ORDERS.item_id = ITEMS.item_id
        WHERE payment_status = 'Paid'
            AND YEAR(date_ordered) = YEAR(CURRENT_DATE())
        GROUP BY YEAR(date_ordered)");


    echo json_encode($result);
}