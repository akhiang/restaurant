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
                    <th>#</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Used</th>
                </tr>       
            </thead>
            <tbody>
    ';

    $sql = "SELECT menu_id, menu_name, qty FROM tb_order_detail od
            LEFT JOIN tb_order o ON od.order_number = o.order_number ";
        
        if (isset($_GET['from']) AND isset($_GET['to'])) {
            $sql .= "WHERE date BETWEEN '".$_GET['from']."' AND '".$_GET['to']."' ";
        }

    $q = $conn->query($sql);
    $result = $q->num_rows;

    if ($result > 0) {
        foreach ($q as $key => $row)
        {    
            $result2 = $conn->query("SELECT * FROM tb_menu_ingredient WHERE menu_id = $row[menu_id]");
                // // var_dump($result2);
            foreach ($result2 as $key => $value) {
                // var_dump($result2);
                $ingreId = $value['ingredient_id'];
                // var_dump($ingreId);
                $result3 = $conn->query("SELECT * FROM tb_bahan WHERE id = '$ingreId'");
                foreach ($result3 as $key => $data) {                
                    $sub = [];
                    $sub[] = $row['menu_id'];
                    $sub[] = $data['id'];
                    $sub[] = ucwords($data['name']);
                    $sub[] = ucwords($data['unit']);
                    $sub[] = $row['qty'];
                    $sub[] = $row['qty'] * $value['use_qty'];                
                    $temp[] = $sub;
                }
            }
        }

        $temp2 = [];
        foreach ($temp as $key => $value) {        
            if (!array_key_exists($value[1], $temp2)) {
                $temp2[$value[1]] = 0;
            }
            $temp2[$value[1]] += $value[5];
        }

        foreach ($temp2 as $key => $value) {
            $sub_array = [];
            $ing = $conn->query("SELECT name, unit FROM tb_bahan WHERE id = '$key'")->fetch_assoc();
            $sub_array[] = ucwords($ing['name']);
            $sub_array[] = $ing['unit'];
            $sub_array[] = $value;
            $ingSold[] = $sub_array;
        }    

        foreach ($ingSold as $key => $value) {
            array_unshift($ingSold[$key], $key + 1);
        }

        foreach ($ingSold as $key => $value) {
            $layout.=
            '
                <tr>                    
                    <td align="center">'.ucwords($value[0]).'</td>
                    <td align="center">'.ucwords($value[1]).'</td>
                    <td align="center">'.$value[2].'</td>
                    <td align="center">'.ucwords($value[3]).'</td>
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
        </table>
    </section>
    ';

$mpdf->WriteHTML($layout);
$mpdf->Output('invoice.pdf', 'I');

?>