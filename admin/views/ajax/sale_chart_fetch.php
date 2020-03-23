<?php  
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT d.themonth, SUM(total) as amount FROM (
                SELECT DATE(NOW()) as themonth UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 1 MONTH)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 2 MONTH)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 3 MONTH)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 4 MONTH)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 5 MONTH)) UNION ALL
                SELECT DATE(DATE_SUB( NOW(), INTERVAL 6 MONTH))) d LEFT OUTER JOIN
            tb_order o ON MONTH(o.date) = MONTH(d.themonth) GROUP BY d.themonth";
    $q = $conn->query($sql);
    foreach ($q as $row) {
        $data[] = $row;
    }
    echo json_encode($data);
?>