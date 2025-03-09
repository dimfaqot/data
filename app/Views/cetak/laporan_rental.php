<?php helper('qr_code'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul; ?></title>

    <style>
        table,
        td,
        th {
            border: 0px solid #033d62;
            padding: 0px;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        td {
            padding: 0px;
        }

        table {
            border-collapse: separate;
            border-spacing: 0px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        div {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>

</head>

<body>
    <table style="width:100%;">
        <tr>
            <td rowspan="4" style="width: 100px;"><?= $logo; ?></td>
            <td style="font-size:14px;">RENTAL WALISONGO</td>
        </tr>
        <tr>
            <th style="text-align: left;font-size:16px">RENTAL <?= strtoupper($order); ?></th>
        </tr>

        <tr>
            <td style="font-size: 12px;border-bottom:3px solid black">Persewaan nyaman dan aman</td>
        </tr>
        <tr>
            <td style="font-size: 10px;font-style:italic">Alamat: Sungkul - Plumbungan - Karangmalang - Sragen - 0989789898</td>
        </tr>
    </table>
    <h3 style="text-align: center;"><?= $judul; ?></h3>

    <h4>A. PEMASUKAN</h4>
    <table style="margin-top: 10px;width:100%;">
        <tr>
            <th style="border: 1px solid grey;padding:2px">No.</th>
            <th style="border: 1px solid grey;padding:2px">Sumber Anggaran</th>
            <th style="border: 1px solid grey;padding:2px">Saldo</th>

        </tr>

        <tr>
            <td style="text-align:center;border: 1px solid grey;padding:4px">1</td>
            <td style="border: 1px solid grey;padding:4px">Saldo Bulan <?= bulan($bulan_lalu)['bulan']; ?></td>
            <td style="text-align: right; border: 1px solid grey;padding:4px"><?= angka($saldo_bulan_lalu); ?></td>
        </tr>
        <tr>
            <td style="text-align:center;border: 1px solid grey;padding:4px">2</td>
            <td style="border: 1px solid grey;padding:4px">Saldo Bulan <?= bulan($bulan)['bulan']; ?></td>
            <td style="text-align: right; border: 1px solid grey;padding:4px"><?= angka($masuk - $keluar); ?></td>
        </tr>

        <tr>
            <th colspan="2" style="text-align:right;border: 1px solid grey;padding:4px">TOTAL SALDO</th>
            <th style="text-align:right;border: 1px solid grey;padding:4px"><?= angka($saldo_bulan_lalu + ($masuk - $keluar)); ?></th>
        </tr>
    </table>
    <h4>B. RINCIAN KEUANGAN</h4>
    <table style="margin-top: 10px;width:100%;">
        <tr>
            <th style="border: 1px solid grey;padding:2px">No.</th>
            <th style="border: 1px solid grey;padding:2px">Barang</th>
            <th style="border: 1px solid grey;padding:2px">Masuk</th>
            <th style="border: 1px solid grey;padding:2px">Keluar</th>
            <th style="border: 1px solid grey;padding:2px">Laba</th>

        </tr>

        <?php foreach ($data as $k => $i): ?>

            <tr>
                <td style="text-align:center;border: 1px solid grey;padding:4px"><?= ($k + 1); ?></td>
                <td style="border: 1px solid grey;padding:4px"><?= ($i['kategori'] == "Masuk" ? "Rental " . $i['pemakai'] : $i['barang']); ?></td>
                <td style="text-align: right;border: 1px solid grey;padding:4px"><?= angka($i['masuk']); ?></td>
                <td style="text-align:right; border: 1px solid grey;padding:4px"><?= angka($i['keluar']); ?></td>
                <td style="text-align: right; border: 1px solid grey;padding:4px"><?= angka(($i['masuk'] - $i['keluar'])); ?></td>
            </tr>

        <?php endforeach; ?>
        <tr>
            <th colspan="2" style="text-align:right;border: 1px solid grey;padding:4px">TOTAL</th>
            <th style="text-align:right;border: 1px solid grey;padding:4px"><?= angka($masuk); ?></th>
            <th style="text-align:right;border: 1px solid grey;padding:4px"><?= angka($keluar); ?></th>
            <th style="text-align:right;border: 1px solid grey;padding:4px"><?= angka(($masuk - $keluar)); ?></th>
        </tr>
    </table>


    <div style="text-align: right; font-size:small;margin-top:20px"><span style="font-size: 12px;"><?= date('d/m/Y'); ?></span> - <?= $petugas; ?></div>
    <div style="text-align: right;">
        <img width="100px;" src="<?= set_qr_code(base_url('public/rental/laporan/cetak/') . "/" . $order . "/" . $tahun . "/" . $bulan, 'rental', 'Rental'); ?>" alt="<?= $judul; ?>">
    </div>



</body>

</html>