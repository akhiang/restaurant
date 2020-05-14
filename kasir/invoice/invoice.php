<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once "../../conn.php";

$order_number = $_GET['o'];

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'margin_top' => 5,
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_bottom' => 5,
    'margin_footer' => 5,
    'format' => [130, 150]
    ]);
// $mpdf->SetDisplayMode(200);

$order_number = $_GET['o'];
$sql = "SELECT * FROM tb_order WHERE order_number = '$order_number'";
$q = $conn->query($sql); 
$d = $q->fetch_assoc();

$layout = 
    '
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Invoice</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <section class="header">
                <div class="left">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <h4>Bakso Mas Ari</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Jl. Tebu No 8, Pontianak</h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Telp (0561) 737895</h6>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="right">
                    <table style="width:100%" class="">
                        <tr>
                            <td><h5>Order Number</h5></td>
                            <td><h5>'.$order_number.'</h5></td>
                        </tr>
                        <tr>
                            <td><h5>Customer</h5></td>
                            <td><h5>'.$d["customer_name"].'</h5></td>
                        </tr>
                        <tr>
                            <td><h5>Date</h5></td>
                            <td><h5>'.date("d/m/Y", strtotime($d["date"])).'</h5></td>
                        </tr>
                    </table>
                </div>
            </section>
    ';

    $layout.=
    '
            <section class="content my-2">
                <table style="width:100%" id="menu">
                    <thead>
                        <tr>
                            <th width="12%">#</th>
                            <th>Menu</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
    ';

    $sql = "SELECT *, nama_menu FROM tb_order_detail O
        JOIN tbl_menu M ON O.menu_id = M.id
        WHERE order_number = '$order_number' AND cancel = 0";
    $q = mysqli_query($conn,$sql);
    $no = 1;
    while ($row = mysqli_fetch_assoc($q)) {
        $layout.=
        '
            <tr>
                <td align="center">'.$no.'</td>
                <td>'.ucwords($row['nama_menu']).'</td>
                <td align="center">'.$row['qty'].'</td>
                <td align="right">'.number_format($row['price'], 0, ',', '.').'</td>
                <td align="right">'.number_format($row['price'] * $row['qty'], 0, ',', '.').'</td>
            </tr>
        ';
        $no++;
    }

    $layout.=
    '
                    </tbody>
                </table>
            </section>
    ';

    $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$order_number' AND cancel = 0";
    $q = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($q)) {
        $amount = $row['price'] * $row['qty'];
        $subtotal += $amount;
    }
    $tax = $subtotal * 0.1;
    $total = number_format($subtotal + $tax, 0, ',', '.');

    $layout.=
    '
        <section class="footer">
                <div class="left">
                    <h5>Thank you for your business</h5>
                </div>
                <div class="right">
                    <table style="width:100%" id="footer">
                        <tr>
                            <td>Subtotal</td>
                            <td align="right">'.number_format($subtotal, 0, ',', '.').'</td>
                        </tr>
                        <tr>
                            <td>Tax 10%</td>
                            <td align="right">'.number_format($tax, 0, ',', '.').'</td>
                        </tr>
                        <tr>
                            <td class="total"><b>Total</b></td>
                            <td align="right" class="total"><b>Rp '.$total.'</b></td>
                        </tr>
                    </table>
                </div>
            </section>
        </body>
        </html>
    ';

$mpdf->WriteHTML($layout);
$mpdf->Output('invoice.pdf', 'I');

?>