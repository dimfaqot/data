<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>berkas/menu/karyawan.png" sizes="16x16">
    <style>
        table,
        td,
        th {
            border: 0px solid;

        }

        th,
        td {
            padding: 1px;
            vertical-align: top;
        }

        /* tr {
            height: 10px;
        } */

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0px;
        }
    </style>
    <title><?= $judul; ?></title>


</head>

<body style="font-size:12px;font-family: Arial, Helvetica, sans-serif;">

    <table>
        <tr>
            <td rowspan="5" style="padding-right: -13px;"> <?= $logo; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">PANITIA PENERIMAAN KARYAWAN BARU</td>

        </tr>
        <tr>
            <td style="font-weight: bold;font-size:15px">YAYASAN PONDOK PESANTREN WALISONGO SRAGEN</td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;font-weight:bold">TAHUN <?= date('Y'); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;font-style:italic;padding-top:5px">Sungkul - Plumbungan - Karangmalang - Sragen 085175006585</td>
        </tr>
    </table>


    <div style="text-align: center;margin-top:20px;font-weight:bold">
        <div>ABSENSI SELEKSI WAWANCARA CALON KARYAWAN</div>
    </div>

    <table style="margin-top: 25px;">
        <tr>
            <th style="border: 1px solid black;padding:15px;width:40px">No.</th>
            <th style="border: 1px solid black;padding:15px;width:250px">Nama</th>
            <th style="border: 1px solid black;padding:15px;width:40px">Sub</th>
            <th style="border: 1px solid black;padding:15px;width:200px">Posisi</th>
            <th style="border: 1px solid black;padding:15px;">Ttd</th>
        </tr>
        <?php foreach ($data as $k => $i) : ?>

            <tr>
                <td style="border: 1px solid black;padding:15px;"><?= $k + 1; ?></td>
                <td style="border: 1px solid black;padding:15px;"><?= $i['nama']; ?></td>
                <td style="border: 1px solid black;padding:15px;"><?= $i['sub']; ?></td>
                <td style="border: 1px solid black;padding:15px;"><?= $i['bidang_pekerjaan']; ?></td>
                <td style="border: 1px solid black;padding:15px;"></td>
            </tr>

        <?php endforeach; ?>

    </table>



</body>



</html>