<?php
    include "../conn.php";

    $sql = "SELECT * FROM tbl_menu";
    $q = $conn->query($sql);
    $rows = [];

    while ($row = $q->fetch_assoc()) {
        $rows[] = $row;
    }
    foreach ($rows as $row) {
?>
    <tr>
        <td><?php echo $row['kode_menu'] ?></td>
        <td class="w-25">
        <img src="<?php echo '../assets/images/menu/'.$row['gambar']; ?>" class="img-fluid img-thumbnail">
        </td>
        <td><?php echo $row['nama_menu'] ?></td>
        <td><?php echo $row['jenis'] ?></td>
        <td align="center"><?php echo $row['stok'] ?></td>
        <td align="right"><?php echo $row['harga'] ?></td>
        <td>
        <a href="#" class="badge badge-info mr-2"><i class="fa fa-pencil-alt p-1"></i></a>
        <a href="#" class="badge badge-danger"><i class="fa fa-trash p-1"></i></a>
        </td>
    </tr>
<?php
    }
?>