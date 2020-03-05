<?php
    require_once "../conn.php";
    //update table
    $kode_meja = $_POST['meja_id'];
    
    if($kode_meja !== ''){
        // echo 'tidak kosong';
        $q = $conn->query("UPDATE tb_meja set status = 1 WHERE kode_meja = $kode_meja");
    }    
?>