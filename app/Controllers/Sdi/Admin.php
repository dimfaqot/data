<?php

namespace App\Controllers\Sdi;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
        check_role();
    }
    public function index($tahun = null)
    {
        $tahun = ($tahun == null ? tahun_santri('ppdb') : $tahun);
        $db = db('ppdb', 'sdi');

        $db;
        if ($tahun !== 'All') {
            $db->where('tahun_masuk', $tahun);
        }
        $q = $db->orderBy('updated_at', 'DESC')->get()->getResultArray();

        $db = db('template_wa', 'data');
        $template_wa = $db->where('kode', 'ppdb_sdi')->get()->getRowArray();

        return view('sdi/admin', ['judul' => 'Admin - SDI -', 'data' => $q, 'template_wa' => $template_wa]);
    }

    public function add()
    {
        $tahun_masuk = clear($this->request->getVar('tahun_masuk'));
        $gender = clear($this->request->getVar('gender'));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $no_hp = upper_first(clear($this->request->getVar('no_hp')));
        $jenis_pendaftaran = upper_first(clear($this->request->getVar('jenis_pendaftaran')));
        $asal_tk = upper_first(clear($this->request->getVar('asal_tk')));

        $data = [
            'no_id' => last_no_id_ppdb($tahun_masuk, 'SDI'),
            'tahun_masuk' => $tahun_masuk,
            'jenis_pendaftaran' => $jenis_pendaftaran,
            'asal_tk' => $asal_tk,
            'tgl_lahir' => time(),
            'gender' => $gender,
            'kewarganegaraan' => 'Indonesia',
            'agama' => 'Islam',
            'nama' => $nama,
            'no_hp' => $no_hp,
            'created_at' => time(),
            'updated_at' => time(),
            'petugas' => session('nama')
        ];

        $db = db('ppdb', 'sdi');
        if ($db->insert($data)) {
            sukses(base_url('sdi-admin/' . $tahun_masuk), 'Insert data success.');
        } else {
            gagal(base_url('sdi-admin/' . $tahun_masuk), 'Insert data failed!.');
        }
    }

    public function detail($segmen, $no_id)
    {
        $db = db('ppdb', 'sdi');
        $q = $db->where('no_id', $no_id)->get()->getRowArray();

        if (!$q) {
            gagal(base_url('sdi-admin/' . tahun_santri('ppdb')), 'No. Id not found!.');
        }

        $cols = [];
        if ($segmen == 'identitas') {
            $cols = ['jenis_pendaftaran', 'asal_tk', 'nama', 'nisn', 'nik', 'gender', 'kota_lahir', 'tgl_lahir', 'usia', 'no_hp', 'agama', 'kewarganegaraan'];
        } elseif ($segmen == 'profile') {
            $cols = ['tinggi_badan', 'berat_badan',  'anak_ke', 'jml_saudara', 'tinggal_bersama', 'jarak_tempuh', 'asal_sekolah', 'alamat', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'kodepos'];
        } else {
            $cols = ['nama_' . $segmen, 'nik_' . $segmen, 'ttl_' . $segmen, 'pendidikan_' . $segmen, 'pekerjaan_' . $segmen, 'penghasilan_' . $segmen];
        }


        return view('sdi/detail', ['judul' => $q['nama'], 'data' => $q, 'cols' => $cols]);
    }

    public function update()
    {
        $no_id = clear($this->request->getVar('no_id'));
        $segmen = clear($this->request->getVar('segmen'));
        $db = db('ppdb', 'sdi');
        $q = $db->where('no_id', $no_id)->get()->getRowArray();

        if (!$q) {
            gagal(base_url('sdi-admin/' . tahun_santri('ppdb')), 'No. Id not found!.');
        }

        $cols = explode(",", clear($this->request->getVar('cols')));

        foreach ($cols as $i) {
            $val = clear($this->request->getVar($i));
            $q[$i] = $val;
        }

        if (in_array('tgl_lahir', $cols)) {
            $tgl = strtotime(clear($this->request->getVar('tgl_lahir')));
            $q['tgl_lahir'] = $tgl;
            $q['usia'] = umur($tgl);
        }

        $q['updated_at'] = time();
        $q['petugas'] = session('nama');

        $db->where('no_id', $no_id);
        if ($db->update($q)) {
            sukses(base_url('sdi-admin/detail-ppdb-sdi/' . $segmen . '/' . $no_id), 'Update data success.');
        } else {
            gagal(base_url('sdi-admin/detail-ppdb-sdi/' . $segmen . '/' . $no_id), 'Update data failed!.');
        }
    }
    public function delete()
    {
        $no_id = clear($this->request->getVar('no_id'));

        $db = db('ppdb', 'sdi');

        $q = $db->where('no_id', $no_id)->get()->getRowArray();

        if (!$q) {
            gagal_js('No. Id not found!.');
        }


        $db->where('no_id', $no_id);
        if ($db->delete()) {
            sukses_js('Delete data success.');
        } else {
            gagal_js('Delete data failed!.');
        }
    }

    public function cetak($order, $jwt)
    {
        $no_ids = decode_jwt($jwt);

        $cols = get_cols('ppdb', 'sdi');

        $db = db('ppdb', 'sdi');
        $data = $db->whereIn('no_id', $no_ids)->orderBy('nama', 'ASC')->get()->getResultArray();


        $judul = 'PPDB SDI TAHUN AJARAN' . tahun_santri('ppdb') . '/' . tahun_santri('ppdb') + 1;

        if (count($data) == 1) {
            $judul = 'DATA PPDB ' . strtoupper($data[0]['nama']);
        }

        if ($order == 'pdf') {

            $set = [
                'mode' => 'utf-8',
                'format' => [215, 330],
                'orientation' => 'P',
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
                'margin-bottom' => 0,
            ];
            $mpdf = new \Mpdf\Mpdf($set);


            foreach ($data as $i) {
                $i['logo'] = '<img width="80" src="' .  'berkas/sdi/logo.png" alt="Kop"/>';
                $i['alamat_lengkap'] = alamat_lengkap($i);
                $i['ttl'] = ttl($i);
                $html = view('cetak/ppdb_sdi', ['judul' => $judul, 'data' => $i]);
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }

            $this->response->setHeader('Content-Type', 'application/pdf');
            $mpdf->Output($judul . '.pdf', 'I');
        }

        if ($order == 'excel') {
            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();

            $huruf = 'Z';

            foreach ($cols as $k => $c) {
                $huruf++;
                if ($k < 26) {
                    $sheet->setCellValue(substr($huruf, -1) . '1', upper_first(str_replace("_", " ", $c)));
                } else {
                    $sheet->setCellValue('A' . substr($huruf, -1) . '1', upper_first(str_replace("_", " ", $c)));
                }
            }

            $rows = 2;
            $huruf = 'Z';
            foreach ($data as $i) {
                $i['tgl_lahir'] = date('d/m/Y', $i['tgl_lahir']);
                foreach ($cols as $k => $c) {
                    $huruf++;
                    if ($k < 26) {
                        $sheet->setCellValue(substr($huruf, -1) . $rows, $i[$c]);
                    } else {
                        $sheet->setCellValue('A' . substr($huruf, -1) . $rows, $i[$c]);
                    }
                }
                $huruf = 'Z';
                $rows++;
            }
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $judul . '.xlsx');
            header('Cache-Control: maxe-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');

            exit;
        }
    }

    public function update_template_wa()
    {

        $db = db('template_wa', 'data');
        $q = $db->where('kode', 'ppdb_sdi')->get()->getRowArray();

        if (!$q) {
            for ($i = 1; $i < 4; $i++) {
                $data = [
                    'kode' => 'ppdb_sdi',
                    'template_' . $i => $this->request->getVar('template_' . $i)
                ];

                $db->insert($data);
            }
        } else {
            for ($i = 1; $i < 4; $i++) {
                $q['template_' . $i] = $this->request->getVar('template_' . $i);
                $db->where('id', $q['id']);
                $db->update($q);
            }
        }

        sukses(base_url('sdi-admin'), 'Update template success.');
    }
}
