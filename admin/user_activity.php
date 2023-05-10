<?php

include_once '../db_conn.php';




// SINGLE MONTH
// $reports = query($conn, "SELECT DATE_FORMAT(date_ordered, '%b') AS month,
//                         COUNT(DISTINCT user_id) AS userCount,
//                         SUM(order_qty) AS productSoldCount
//                         FROM ORDERS
//                         WHERE payment_status = 'Paid'
//                         GROUP BY month
//                         ORDER BY date_ordered ASC");
// $reports = query($conn, $query);

// ALL MONTHS
$reports = query($conn, "SELECT months.month AS month,
          COALESCE(orders.userCount, 0) AS userCount,
          COALESCE(orders.productSoldCount, 0) AS productSoldCount
          FROM
          (
            SELECT 'Jan' AS month UNION SELECT 'Feb' AS month UNION SELECT 'Mar' AS month
            UNION SELECT 'Apr' AS month UNION SELECT 'May' AS month UNION SELECT 'Jun' AS month
            UNION SELECT 'Jul' AS month UNION SELECT 'Aug' AS month UNION SELECT 'Sep' AS month
            UNION SELECT 'Oct' AS month UNION SELECT 'Nov' AS month UNION SELECT 'Dec' AS month
          ) AS months
          LEFT JOIN
          (
            SELECT DATE_FORMAT(date_ordered, '%b') AS month,
            COUNT(DISTINCT user_id) AS userCount,
            SUM(order_qty) AS productSoldCount
            FROM ORDERS
            WHERE payment_status = 'Paid'
            GROUP BY month
          ) AS orders
          ON months.month = orders.month
          ORDER BY FIELD(months.month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')");
// $reports = query($conn, "SELECT YEAR(date_ordered) AS year,
//           CONCAT('Week ', WEEK(date_ordered)) AS week,
//           COUNT(DISTINCT user_id) AS userCount,
//           SUM(order_qty) AS productSoldCount
//           FROM ORDERS
//           WHERE payment_status = 'Paid'
//           GROUP BY year, week
//           ORDER BY date_ordered ASC");


echo json_encode($reports);




// // Get the start and end dates of the current week
// $startOfWeek = date('Y-m-d', strtotime('this week monday'));
// $endOfWeek = date('Y-m-d', strtotime('this week sunday'));

// // Generate a sequence of dates for the week
// $query = "SELECT DATE_FORMAT('$startOfWeek' + INTERVAL seq DAY, '%a') AS day
//           FROM (
//             SELECT @rownum:=@rownum+1 AS seq
//             FROM
//               (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
//                UNION ALL SELECT 5 UNION ALL SELECT 6) t1,
//               (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
//                UNION ALL SELECT 5 UNION ALL SELECT 6) t2,
//               (SELECT @rownum:=0) t3
//             WHERE @rownum < DATEDIFF('$endOfWeek', '$startOfWeek') + 1
//           ) AS dates";
// $result = $conn->query($query);

// // Prepare the list of days of the week
// $daysOfWeek = [];
// while ($row = $result->fetch_assoc()) {
//   $daysOfWeek[] = $row['day'];
// }

// // Fetch the user activity data for the week
// $query = "SELECT DATE_FORMAT(date_ordered, '%a') AS day,
//           COUNT(DISTINCT user_id) AS userCount,
//           SUM(order_qty) AS productSoldCount
//           FROM ORDERS
//           WHERE payment_status = 'Paid'
//           AND DATE(date_ordered) >= '$startOfWeek'
//           AND DATE(date_ordered) <= '$endOfWeek'
//           GROUP BY day
//           ORDER BY FIELD(day, " . implode(',', array_map(function($day) {
//   return "'" . $day . "'";
// }, $daysOfWeek)) . ")";
// $result = $conn->query($query);

// // Prepare the data as an associative array
// $data = [];
// while ($row = $result->fetch_assoc()) {
//   $data[] = $row;
// }

// // Fill missing days with zero user activity
// $missingDays = array_diff($daysOfWeek, array_column($data, 'day'));
// foreach ($missingDays as $day) {
//   $data[] = [
//     'day' => $day,
//     'userCount' => 0,
//     'productSoldCount' => 0
//   ];
// }

// // Sort the data based on the day order
// usort($data, function($a, $b) use ($daysOfWeek) {
//   return array_search($a['day'], $daysOfWeek) - array_search($b['day'], $daysOfWeek);
// });

// // Send the response as JSON
// header('Content-Type: application/json');
// echo json_encode($data);

// // Close the database connection
// $conn->close();