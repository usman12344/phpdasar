<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$produk = query('SELECT * FROM produk');

$mpdf = new \Mpdf\Mpdf();
$html = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="css/print.css">
            </head>
            <body>
                    <h1>Tabel Produk</h1>
                        <table border=1 cellpadding=10 cellspacing=0>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>id Supplier</th>
                            <th>GAMBAR</th>
                        </tr>';

                    $i= 1;
                foreach( $produk as $as){
                    $html .= '
                    <tr>
                        <td>'. $i++ .'</td>
                        <td>'. $as["nama_barang"] .'</td>
                        <td>'. $as["harga"] .'</td>
                        <td>'. $as["stok"] .'</td>
                        <td>'. $as["id_supplier"] .'</td>
                        <td><img src="img/'. $as['gambar'].'" width="50px"></td>
                    </tr>
                    ';
                }

              $html .=      '</table>
            </body>
            </html>';
$mpdf->WriteHTML($html);
$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

?>
