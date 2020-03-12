<?php
    require_once "../conn.php";
    session_start();
    // date_default_timezone_set("Asia/Bangkok");
    $tipe = $_POST['tipe_id'];

    if($tipe == 2) {
        $kode_meja = '';
    } else {
        $kode_meja = $_POST['id_meja'];
        $sql = "UPDATE tb_meja set status = 0 WHERE kode_meja = $kode_meja";
        $q = $conn->query($sql);
    }
?>