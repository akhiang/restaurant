<?php
    require_once "../conn.php";

    $data = array();
    $id = $_POST['id'];
    $sql = "SELECT mi.id, mi.use_qty, b.name, b.unit  FROM tb_menu_ingredient mi 
            LEFT JOIN tb_bahan b on mi.ingredient_id = b.id
            WHERE menu_id = '$id'";
    $result = $conn->query($sql);

    foreach ($result as $key => $row) {
        $sub_array = array();
        $sub_array[] = $key + 1;
        $sub_array[] = ucwords($row['name']);
        $sub_array[] = $row['unit'];
        $sub_array[] = $row['use_qty'];
        $sub_array[] = '
                <a href="#" class="edit-menu-det badge badge-info mr-2" data-toggle="modal" data-target="#edit-menu-detail-modal" data-id="'.$row["id"].'"><i class="fa fa-pencil-alt p-1"></i></a>
                <a href="#" class="del-menu-det badge badge-danger" data-id="'.$row["id"].'"><i class="fa fa-trash p-1"></i></a>
            ';
        $data[] = $sub_array;
    }
    
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>