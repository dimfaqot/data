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
            <td style="font-weight:bold;">PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</td>

        </tr>
        <tr>
            <td style="font-weight: bold;font-size:15px">PONPES WALISONGO SRAGEN</td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;font-weight:bold">TAHUN AJARAN <?= tahun_santri('ppdb'); ?>/<?= tahun_santri('ppdb') + 1; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;font-style:italic;padding-top:5px">Sungkul - Plumbungan - Karangmalang - Sragen 081327380033</td>
        </tr>
    </table>
    <div style="text-align: center;margin-top:10px;font-weight:bold">
        <div>DATA CALON SANTRI SELEKSI WAWANCARA</div>
        <div>PONPES WALISONGO SRAGEN</div>
        <div>TAHUN AJARAN <?= tahun_santri('ppdb'); ?>/<?= (tahun_santri('ppdb') + 1); ?></div>
    </div>

    <div style="padding: 10px 40px 10px 40px;margin-top:10px;">
        <table>
            <tr>
                <th style="text-align: left; width:60px;">RUANG</th>
                <th style="text-align: left; width:10px">:</th>
                <th style="text-align: left;"><?= $ruang; ?></th>
            </tr>
            <tr>
                <th style="text-align: left;">Penguji</th>
                <th style="text-align: left;">:</th>
                <th style="text-align: left;"><?= $penguji; ?></th>
            </tr>
        </table>

        <table style="margin-top: 20px;">
            <tr style="border: 1px solid black;">
                <th style="border: 1px solid black;padding:5px;">No.</th>
                <th style="border: 1px solid black;padding:5px;">No. Pendaftaran</th>
                <th style="border: 1px solid black;padding:5px;">Nama</th>
                <th style="border: 1px solid black;padding:5px;">Sub</th>
            </tr>
            <?php foreach ($data as $k => $i) : ?>
                <tr style="border: 1px solid black;">
                    <td style="padding:5px;border: 1px solid black; text-align:center;width:50px"><?= ($k + 1); ?></td>
                    <td style="padding:5px;border: 1px solid black;text-align:center;width:120px"><?= $i['no_id']; ?></td>
                    <td style="padding:5px;border: 1px solid black;"><?= $i['nama']; ?></td>
                    <td style="padding:5px;border: 1px solid black;width:60px;text-align:center"><?= $i['sub']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

</body>



</html>