<?php

include_once "../db_conn.php";

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $orders = json_decode($_POST['orders'], true); 

    foreach($orders as $order){
        $order_id = $order['order_id']; 
        $order_status = 'P'; 

        // Update the order_status
        $query = "UPDATE orders 
                    SET order_status = ?, date_ordered = CURRENT_TIMESTAMP 
                    WHERE order_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $order_status, $order_id);
        if($stmt->execute()){
                echo 1;
                $stmt->close();
        }
     
    }
}
?>