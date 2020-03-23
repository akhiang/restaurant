<?php
require_once '../../../vendor/autoload.php';
require_once "../conn.php";

$from = $_GET['from'];
$to = $_GET['to'];

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
                        <tr>
                            <td><h5>From</h5></td>
                            <td><h5>'.$from.'</h5></td>
                        </tr>
                        <tr>
                            <td><h5>To</h5></td>
                            <td><h5>'.$to.'</h5></td>
                        </tr>
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

    if($from == '' AND $to == ''){
        $sql = "SELECT *, m.nama_meja, u.username FROM tb_order o
                LEFT JOIN tb_meja m ON o.table_id = m.kode_meja
                LEFT JOIN tbl_user u ON o.user_id = u.id";
    } else {
        $sql = "SELECT *, m.nama_meja, u.username FROM tb_order o
                LEFT JOIN tb_meja m ON o.table_id = m.kode_meja
                LEFT JOIN tbl_user u ON o.user_id = u.id
                WHERE date BETWEEN '$from' AND '$to'";
    }
    $q = $conn->query($sql);
    $result = $q->num_rows;

    if ($result > 0) {
        foreach ($q as $key => $row)
        {
            $key+=1;
            $layout.=
            '
                <tr>
                    <td width="7%">'.$key.'</td>
                    <td width="15%">'.$row['order_number'].'</td>
                    <td>'.ucwords($row['order_status']).'</td>
                    <td>'.ucwords($row['table_id'] == 0 ? '-' : $row['nama_meja']).'</td>
                    <td>'.ucwords($row['username']).'</td>
                    <td>'.$row['date'].'</td>
                    <td>'.$row['time'].'</td>
                    <td>'.number_format($row['total'], 0, ',', '.').'</td>
                </tr>
            ';
        }
    } else {
        $layout.=
        '
            <tr>
                <td colspan="8">No data available in table</td>
            </tr>
        ';
    }

    $layout.=
    '
            </tbody>
        </table>
    </section>
    ';

$mpdf->WriteHTML($layout);
$mpdf->Output('invoice.pdf', 'I');

?>