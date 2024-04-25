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
            <td rowspan="5" style="padding-right: -13px;"> <?= $data['kop']; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</td>
        </tr>
        <tr>
            <td style="font-weight: bold;font-size:15px">PONPES WALISONGO SRAGEN</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid black;font-weight:bold">TAHUN AJARAN <?= tahun_santri('ppdb'); ?>/<?= tahun_santri('ppdb') + 1; ?></td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid black;font-style:italic">Sungkul - Plumbungan - Karangmalang - Sragen 081327380033</td>
        </tr>
    </table>
    <div style="padding: 5px 80px 5px 80px;">
        <p>Telah diterima pembayaran pendaftaran peserta didik baru di Ponpes Walisongo Sragen sejumlah <b><?= rupiah(tahun(tahun_santri('ppdb'))['ppdb']); ?></b> dengan keterangan sebagai berikut:</p>
        <div style="padding-left: 20px;">
            <table>
                <tr>
                    <td style="padding:3px;width:140px">Tanggal Pendaftaran</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= date('d'); ?> <?= bulan(date('m', $data['created_at']))['bulan']; ?> <?= date('Y', $data['created_at']); ?></th>
                </tr>
                <tr>
                    <td style="padding:3px;width:140px">Nama Calon Santri</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= $data['nama']; ?></th>
                </tr>
                <tr>
                    <td style="padding:3px;width:140px">No. Pendaftaran</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= $data['no_id']; ?></th>
                </tr>
                <tr>
                    <td style="padding:3px;width:140px">Jenis Kelamin</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= $data['gender']; ?></th>
                </tr>
                <tr>
                    <td style="padding:3px;width:140px">Ttl</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= ttl($data); ?></th>
                </tr>
                <tr>
                    <td style="padding:3px;width:140px">Sub</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= $data['sub']; ?></th>
                </tr>
                <tr>
                    <td style="padding:3px;width:140px">Orang Tua/Wali</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= ($data['nama_ayah'] !== '' ? $data['nama_ayah'] : ($data['nama_ibu'] !== '' ? $data['nama_ibu'] : $data['nama_wali'])); ?></th>
                </tr>
                <tr>
                    <td style="padding:3px;width:140px">No. Hp Orang Tua/Wali</td>
                    <td style="padding:3px;width: 10px;text-align:center">:</td>
                    <th style="padding:3px;text-align: left;"><?= ($data['hp_ayah'] !== '' ? $data['hp_ayah'] : ($data['hp_ibu'] !== '' ? $data['hp_ibu'] : $data['nama_wali'])); ?></th>
                </tr>
            </table>
        </div>
        <br>
        <table>
            <tr>
                <td rowspan="1" style="width:100px;border: 1px solid green;border-radius:10px;padding:10px;font-size:xx-large;color:green;font-weight:bold;text-align:center">
                    LUNAS
                </td>
                <td colspan="3" style="text-align: right;">Sragen, <?= date('d'); ?> <?= bulan(date('m'))['bulan']; ?> <?= date('Y'); ?></td>
            </tr>
            <tr>
                <td rowspan="1" colspan="3" style="padding-top:5px;font-weight:bold;color:red">Silahkan login dan lengkapi data melalui link atau scan Qr code di bawah ini:</td>
                <td style="text-align: right;">Petugas</td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top: 5px;"><a href="<?= $data['url']; ?>">walisongo.com/ppdb/<?= $data['no_id']; ?></a></td>
            </tr>
            <tr>
                <td rowspan="4" style="padding-top: 50px;">
                    <img width="150px" src="<?= set_qr_code($data['url'], 'ppdb', 'Ppdb'); ?>" alt="Ppdb <?= $data['nama']; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;padding-top:-20px;"><?= $data['petugas']; ?></td>

            </tr>
        </table>
    </div>
</body>


</html>