<?php
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT * FROM tbl_menu";
    $result = $conn->query($sql);

    foreach ($result as $row) {
        $sub_array = array();
        $sub_array[] = $row['kode_menu'];
        $sub_array[] = '<img src="../assets/images/menu/'.$row["gambar"].'" class="img-fluid img-thumbnail">';
        $sub_array[] = $row['nama_menu'];
        $sub_array[] = $row['jenis'];
        $sub_array[] = $row['stok'];
        $sub_array[] = $row['harga'];
        $sub_array[] = '
                <a href="#" class="edit-menu badge badge-info mr-2" data-toggle="modal" data-target="#edit-menu-modal" data-menuId="'.$row["id"].'"><i class="fa fa-pencil-alt p-1"></i></a>
                <a href="#" class="del-menu badge badge-danger" data-menuId="'.$row["id"].'" data-menuName="'.$row["nama_menu"].'"><i class="fa fa-trash p-1"></i></a>
            ';
        $data[] = $sub_array;
    }
    
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>