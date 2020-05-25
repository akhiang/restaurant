<?php
    require_once "../conn.php";
    
    if (isset($_POST['from']) AND isset($_POST['to'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
    }
    
    $sql = "SELECT menu_id, menu_name, qty FROM tb_order_detail od
            LEFT JOIN tb_order o ON od.order_number = o.order_number ";

        if (isset($_POST['is_date'])) {
            if ($_POST['is_date'] == 'true') {                                
                $sql .= "WHERE date BETWEEN '2020-05-16' AND '2020-05-19'";
            }
        }

    $result = $conn->query($sql);    

    foreach ($result as $key => $row) {
        // $sub_array = array();        
        $result2 = $conn->query("SELECT * FROM tb_menu_ingredient WHERE menu_id = $row[menu_id]");
        // // var_dump($result2);
        foreach ($result2 as $key => $value) {
            // var_dump($result2);
            $ingreId = $value['ingredient_id'];
            // var_dump($ingreId);
            $result3 = $conn->query("SELECT * FROM tb_bahan WHERE id = '$ingreId'");
            foreach ($result3 as $key => $data) {                
                $sub = [];
                $sub[] = $row['menu_id'];
                $sub[] = $data['id'];
                $sub[] = ucwords($data['name']);
                $sub[] = ucwords($data['unit']);
                $sub[] = $row['qty'];
                $sub[] = $row['qty'] * $value['use_qty'];                
                $temp[] = $sub;
            }
        }
    }

    $temp2 = [];
    foreach ($temp as $key => $value) {        
        if (!array_key_exists($value[1], $temp2)) {
            $temp2[$value[1]] = 0;
        }
        $temp2[$value[1]] += $value[5];
    }

    foreach ($temp2 as $key => $value) {
        $sub_array = [];
        $ing = $conn->query("SELECT name, unit FROM tb_bahan WHERE id = '$key'")->fetch_assoc();
        $sub_array[] = ucwords($ing['name']);
        $sub_array[] = $ing['unit'];
        $sub_array[] = $value;
        $ingSold[] = $sub_array;
    }    

    foreach ($ingSold as $key => $value) {
        array_unshift($ingSold[$key], $key + 1);
    }    

    $output['data'] = $ingSold;
    echo json_encode($output);
?>