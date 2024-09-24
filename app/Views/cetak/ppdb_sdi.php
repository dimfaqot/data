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
            <td style="font-weight:bold;text-align:center;color:green">PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</td>
        </tr>
        <tr>
            <td style="font-weight: bold;font-size:25px;color:green;text-align:center">SD INTEGRAL WALISONGO</td>
        </tr>
        <tr>
            <td style="font-weight:bold;text-align:center;color:green">TAHUN PELAJARAN <?= tahun_santri('ppdb'); ?> - <?= tahun_santri('ppdb') + 1; ?></td>
        </tr>
        <tr>
            <td style="padding-top:5px;color:green;text-align:center">Alamat: Bangun Asri RT. 15 RW. 05, Plumbungan, Karangmalang, Sragen</td>
        </tr>
    </table>
    <div style="border-top: 2px solid green;border-bottom:1px solid green;height:4px"></div>

    <div style="background-color:lightgreen;text-align:center;font-weight:bold;padding:5px;margin-top:10px">IDENTITAS ANAK</div>
    <div style="padding:10px;">
        <table>
            <tr>
                <td style="width: 20px;padding:5px">1.</td>
                <td style="width: 150px;padding:5px">Nama Lengkap</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nama']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">2.</td>
                <td style="width: 150px;padding:5px">Jenis Kelamin</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['gender']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">3.</td>
                <td style="width: 150px;padding:5px">NIK</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nik']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">4.</td>
                <td style="width: 150px;padding:5px">Tempat/Tgl. Lahir</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['ttl']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">5.</td>
                <td style="width: 150px;padding:5px">Agama</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['agama']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">6.</td>
                <td style="width: 150px;padding:5px">Kewarganegaraan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['kewarganegaraan']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">7.</td>
                <td style="width: 150px;padding:5px">Alamat Lengkap</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['alamat_lengkap']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">8.</td>
                <td style="width: 150px;padding:5px">Tinggal Bersama</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['tinggal_bersama']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">9.</td>
                <td style="width: 150px;padding:5px">Anak Ke</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['anak_ke']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">10.</td>
                <td style="width: 150px;padding:5px">Usia</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['usia']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">11.</td>
                <td style="width: 150px;padding:5px">No. Hp</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['no_hp']; ?></th>

            </tr>

        </table>

        <div style="background-color:lightgreen;text-align:center;font-weight:bold;padding:5px;margin-top:10px">IDENTITAS ORANG TUA</div>

        <table>
            <tr>
                <td rowspan="6" style="width: 20px;padding:5px">1.</td>
                <td style="width: 150px;padding:5px">Nama Ayah</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nama_ayah']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">NIK</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nik_ayah']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Tempat/Tgl. Lahir</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['ttl_ayah']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Pendidikan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['pendidikan_ayah']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Pekerjaan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['pekerjaan_ayah']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Penghasilan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['penghasilan_ayah']; ?></th>

            </tr>



        </table>
        <table>
            <tr>
                <td rowspan="6" style="width: 20px;padding:5px">2.</td>
                <td style="width: 150px;padding:5px">Nama Ibu</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nama_ibu']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">NIK</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nik_ibu']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Tempat/Tgl. Lahir</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['ttl_ibu']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Pendidikan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['pendidikan_ibu']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Pekerjaan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['pekerjaan_ibu']; ?></th>

            </tr>
            <tr>
                <td style="width: 150px;padding:5px">Penghasilan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['penghasilan_ibu']; ?></th>

            </tr>



        </table>

        <div style="background-color:lightgreen;text-align:center;font-weight:bold;padding:5px;margin-top:10px">PERIODIK</div>

        <table>
            <tr>
                <td style="width: 20px;padding:5px">1.</td>
                <td style="width: 150px;padding:5px">Tinggi Badan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['tinggi_badan']; ?> Cm</th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">2.</td>
                <td style="width: 150px;padding:5px">Berat Badan</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['berat_badan']; ?> Kg</th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">3.</td>
                <td style="width: 150px;padding:5px">Jumlah Saudara</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['jml_saudara']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">4.</td>
                <td style="width: 150px;padding:5px">Jarak Tempuh</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['jarak_tempuh']; ?> Km</th>

            </tr>
        </table>

        <div style="background-color:lightgreen;text-align:center;font-weight:bold;padding:5px;margin-top:10px">REGISTER</div>

        <table>
            <tr>
                <td style="width: 20px;padding:5px">1.</td>
                <td style="width: 150px;padding:5px">Jenis Pendaftaran</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['jenis_pendaftaran']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">2.</td>
                <td style="width: 150px;padding:5px">Asal Sekolah</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['asal_sekolah']; ?></th>

            </tr>
            <tr>
                <td style="width: 20px;padding:5px">3.</td>
                <td style="width: 150px;padding:5px">No. Induk Siswa (NISN)</td>
                <td style="width: 5px;padding:5px">:</td>
                <th style="text-align: left;padding:5px;"><?= $data['nisn']; ?></th>

            </tr>
        </table>

        <table style="margin-top: 20px;">
            <tr>
                <td style="width: 300px;"></td>
                <td style="border: 1px solid green;padding-left:20px;padding-right:20px;padding-bottom:80px; text-align:center">Orang Tua Siswa</td>
                <td style="width: 30px;"></td>
                <td style="border: 1px solid green;padding-left:20px;padding-right:20px;padding-bottom:80px; text-align:center">Panitia PPDB</td>
            </tr>
        </table>
    </div>
</body>



</html>