<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;

class Ppdb_sdi extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
        check_role();
    }
    public function index($segmen = 'identitas')
    {
        $db = db('ppdb', 'sdi');
        $q = $db->where('no_id', session('no_id'))->get()->getRowArray();

        $cols = [];
        if ($segmen == 'identitas') {
            $cols = ['jenis_pendaftaran', 'nama', 'nisn', 'nik', 'gender', 'kota_lahir', 'tgl_lahir', 'usia', 'no_hp', 'agama', 'kewarganegaraan'];
        } elseif ($segmen == 'profile') {
            $cols = ['tinggi_badan', 'berat_badan',  'anak_ke', 'jml_saudara', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos', 'tinggal_bersama', 'jarak_tempuh', 'asal_sekolah'];
        } else {
            $cols = ['nama_' . $segmen, 'nik_' . $segmen, 'ttl_' . $segmen, 'pendidikan_' . $segmen, 'pekerjaan_' . $segmen, 'penghasilan_' . $segmen];
        }


        return view('member/identitas_ppdb_sdi', ['judul' => $q['nama'], 'data' => $q, 'cols' => $cols, 'segmen' => $segmen]);
    }



    public function update()
    {
        $no_id = session('no_id');
        $segmen = clear($this->request->getVar('segmen'));
        $db = db('ppdb', 'sdi');
        $q = $db->where('no_id', $no_id)->get()->getRowArray();

        if (!$q) {
            gagal(base_url('member-sdi'), 'No. Id not found!.');
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
            sukses(base_url('member-sdi/' . $segmen), 'Update data success.');
        } else {
            gagal(base_url('member-sdi/' . $segmen), 'Update data failed!.');
        }
    }
}
