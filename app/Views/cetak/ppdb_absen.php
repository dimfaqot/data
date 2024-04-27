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

    <?php if ($order == 'tahapan') : ?>
        <div style="text-align: center;margin-top:10px;font-weight:bold">
            <div>ABSENSI TAHAPAN SELEKSI</div>
            <div>CALON SANTRI <?= strtoupper($sub); ?> PONPES WALISONGO SRAGEN</div>
            <div>TAHUN AJARAN <?= tahun_santri('ppdb'); ?>/<?= (tahun_santri('ppdb') + 1); ?></div>
        </div>

        <div style="padding:30px">
            <table>
                <tr>
                    <td style="width: 80px;padding:5px">No. Ujian</td>
                    <td style="width: 5px;padding:5px">:</td>
                    <td style="padding:5px;"><?= $data['no_id']; ?></td>
                    <td style="width: 15px;"></td>
                    <td style="width: 80px;padding:5px">Sekolah Asal</td>
                    <td style="width: 5px;padding:5px">:</td>
                    <td style="padding:5px;vertical-align:top"><?= ($data['sekolah_asal'] == '' || $data['sekolah_asal'] == '-' ? '.........................................................................' : $data['sekolah_asal']); ?></td>

                </tr>
                <tr>
                    <td style="width: 80px;padding:5px">Nama</td>
                    <td style="width: 5px;padding:5px">:</td>
                    <th style="text-align: left;padding:5px;width:250px;"><?= $data['nama']; ?></th>
                    <td style="width: 5px;"></td>
                    <td style="width: 80px;padding:5px">Daerah Asal</td>
                    <td style="width: 5px;padding:5px">:</td>
                    <td style="padding:5px;"><?= (alamat_lengkap($data) == 0 ? '.........................................................................' : alamat_lengkap($data)); ?></td>


                </tr>

            </table>

            <table style="margin-top: 40px;">
                <tr>
                    <th style="border: 1px solid black;padding:5px;">UJIAN TULIS</th>
                    <th style="border: 1px solid black;padding:5px;">KESEHATAN</th>
                    <th style="border: 1px solid black;padding:5px;">WAWANCARA</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;padding:45px;"></th>
                    <th style="border: 1px solid black;padding:45px;"></th>
                    <th style="border: 1px solid black;padding:45px;"></th>
                </tr>
                <tr>
                    <th colspan="3" style="padding-top:15px;text-align:right">
                        Panitia
                    </th>
                </tr>
                <tr>
                    <th colspan="3" style="padding-top:85px;text-align:right">
                        ______________________________
                    </th>
                </tr>
            </table>

        </div>
    <?php else : ?>
        <div style="text-align: center;margin-top:10px;font-weight:bold">
            <div>ABSENSI CALON WALI SANTRI</div>
            <div>SELEKSI MASUK <?= strtoupper($sub); ?> PONPES WALISONGO SRAGEN</div>
            <div>TAHUN AJARAN <?= tahun_santri('ppdb'); ?>/<?= (tahun_santri('ppdb') + 1); ?></div>
        </div>

        <table style="margin-top: 25px;">
            <tr>
                <th style="border: 1px solid black;padding:15px;width:40px">No.</th>
                <?php if ($order == 'ortu') : ?>
                    <th style="border: 1px solid black;padding:15px;width:250px">Ortu/Wali</th>
                <?php endif; ?>
                <?php if ($order == 'santri') : ?>
                    <th style="border: 1px solid black;padding:15px;width:140px">No. Pendaftaran</th>
                <?php endif; ?>
                <th style="border: 1px solid black;padding:15px;width:250px">Calon Santri</th>
                <th style="border: 1px solid black;padding:15px;width:140px">Ket</th>
                <th style="border: 1px solid black;padding:15px;">Ttd</th>
            </tr>
            <?php foreach ($data as $k => $i) : ?>

                <tr>
                    <td style="border: 1px solid black;padding:15px;text-align:center"><?= $k + 1; ?></td>
                    <?php if ($order == 'ortu') : ?>
                        <td style="border: 1px solid black;padding:15px;"><?= ($i['nama_ayah'] !== '' && $i['nama_ibu'] !== '' ? $i['nama_ayah'] . '/' . $i['nama_ibu'] : ($i['nama_ayah'] == '' && $i['nama_ibu'] == '' ? '...............................................................' : ($i['nama_ayah'] !== '' ? $i['nama_ayah'] : $i['nama_ibu']))); ?></td>
                    <?php endif; ?>
                    <?php if ($order == 'santri') : ?>
                        <td style="border: 1px solid black;padding:15px;text-align:center;"><?= $i['no_id']; ?></td>
                    <?php endif; ?>
                    <td style="border: 1px solid black;padding:15px;"><?= $i['nama']; ?><?= ($order == 'ortu' ? '/' . $i['no_id'] : ''); ?></td>
                    <td style="border: 1px solid black;padding:15px;"></td>
                    <td style="border: 1px solid black;padding:15px;"></td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php endif; ?>


</body>



</html>