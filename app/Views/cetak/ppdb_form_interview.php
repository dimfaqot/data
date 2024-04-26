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
            <td rowspan="5" style="padding-right: -13px;"> <?= $data['logo']; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</td>
            <td rowspan="2" style="border: 1px solid green;padding:10px;text-align:center;font-weight:bold;font-size:20px;color:green"><?= $data['sub']; ?></td>
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
        <div>REKAP UJIAN TULIS DAN WAWANCARA</div>
        <div>SELEKSI MASUK PONPES WALISONGO SRAGEN</div>
        <div>TAHUN AJARAN <?= tahun_santri('ppdb'); ?>/<?= (tahun_santri('ppdb') + 1); ?></div>
    </div>

    <div style="padding:30px;">
        <table>
            <tr>
                <td style="width: 80px;padding:5px">Nama</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nama']; ?></th>
                <td></td>
                <td style="width: 80px;padding:5px">No. Ujian</td>
                <td style="width: 5px;padding:5px">:</td>
                <td style="padding:5px;"><?= $data['no_id']; ?></td>
            </tr>
            <tr>
                <td style="width: 80px;padding:5px">Sekolah Asal</td>
                <td style="width: 5px;padding:5px">:</td>
                <td style="padding:5px;vertical-align:top"><?= ($data['sekolah_asal'] == '' || $data['sekolah_asal'] == '-' ? '..........................................................................................................................' : $data['sekolah_asal']); ?></td>
                <td></td>
                <td style="width: 80px;padding:5px">Anak Ke</td>
                <td style="width: 5px;padding:5px">:</td>
                <td style="padding:5px;"> ........ dari ........</td>
            </tr>
            <tr>
                <td style="width: 80px;padding:5px">Alamat</td>
                <td style="width: 5px;padding:5px">:</td>
                <td colspan="4" style="padding:5px;vertical-align:top"><?= ($data['alamat_lengkap'] == '' || $data['alamat_lengkap'] == 0 ? '..........................................................................................................................' : $data['alamat_lengkap']); ?></td>

            </tr>
            <tr>
                <td colspan="7" style="padding-top:10px"></td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right;padding:25px;">Nilai Ujian Tulis: </td>
                <td style="border:1px solid black;padding:25px;"></td>
            </tr>
        </table>

        <h4 style="margin-bottom: 1px;">Rekap Hasil Wawancara</h4>
        <table>
            <tr>
                <th style="border: 1px solid black;vertical-align:middle;" rowspan="2">No</th>
                <th style="border: 1px solid black;vertical-align:middle;" rowspan="2">Kriteria</th>
                <th style="border: 1px solid black;vertical-align:middle;" rowspan="2">Hasil Wawancara</th>
                <th colspan="2" style="border: 1px solid black;vertical-align:middle;">Kesimpulan</th>
            </tr>
            <tr>
                <th style="border: 1px solid black;vertical-align:middle;">Baik</th>
                <th style="border: 1px solid black;vertical-align:middle;">Kurang</th>
            </tr>
            <tr>
                <td style="text-align: center;border: 1px solid black;padding:10px;width:40px">1</td>
                <td style="border: 1px solid black;padding:10px;width:100px">Kondisi Keluarga (Ekonomi & Keharmonisan)</td>
                <td style="border: 1px solid black;vertical-align:middle;padding:80px 40px;width:400px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
            </tr>
            <tr>
                <td style="text-align: center;border: 1px solid black;padding:10px;width:40px">2</td>
                <td style="border: 1px solid black;padding:10px;width:100px">Kesanggupan</td>
                <td style="border: 1px solid black;vertical-align:middle;padding:30px;width:400px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
            </tr>
            <tr>
                <td style="text-align: center;border: 1px solid black;padding:10px;width:40px">3</td>
                <td style="border: 1px solid black;padding:10px;width:100px">Kesehatan</td>
                <td style="border: 1px solid black;vertical-align:middle;padding:40px;width:400px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
            </tr>
            <tr>
                <td style="text-align: center;border: 1px solid black;padding:10px;width:40px">4</td>
                <td style="border: 1px solid black;padding:10px;width:100px">Sikap</td>
                <td style="border: 1px solid black;vertical-align:middle;padding:50px;width:400px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
            </tr>
            <tr>
                <td style="text-align: center;border: 1px solid black;padding:10px;width:40px">5</td>
                <td style="border: 1px solid black;padding:10px;width:100px">Mental</td>
                <td style="border: 1px solid black;vertical-align:middle;padding:50px;width:400px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
            </tr>
            <tr>
                <td style="text-align: center;border: 1px solid black;padding:10px;width:40px">6</td>
                <td style="border: 1px solid black;padding:10px;width:100px">Prestasi</td>
                <td style="border: 1px solid black;vertical-align:middle;padding:20px;width:400px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
                <td style="border: 1px solid black;vertical-align:middle;padding:10px"></td>
            </tr>
        </table>

        <div style="border: 1px solid black;margin-top:5px;padding:4px">
            <div style="font-weight: bold;font-size:large">Rekomendasi</div>
            <div style="font-weight: bold;font-size:x-large">
                LULUS/LULUS BERSYARAT/MUALLIMIN/GAGAL
            </div>
        </div>

        <table style="margin-top: 20px;">
            <tr>
                <td colspan="2" style="text-align: right;">Sragen, ____________________________</td>
            </tr>
            <tr>
                <td style="text-align: center;padding-top:20px">Penguji</td>
                <td style="text-align: center;padding-top:20px">Calon Santri</td>
            </tr>
            <tr>
                <td style="text-align: center;padding-top:60px">_________________________</td>
                <td style="text-align: center;padding-top:60px"><?= $data['nama']; ?></td>
            </tr>
        </table>
    </div>
</body>



</html>