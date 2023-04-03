<?php
include_once '../db_conn.php';
include "../userModule/checksession.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


    
       if(isset($_POST['item_id'])) {
            
            $user_id = $userFiltered['user_id'];
            $item_id = $_POST['item_id'];
            $item_size = $_POST['item_size'];
            $item_variant = $_POST['item_variant'];
            $order_qty = $_POST['order_qty'];

           
            $table = "orders";
            $fields = array('user_id' => $user_id
                ,'item_id' => $item_id
                ,'order_qty' => $order_qty,
                'item_variant' => $item_variant,
                'item_size' => $item_size,
                'order_status' => "P"
            );
       if(insert($conn, $table, $fields)){
           echo "sheesh";
           
        }else {
            die("hello");
        }
    }
   // var_dump($fields);

?>