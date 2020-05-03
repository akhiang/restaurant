<?php
require_once '../../../vendor/autoload.php';
require_once "../conn.php";

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'margin_top' => 10,
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_bottom' => 10,
    'margin_footer' => 5,
    'format' => 'A4',
    ]);

	$mpdf->SetHTMLFooter('
		<table width="100%" style="vertical-align: bottom; font-family: serif; 
            font-size: 8pt; color: #000000;">
            <tr>
                <td width="50%">{DATE Y-M-j}</td>
                <td width="50%" align="right">Page {PAGENO}/{nbpg}</td>
            </tr>
		</table>','O');

	$mpdf->SetHTMLFooter('
		<table width="100%" style="vertical-align: bottom; font-family: serif; 
            font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
            <tr>
                <td width="33%" align="center" style="font-weight: bold; font-style: italic;">Hal {PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right; ">{DATE Y-M-j}</td>
        </tr>
		</table>', 'E');

$layout = 
    '
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Invoice</title>
            <link rel="stylesheet" href="report.css">
        </head>
        <body>
            <section class="header">
                <div class="left">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <h2>Bakso Mas Ari</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Jl. Tebu No 8, Pontianak</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Telp (0561) 737895</h5>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="right">
                    <table style="width:100%">
                    ';

    if (isset($_GET['from']) AND isset($_GET['to'])) {
        $layout.='
                <tr>
                    <td align="center"><h5>Date Range</h5></td>
                    <td><h5>'.$_GET["from"].' - '.$_GET["to"].'</h5></td>
                </tr>';
    };

    if (isset($_GET['type'])) {
        $type = ($_GET['type'] == 'dine') ? 'Dine In' : 'Take Away';
        $layout.='
                <tr>
                    <td align="center"><h5>Order Type</h5></td>
                    <td align=""><h5>'.$type.'</h5></td>
                </tr>';
    };

    if (isset($_GET['status'])) {
        $layout.='
                <tr>
                    <td align="center"><h5>Order Status</h5></td>
                    <td><h5>'.ucwords($_GET["status"]).'</h5></td>
                </tr>';
    };

    $layout.='
                    </table>
                </div>
            </section>
    ';

    $layout.=
    '
    <section class="content my-2">
        <table>
            <thead>
                <tr>
                    <th width="12%">#</th>
                    <th>Order Number</th>
                    <th>Order Type</th>
                    <th>Order Status</th>
                    <th>Table</th>
                    <th>Waiter</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Total</th>
                </tr>       
            </thead>
            <tbody>
    ';

    $sql = "SELECT *, m.nama_meja, u.username FROM tb_order o
            LEFT JOIN tb_meja m ON o.table_id = m.kode_meja
            LEFT JOIN tbl_user u ON o.user_id = u.id
            LEFT JOIN tb_tipe_pesanan p ON o.order_type_id = p.id
            WHERE order_id IS NOT NULL ";
        
        if (isset($_GET['from']) AND isset($_GET['to'])) {
            $sql .= "AND date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ";
        }

        if (isset($_GET['type'])) {
            if ($_GET['type'] != '') {
                $type_id = ($_GET['type'] == 'dine') ? 1 : 2;
                $sql .= "AND order_type_id = '$type_id' ";
            }
        }

        if (isset($_GET['status'])) {
            if ($_GET['status'] != '') {
                $sql .= "AND order_status = '".$_GET['status']."' ";
            }
        }

    $q = $conn->query($sql);
    $result = $q->num_rows;

    if ($result > 0) {
        foreach ($q as $key => $row)
        {
            $total += $row['total'];
            $key+=1;
            $layout.=
            '
                <tr>
                    <td width="7%" align="center">'.$key.'</td>
                    <td width="15%" align="center">'.$row['order_number'].'</td>
                    <td align="center">'.ucwords($row['name']).'</td>
                    <td width="16%" align="center">'.ucwords($row['order_status']).'</td>
                    <td align="center">'.ucwords($row['table_id'] == 0 ? '-' : $row['nama_meja']).'</td>
                    <td align="center">'.ucwords($row['username']).'</td>
                    <td align="center">'.$row['date'].'</td>
                    <td align="center">'.$row['time'].'</td>
                    <td align="right">'.number_format($row['total'], 0, ',', '.').'</td>
                </tr>
            ';
        }
    } else {
        $layout.=
        '
            <tr>
                <td colspan="8" align="center">No data available in table</td>
            </tr>
        ';
    }

    $layout.=
    '
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" align="center">Total</td>
                    <td align="right">'.number_format($total, 0, ',', '.').'</td>
                </tr>
            </tfoot>
        </table>
    </section>
    ';

$mpdf->WriteHTML($layout);
$mpdf->Output('invoice.pdf', 'I');

?>