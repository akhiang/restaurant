<?php  
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT d.thedate, COUNT(order_number) as orders FROM (
                SELECT DATE(NOW()) as thedate UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 1 DAY)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 2 DAY)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 3 DAY)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 4 DAY)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 5 DAY)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 6 DAY))) d LEFT OUTER JOIN
            tb_order o ON o.date = d.thedate GROUP BY d.thedate";
    $q = $conn->query($sql);
    foreach ($q as $row) {
        $data[] = $row;
    }
    echo json_encode($data);
?>