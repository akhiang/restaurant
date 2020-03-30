<?php
    require_once "../conn.php";

    $path = "../../../assets/images/menu/".basename($_FILES['image']['name']);
    $filename = $_FILES['image']['name'];
    $nama = $_POST['nama_menu'];
    $desc = $_POST['desc'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['image']['tmp_name'];
    
    $maxDimW = 174;
    $maxDimH = 116;
    list($width, $height, $type, $attr) = getimagesize( $gambar );
    if ( $width > $maxDimW || $height > $maxDimH ) {
        $target_filename = $gambar;
        $ratio = $width/$height;
        if( $ratio > 1) {
            $new_width = $maxDimW;
            $new_height = $maxDimH/$ratio;
        } else {
            $new_width = $maxDimW*$ratio;
            $new_height = $maxDimH;
        }
    $src = imagecreatefromstring( file_get_contents( $gambar ) );
    $dst = imagecreatetruecolor( $new_width, $new_height );
    
    imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
    imagedestroy( $src );
    imagejpeg( $dst, $target_filename ); // adjust format as needed
    imagedestroy( $dst );
    }
    
    $sqlCode = "SELECT MAX(kode_menu) as kode from tbl_menu";
    $qCode = $conn->query($sqlCode);
    $data = mysqli_fetch_assoc($qCode);

    $auto = $data['kode'];
    $auto = (int) substr($auto, 1, 3);
    $auto++;
    $kode = "M". sprintf('%03s',$auto);

    $sql = "INSERT INTO tbl_menu VALUES ('', '$kode', '$nama', '$desc', '$jenis', '$harga', '$filename', 1, 0)";

    $q = $conn->query($sql);

    move_uploaded_file($_FILES['image']['tmp_name'], $path)
?>