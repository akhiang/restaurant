<?php
    require_once "../conn.php";

    $path = "../assets/images/menu/".basename($_FILES['image']['name']);
    // var_dump($_POST);
    $nama = $_POST['nama_menu'];
    $desc = $_POST['desc'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['image']['name'];

    // var_dump($desc);

    $sqlCode = "SELECT MAX(kode_menu) as kode from tbl_menu";
    $qCode = $conn->query($sqlCode);
    $data = mysqli_fetch_assoc($qCode);

    $auto = $data['kode'];
    $auto = (int) substr($auto, 1, 3);
    $auto++;
    $kode = "M". sprintf('%03s',$auto);

    // $sql = "INSERT INTO tbl_menu (id, kode_menu, nama_menu, desc, jenis, harga, gambar, ready, deleted) VALUES
    //         ('', '$kode', '$nama', '$desc, '$jenis', '$harga', '$gambar', 1, 0)";

    $sql = "INSERT INTO tbl_menu VALUES
            ('', '$kode', '$nama', '$desc', '$jenis', '$harga', '$gambar', 1, 0)";

    $q = $conn->query($sql);

    move_uploaded_file($_FILES['image']['tmp_name'],$path)

    // if (move_uploaded_file($_FILES['image']['tmp_name'],$path)) {
    //     $msg = "succes";
    // }
    // else {
    //     $msg = "fail";
    // }

    // if($conn->affected_rows > 0)
    //     {
    //         echo "
    //             Ok
    //         ";
    //     }
    //     else
    //     {
    //         echo"
    //             gagagl
    //         ";
    //         echo mysqli_error($conn);
    //         header("Location:employee.php");
    //     }
?>