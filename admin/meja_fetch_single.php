<?php  
    require_once "../conn.php";
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_meja WHERE kode_meja = '$id'";  
    $q = $conn->query($sql); 
    $row = $q->fetch_assoc();  
    echo json_encode($row);  
?>