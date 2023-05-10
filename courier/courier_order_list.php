<?php

include_once '../db_conn.php';

$query = "SELECT * from orders
            JOIN items ON orders.item_id = items.item_id
            JOIN user ON orders.user_id = user.user_id
            WHERE orders.order_status = 'C'";

$orderlist = query($conn, $query);

// Check if $itemlist is an array before encoding it to JSON
if (is_array($orderlist)) {
    $json_orderlist = json_encode($orderlist);
    // Do something with $json_itemlist, like sending it as a response to a request
    echo $json_orderlist;
} else {
    // Handle the case when $itemlist is not an array
    die("Maintenance Mode.");
}