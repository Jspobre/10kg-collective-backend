<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once '../db_conn.php';

        if(isset($_POST['item_id'])){
            $user = $_POST['user_id'];
            $item_id = $_POST['item_id'];
            $item_size = $_POST['item_size'];
            $item_variant = $_POST['item_variant'];
            $order_qty = $_POST['order_qty'];
            $status = "C";

            $table = "orders";

            $fields = array( 'user_id' => $user,
                            'item_id' => $item_id,
                            'item_size' => $item_size,
                            'item_variant' => $item_variant,
                            'order_qty' => $order_qty,
                            'order_status' => $status


        );

                if(insert($conn,$table,$fields)){
                        echo 1;

                }else{
                    echo 0;
                }

        }