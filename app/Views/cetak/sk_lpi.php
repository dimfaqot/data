<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>berkas/menu/karyawan.png" sizes="16x16">
    <style>
        /* table,
        td,
        th {
            border: 1px solid;
        } */

        tr {
            height: 10px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 2px;
        }
    </style>
    <title><?= $judul; ?></title>


</head>

<body style="font-size:13px;">

    <?= $data['kop']; ?>
    <div style="margin-top:5px; font-size:14px;">
        <div style="text-align: center;"><b>SURAT KEPUTUSAN</b></div>
        <div style="text-align: center;"><b>LPI SUNAN WALISONGO SRAGEN</b></div>
        <div style="text-align: center;"><b>Nomor: <?= $data['no_sk']; ?></b></div>
        <br>
        <div style="text-align: center;"><b>TENTANG</b></div>
        <div style="text-align: center;"><b>PENGANGKATAN PEGAWAI</b></div>

    </div>
    <h4 style="text-align: center;">Bismillahirrohmaanirrohim</h4>
    <table>
        <tr>
            <td style="width: 18%; vertical-align:top"><b>Menimbang</b></td>
            <td style="width: 2%; vertical-align:top"><b>:</b></td>
            <td style="width: 3%; vertical-align:top">1.</td>
            <td style="width: 77%; text-align:justify;">Bahwa untuk merealisasikan Visi, Misi, dan Tujuan <b>LEMBAGA PENDIDIKAN ISLAM SUNAN WALISONGO</b> Sragen</td>
        </tr>
        <tr>
            <td style="width: 18%;"></td>
            <td style="width: 2%;"></td>
            <td style="width: 3%; vertical-align:top">2.</td>
            <td style="width: 77%; text-align:justify;">Bahwa pegawai yang namanya tersebut dalam surat keputusan ini, dipandang mampu dan memenuhi syarat untuk tugas-tugas tersebut.</td>
        </tr>
        <br>
        <tr>
            <td style="width: 18%;"><b>Mengingat</b></td>
            <td style="width: 2%;"><b>:</b></td>
            <td style="width: 3%;">1.</td>
            <td style="width: 77%; text-align:justify;">Anggaran Dasar dan Anggaran Rumah Tangga <b>LEMBAGA PENDIDIKAN ISLAM SUNAN WALISONGO</b> Sragen</td>
        </tr>
        <tr>
            <td style="width: 18%;"></td>
            <td style="width: 2%;"></td>
            <td style="width: 3%;">2.</td>
            <td style="width: 77%; text-align:justify;">Peraturan Kepegawaian <b>LEMBAGA PENDIDIKAN ISLAM SUNAN WALISONGO</b> Sragen.</td>
        </tr>
        <br>
        <tr>
            <td style="width: 18%;vertical-align:top"><b>Memperhatikan</b></td>
            <td style="width: 2%;vertical-align:top"><b>:</b></td>
            <td style="width: 3%;vertical-align:top">1.</td>
            <td style="width: 77%; text-align:justify;">Hasil musyawarah <b>LEMBAGA PENDIDIKAN ISLAM SUNAN WALISONGO</b> Sragen pada tanggal <?= $data['rapat']; ?> di kantor <b>LPI Sunan Walisongo Sragen</b></td>
        </tr>
    </table>
    <br>
    <br>
    <div>Dengan selalu bertawakal dan memohon bimbingan serta petunjuk Allah SWT, pengurus <b>LEMBAGA PENDIDIKAN ISLAM SUNAN WALISONGO</b> Sragen</div>
    <br>
    <div style="text-align: center;"><b>MEMUTUSKAN</b></div>
    <br>
    <table>
        <tr>
            <td style="width: 18%;">Menetapkan</td>
            <td style="width: 2%;"><b></b></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="width: 18%;">PERTAMA</td>
            <td style="width: 2%;">:</td>
            <td style="width: 40%;">Pegawai di bawah ini:</td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 20%;">Nama</td>
            <td style="width: 2%;">:</td>
            <td style="width: 53%;"><?= $data['nama']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 20%;">Tempat / Tgl Lahir</td>
            <td style="width: 2%;">:</td>
            <td style="width: 53%;"><?= $data['ttl']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 20%;">NIL</td>
            <td style="width: 2%;">:</td>
            <td style="width: 53%;"><?= $data['no_id']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 20%;">Pendidikan</td>
            <td style="width: 2%;">:</td>
            <td style="width: 53%;"><?= $data['pendidikan']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 20%;">Jabatan</td>
            <td style="width: 2%;">:</td>
            <td style="width: 53%;"><?= $data['jabatan']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 20%;">Unit Kerja</td>
            <td style="width: 2%;">:</td>
            <td style="width: 53%;"><?= $data['sub']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 20%;">Jenis Kepegawaian</td>
            <td style="width: 2%;">:</td>
            <td style="width: 53%;">Guru Tetap Lembaga</td>
        </tr>
        <br>

    </table>
    <table>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 80%; text-align:justify; font-size:14px;">Terhitung mulai tanggal <?= $data['diangkat']; ?> diangkat menjadi pegawai LPI Sunan Walisongo Sragen</td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width: 18%;vertical-align: top;">KEDUA</td>
            <td style="width: 2%;vertical-align: top;">:</td>
            <td style="width: 80%; text-align:justify;">Apabila di kemudian hari ternyata terdapat kekeliruan dalam keputusan ini, akan diadakan perbaikan dan penghitungan kembali sebagaimana mestinya.</td>
        </tr>
        <tr>
            <td style="width: 18%;vertical-align: top;">KETIGA</td>
            <td style="width: 2%;vertical-align: top;">:</td>
            <td style="width: 80%; text-align:justify;">Petikan keputusan ini diberikan kepada yang bersangkutan dan yang berkepentingan untuk diketahui serta dipergunakan sebagaimana mestinya.</td>
        </tr>

    </table>
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td style="width:63%;"></td>
            <td style="width: 13%;">Ditetapkan di</td>
            <td style="width: 2%;"><b>:</b></td>
            <td style="width: 25%;">Sragen</td>
        </tr>
        <tr>
            <td style="width:63%;"></td>
            <td style="width: 13%;">Pada Tanggal</td>
            <td style="width: 2%;"><b>:</b></td>
            <td style="width: 25%;"><?= $data['penetapan']; ?></td>
        </tr>

    </table>
    <br>
    <table>
        <tr>
            <td style="width:63%;"></td>
            <td style="width: 37%; text-align:center;">Ketua</td>
        </tr>

    </table>
    <?php if ($data['is_ttd'] === false) : ?>
        <br>
        <br>
        <br>
        <br>
        <table>
            <tr>
                <td style="width:63%;"></td>
                <td style="width: 37%; text-align:center;"><?= $data['ketua_ypp']; ?></td>
            </tr>
        </table>
    <?php else : ?>
        <table>
            <tr>
                <td style="width:63%;"></td>
                <td style="width: 37%; text-align:center;"><?= $data['ttd']; ?></td>
            </tr>
            <tr>
                <td style="width:63%;"></td>
                <td style="width: 37%; text-align:center;"><?= $data['ketua_ypp']; ?></td>
            </tr>
        </table>
    <?php endif; ?>
</body>

</html>