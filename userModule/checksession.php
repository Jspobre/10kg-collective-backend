<?php
    include_once "../db_conn.php";

if(isset($_SESSION['user_id'])){


    $table = "orders";
    $fields = array(
        'user_id' => $user_id, // use the session variable to store user ID
        'item_id' => $item_id,
        'order_qty' => $order_qty,
        'item_variant' => $item_variant,
        'item_size' => $item_size,
        'order_status' => $order_status
    );


}else {
    echo "awit";
}