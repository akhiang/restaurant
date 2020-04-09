<?php
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT * FROM tbl_menu WHERE deleted = 0 ORDER BY sequence ASC";
    $result = $conn->query($sql);

    foreach ($result as $key => $row) {
        $sub_array = array();
        $sub_array[] = $key + 1;
        // $sub_array[] = $row['kode_menu'];
        $sub_array[] = '<img src="../../../assets/images/menu/'.$row["gambar"].'" class="img-fluid img-thumbnail">';
        $sub_array[] = ucwords($row['nama_menu']);
        $sub_array[] = ucwords($row['description']);
        $sub_array[] = ucwords($row['jenis']);
        $sub_array[] = number_format($row['harga'], 0, ',', '.');
        $sub_array[] = $row['ready'] == 1 ? '<span class="badge badge-primary">Ready</span>' : '<span class="badge badge-danger">Not ready</span>';
        $sub_array[] = $row['sequence'];
        $sub_array[] = '
                <a href="./menu_detail.php?no='.$row['id'].'" class="info-menu badge badge-primary mr-1" data-menuId="'.$row["id"].'"><i class="fa fa-eye p-1"></i></a>
                <a href="#" class="edit-menu badge badge-info mr-1" data-toggle="modal" data-target="#edit-menu-modal" data-menuId="'.$row["id"].'"><i class="fa fa-pencil-alt p-1"></i></a>
                <a href="#" class="del-menu badge badge-danger" data-menuId="'.$row["id"].'" data-menuName="'.$row["nama_menu"].'"><i class="fa fa-trash p-1"></i></a>
            ';
        $data[] = $sub_array;
    }
    
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>