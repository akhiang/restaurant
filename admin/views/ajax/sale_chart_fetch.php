<?php  
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT themonth, tb_order.order_status, SUM(tb_order.total) as amount
            FROM (
                SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AS themonth UNION ALL
                SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 2 MONTH UNION ALL
                SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 3 MONTH UNION ALL
                SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 4 MONTH UNION ALL
                SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 5 MONTH UNION ALL
                SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 6 MONTH UNION ALL
                SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 7 MONTH
            ) AS dates
            LEFT JOIN tb_order ON date >= themonth AND date < themonth + INTERVAL 1 MONTH
            WHERE order_status = 'paid' GROUP BY themonth";
    $q = $conn->query($sql);

    foreach ($q as $key => $row) {
        $data[] = $row;
    }

    for ($i = 0; $i < 7; $i++) {
        $months[] = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
    }
    
    $newMonths = checkMonth(reArray($data), $months);
    
    foreach ($newMonths as $key => $value) {
        array_push($data, $value);
    }

    usort($data, "sortByDate");
    echo json_encode($data);
?>