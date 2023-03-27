<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once '../db_conn.php';

// $itemlist = query($conn, "select * from items where item_status='A'");
$itemlist = query($conn, "SELECT * FROM items JOIN category ON items.item_category = category.category_id");






// Check if $itemlist is an array before encoding it to JSON
if (is_array($itemlist)) {
    $json_itemlist = json_encode($itemlist);
    // Do something with $json_itemlist, like sending it as a response to a request
    echo $json_itemlist;
} else {
    // Handle the case when $itemlist is not an array
    die("Maintenance Mode.");
}