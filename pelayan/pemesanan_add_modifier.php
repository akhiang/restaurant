<?php
    require_once "../conn.php";

    $modifier = $_POST['mie'];
    $user = $_POST['hidden_user_id'];
    $menu_id = $_POST['hidden_menu_id'];
    $menu_kode = $_POST['hidden_menu_kode'];
    $menu_nama = $_POST['hidden_menu_nama'];
    $menu_qty = $_POST['hidden_menu_qty'];
    $menu_harga = $_POST['hidden_menu_harga'];

    $sql = "INSERT INTO tb_cart_detail (user_id, kode_menu, nama_menu, qty, harga, id) VALUES
            ('$user', '$menu_kode','$menu_nama','$menu_qty','$menu_harga', '')";
    $q = $conn->query($sql);
    
    $sql = "INSERT INTO tb_cart_detail_modifier (id, user_id, menu_id, cart_item_id, modifier_id, qty) VALUES ";

    $it = new ArrayIterator( $modifier );
    $cit = new CachingIterator( $it );
    // loop over the array
    foreach ( $cit as $value )
    {
        $sql .= "('', '$user', '$menu_kode', LAST_INSERT_ID(), $value, 0)";
        if( $cit->hasNext() )
            {
                $sql .= ",";
            }
    }
    $q = $conn->query($sql);
?>