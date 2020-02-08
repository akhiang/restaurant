<?php  
    require_once "../conn.php";
    $id = $_POST['meja_id'];

    $sql = "SELECT * FROM tb_meja WHERE kode_meja = '$id'";  
    $q = $conn->query($sql);
    $data = $q->fetch_assoc();
?>
    <input type="hidden" name="id_meja" value="<?php echo $data['kode_meja'] ?>">
    <input type="hidden" name="tipe_id" value="1">
    <input type="hidden" name="_token">