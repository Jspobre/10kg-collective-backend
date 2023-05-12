<?php

include_once '../db_conn.php';

$reports;
//    specific date
if(isset($_POST['filter_date'])){
   $date = $_POST['filter_date'];

   $reports = query($conn, "SELECT DATE(orders.date_ordered) as date_ordered,  COUNT(*) as order_count,SUM(orders.order_qty * items.item_price) as total_sales
                           FROM orders
                           JOIN items ON orders.item_id = items.item_id
                           WHERE DATE(orders.date_ordered) = '$date' AND orders.payment_status = 'Paid'");
   
}else if(isset($_POST['filter_range'])) {
   // with range
   $date = json_decode($_POST['filter_range'],true);
   $start_date = $date['start_date'];
   $end_date = $date['end_date'];

   $reports = query($conn, "SELECT DATE(orders.date_ordered) AS date_ordered, COUNT(*) AS order_count,SUM(orders.order_qty * items.item_price) AS total_sales
                           FROM orders
                           JOIN items ON orders.item_id = items.item_id
                           WHERE DATE(orders.date_ordered) BETWEEN '$start_date' AND '$end_date' AND orders.payment_status = 'Paid'
                           GROUP BY DATE(orders.date_ordered)");
}else {
   // all dates
   $reports = query($conn, "SELECT DATE(orders.date_ordered) AS date_ordered, COUNT(*) AS order_count,SUM(orders.order_qty * items.item_price) AS total_sales
                              FROM orders
                              JOIN items ON orders.item_id = items.item_id
                              WHERE orders.payment_status = 'Paid'
                              GROUP BY DATE(orders.date_ordered)");

}




            // test
            //    $reports = query($conn, "SELECT orders.date_ordered, items.item_name, orders.order_qty, SUM(orders.order_qty * items.item_price) AS sales_amount
            //    FROM orders
            //    JOIN items  ON orders.item_id = items.item_id
            //    WHERE DATE(orders.date_ordered) = '2023-04-26'
            //    GROUP BY orders.date_ordered, items.item_name, orders.order_qty
            //    ");

               echo json_encode($reports);
               // echo $date['end_date'];

            //    , SUM(orders.order_qty * items.item_price) as TotalSales
            // GROUP BY date_ordered