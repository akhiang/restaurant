<?php
    require_once "../conn.php";

    $kode_meja = $_POST['meja_id'];
    
    if($kode_meja !== ''){
        echo 'tidak kosong';
        $sql = "UPDATE tb_meja set status = 1 WHERE kode_meja = $kode_meja";
        $q = $conn->query($sql);
    }    
?>