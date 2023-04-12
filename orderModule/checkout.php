<?php
include_once '../db_conn.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");



if(isset($_POST['item_id'])){
    $user_id = $_POST['user_id'];
    $item_id = $_POST['item_id'];
    $item_size = $_POST['item_size'];
    $item_variant = $_POST['item_variant'];
    $order_qty = $_POST['order_qty'];
    $order_status = "P";


        $table = "orders";
        $fields = array(
            'user_id' => $user_id, // use the session variable to store user ID
            'item_id' => $item_id,
            'order_qty' => $order_qty,
            'item_variant' => $item_variant,
            'item_size' => $item_size,
            'order_status' => $order_status
        );
        
        if(insert($conn, $table, $fields)){
            echo 1;

        } else {
            echo 0;
        }

}
  

?>