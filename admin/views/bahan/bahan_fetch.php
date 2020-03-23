<?php
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT * FROM tb_bahan WHERE deleted = 0";
    $result = $conn->query($sql);

    foreach ($result as $key => $row) {
        $sub_array = array();
        $sub_array[] = $key + 1;
        $sub_array[] = ucwords($row['name']);
        $sub_array[] = $row['unit'];
        $sub_array[] = $row['qty'];
        $sub_array[] = '
                <a href="#" class="edit-ing badge badge-info mr-2" data-toggle="modal" data-target="#edit-ing-modal" data-ingId="'.$row["id"].'"><i class="fa fa-pencil-alt p-1"></i></a>
                <a href="#" class="del-ing badge badge-danger" data-ingId="'.$row["id"].'" data-ingName="'.$row["name"].'"><i class="fa fa-trash p-1"></i></a>
            ';
        $data[] = $sub_array;
    }
    
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>