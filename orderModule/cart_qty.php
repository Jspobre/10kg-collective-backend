<?php

include_once "../db_conn.php";


if(isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_qty = $_POST['order_qty'];


        $sql = "UPDATE orders SET order_qty = ? WHERE order_id = ?";

        $stmt = mysqli_prepare($conn, $sql);
        $stmt->bind_param("ii",$order_qty, $order_id);
        if($stmt->execute()){
            echo 1; 
        }else{
            echo 0;
        }
    

}

?>