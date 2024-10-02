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
            font-size: 20px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        td {
            height: 10px;
            padding-bottom: -10px;
        }


        tr {
            height: 20px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0px;
        }
    </style>

</head>

<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <table>
        <tr>
            <td rowspan="6" style="padding-right: 20px;"><?= $data['photo']; ?></td>
            <td style="vertical-align:top;width:200px">NIS</td>
            <td style="vertical-align:top;">:</td>
            <td style="vertical-align:top;padding-left:10px">
                <?= $data['no_id']; ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top;width:200px">Nama</td>
            <td style="vertical-align:top;">:</td>
            <td style="vertical-align:top;padding-left:10px">
                <?= $data['nama']; ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top;width:200px">Tempat, Tgl. Lahir</td>
            <td style="vertical-align:top;">:</td>
            <td style="vertical-align:top;padding-left:10px">
                <?= $data['ttl']; ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top;width:200px">Sekolah</td>
            <td style="vertical-align:top;">:</td>
            <td style="vertical-align:top;padding-left:10px">
                <?= sub($data['sub'])['lengkap']; ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top;width:200px">Orang Tua/Wali</td>
            <td style="vertical-align:top;">:</td>
            <td style="vertical-align:top;padding-left:10px">
                <?= $data['nama_ayah']; ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top;width:200px">Alamat</td>
            <td style="vertical-align:top;">:</td>
            <td style="vertical-align:top;padding-left:10px">
                <?= $data['alamat_lengkap']; ?>
            </td>
        </tr>

    </table>


</body>

</html>