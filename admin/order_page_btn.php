<?php

include_once "../db_conn.php";

if(isset($_POST['action'])){
    $order_id = $_POST['order_id'];
    if($_POST['action'] == "Confirm Order"){
        $query = "UPDATE orders 
                    SET order_status = ? 
                    WHERE order_id = ?";
        $order_status = "C";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $order_status, $order_id);
        if($stmt->execute()){
                echo 1;
                $stmt->close();
        }else {
            echo 0;
        }
    }
    if($_POST['action'] == "Order Paid"){
        $query = "UPDATE orders 
                    SET payment_status = ? 
                    WHERE order_id = ?";
        $payment_status = "Paid";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $payment_status, $order_id);
        if($stmt->execute()){
                echo 1;
                $stmt->close();
        }else {
            echo 0;
        }

    }
}