<?php
	require_once "../conn.php";

    $path = "../../../assets/images/menu/".basename($_FILES['image']['name']);
    $filename = $_FILES['image']['name'];
    $id = $_POST['id'];
    $nama = $_POST['nama_menu'];
    $desc = $_POST['desc'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $ready = $_POST['ready'];
    $sequence = $_POST['sequence'];
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

    if ($gambar == ''){
        $sql = "UPDATE tbl_menu SET nama_menu = '$nama', description = '$desc', jenis = '$jenis', harga = '$harga',
                ready = '$ready', sequence = '$sequence' WHERE id = '$id'";
    } else {
        $q = $conn->query("SELECT * FROM tbl_menu WHERE id = '$id'");
        $data = $q->fetch_assoc();
        $old_img = $data['gambar'];
        unlink("../../../assets/images/menu/".$old_img);
        $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $sql = "UPDATE tbl_menu SET nama_menu = '$nama', description = '$desc', jenis = '$jenis', harga = '$harga', 
                ready = '$ready', sequence = '$sequence', gambar = '$filename' WHERE id = '$id'";
    }
    $conn->query($sql);
?>
