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
            <td rowspan="5" style="padding-right: -10px;"> <?= $data['logo']; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;font-size:10px">PANITIA PENERIMAAN KARYAWAN BARU</td>
            <td rowspan="2" style="border: 1px solid green;padding:9px;text-align:center;font-weight:bold;font-size:15px;color:green"><?= $data['sub']; ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;font-size:12px">YAYASAN PONDOK PESANTREN WALISONGO SRAGEN</td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;font-weight:400;font-size:x-small">TAHUN <?= date('Y'); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;font-style:italic;padding-top:5px;font-size:x-small">Sungkul - Plumbungan - Karangmalang - Sragen 085175006585</td>
        </tr>
    </table>
    <div style="text-align: center;margin-top:10px;font-weight:bold">
        FORM WAWANCARA CALON KARYAWAN <?= strtoupper($data['sub']); ?>
    </div>
    <div style="padding:30px;">
        <div style="font-weight: bold;"><?= hari(date('l'))['indo']; ?>, <?= date('d'); ?> <?= bulan(date('m'))['bulan']; ?> <?= date('Y'); ?></div>
        <table>
            <tr>
                <td style="width: 110px;padding:5px">Nama/usia</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nama']; ?> / <?= (umur($data['tgl_lahir']) < 18 ? '....' : umur($data['tgl_lahir'])); ?></th>
            </tr>
            <tr>
                <td style="width: 110px;padding:5px">Bidang Pekerjaan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['bidang_pekerjaan']; ?></th>
            </tr>
            <tr>
                <td style="width: 110px;padding:5px">Kampus S1</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['kampus_s1']; ?></th>
            </tr>
            <?php if ($data['kampus_s2'] !== '') : ?>
                <tr>
                    <td style="width: 110px;padding:5px">Kampus S2</td>
                    <td style="width: 5px;padding:5px">:</td>
                    <th style="text-align: left;padding:5px;"><?= $data['kampus_s2']; ?></th>
                </tr>

            <?php endif; ?>
            <tr>
                <td style="width: 110px;padding:5px">Alamat</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= alamat_lengkap($data); ?></th>
            </tr>
            <tr>
                <td style="width: 110px;padding:5px">Domisili</td>
                <td style="width: 5px;padding:5px">:</td>
                <td style="padding:5px;vertical-align:top">..............................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 110px;padding:5px">Penguji</td>
                <td style="width: 5px;padding:5px">:</td>
                <td style="padding:5px;vertical-align:top">..............................................................................................................................................................................</td>
            </tr>
        </table>

        <div style="font-weight: bold;margin-top:20px">CATATAN UMUM</div>
        <p>................................................................................................................................................................................................................</p>
        <p>................................................................................................................................................................................................................</p>
        <p>................................................................................................................................................................................................................</p>
        <p>................................................................................................................................................................................................................</p>

        <h4 style="margin-bottom: 1px;font-weight: bold;">MATERI WAWANCARA</h4>

        <table>
            <tr>
                <td style="width: 20px;padding:7px">1</td>
                <td style="width: 400px;padding:7px">Jarak dari rumah ke Walisongo berapa menit/km?</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">2</td>
                <td style="width: 400px;padding:7px">Pengalaman kerja (berapa tahun, menjadi apa, tempat kerja)?</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">3</td>
                <td style="width: 400px;padding:7px">Background keluarga:</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">a. Status perkawinan: ...............................................................................................................................................................</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">b. Pekerjaan suami/istri(usia/kondisi): ......................................................................................................................................</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">c. Jumlah anak/usia/sekolah: ....................................................................................................................................................</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">c. Pekerjaan/kegiatan sampingan: ............................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">4</td>
                <td style="width: 400px;padding:7px">Motifasi bekerja di Walisongo:</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">5</td>
                <td style="width: 400px;padding:7px">Siap dengan sistem, jumlah gaji traning, dan gaji bulanan?</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">6</td>
                <td style="width: 400px;padding:7px">Siap menerima tugas tambahan (waka, pembimbing lomba/les)?</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">7</td>
                <td style="width: 400px;padding:7px">Siap dengan kegiatan dan peraturan:</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">8</td>
                <td style="width: 400px;padding:7px">Pendapat tentang kontrak! Apakah Anda siap?</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">9</td>
                <td style="width: 400px;padding:7px">Riwayat penyakit (Hepatitis A/B, jantung, epilepsy, ayan, HIV, TBC):</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
            <tr>
                <td style="width: 20px;padding:7px">10</td>
                <td style="width: 400px;padding:7px">Pernah mondok? dan Afiliasi ormas?</td>
            </tr>
            <tr>
                <td></td>
                <td style="padding:7px" colspan="2">Jawab: .......................................................................................................................................................................................</td>
            </tr>
        </table>
    </div>
</body>



</html>