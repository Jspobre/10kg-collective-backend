<?php
include_once "../db_conn.php";

if(isset($_POST['order_id'])){

    $order_id = $_POST['order_id'];
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("i", $order_id);

    if($stmt->execute()){
        echo 1; 
    }else{
        echo 0;
    }
    

}
?>
