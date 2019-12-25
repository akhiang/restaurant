<?php  
    require_once "../conn.php";

    $id = $_POST['id'];
    $sql = "SELECT * FROM tbl_user WHERE id = $id";  
    $q = $conn->query($sql); 
    $row = $q->fetch_assoc();  
    echo json_encode($row);  
?>