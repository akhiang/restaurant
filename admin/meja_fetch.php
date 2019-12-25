<?php
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT * FROM tb_meja";
    $result = $conn->query($sql);

    foreach ($result as $row) {
        if($row['status'] == 1){
            $status = '<a href="#" class="badge badge-success">Tersedia</a>';
        }
        else {
            $status = '<a href="#" class="badge badge-danger">Terisi</a>';
        }
        $sub_array = array();
        $sub_array[] = $row['kode_meja'];
        $sub_array[] = $row['nama_meja'];
        $sub_array[] = $status;
        $sub_array[] = '
                <a href="#" class="edit-meja badge badge-info mr-2" data-toggle="modal" data-target="#edit-meja-modal" data-mejaId="'.$row["kode_meja"].'"><i class="fa fa-pencil-alt p-1"></i></a>
                <a href="#" class="del-meja badge badge-danger" data-mejaId="'.$row["kode_meja"].'"><i class="fa fa-trash p-1"></i></a>
            ';
        $data[] = $sub_array;
    }
    
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>