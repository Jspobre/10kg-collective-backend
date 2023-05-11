<?php

include_once "../db_conn.php";

if(isset($_POST["get_month"])){

    $result = query($conn, "SELECT months.month,
           COALESCE(monthly_sales.total_order_count, 0) AS total_order_count,
           COALESCE(monthly_sales.total_sales, 0) AS total_sales
    FROM (
      SELECT 'Jan' AS month, 1 AS month_order UNION ALL
      SELECT 'Feb', 2 UNION ALL
      SELECT 'Mar', 3 UNION ALL
      SELECT 'Apr', 4 UNION ALL
      SELECT 'May', 5 UNION ALL
      SELECT 'Jun', 6 UNION ALL
      SELECT 'Jul', 7 UNION ALL
      SELECT 'Aug', 8 UNION ALL
      SELECT 'Sep', 9 UNION ALL
      SELECT 'Oct', 10 UNION ALL
      SELECT 'Nov', 11 UNION ALL
      SELECT 'Dec', 12
    ) AS months
    LEFT JOIN (
      SELECT MONTH(date_ordered) AS month,
             COUNT(order_id) AS total_order_count,
             SUM(order_qty * item_price) AS total_sales
      FROM ORDERS
      JOIN ITEMS ON ORDERS.item_id = ITEMS.item_id
      WHERE payment_status = 'Paid'
      GROUP BY MONTH(date_ordered)
    ) AS monthly_sales ON months.month_order = monthly_sales.month
    ORDER BY months.month_order
    
    ");
    
                echo json_encode($result);
}