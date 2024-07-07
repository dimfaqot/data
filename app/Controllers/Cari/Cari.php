<?php

namespace App\Controllers\Cari;

use App\Controllers\BaseController;

class Cari extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
    }

    public function cari_nama_db()
    {
        $tabel = clear($this->request->getVar('tabel'));
        $val = $this->request->getVar('val');
        $gender = clear($this->request->getVar('gender'));

        $db = db($tabel, get_db($tabel));
        $db;
        if ($gender) {
            $db->where('gender', $gender);
        }
        $q = $db->like('nama', $val, 'both')->orderBy('nama', 'ASC')->limit(10)->get()->getResultArray();

        if ($tabel == 'karyawan') {
            $res = [];
            foreach ($q as $i) {
                $i['nama'] = nama_gelar($i);
            }
            $res[] = $i;
        }

        sukses_js('Koneksi sukses.', ($tabel == 'karyawan' ? $res : $q));
    }

    public function cari_daerah_db()
    {
        $data = json_decode(json_encode($this->request->getVar('data')), true);

        $db = db($data['tabel'], 'indonesia');

        $res = [];

        if ($data['tabel'] == 'provinsi') {
            $res = $db->like('name', $data['value'], 'both')->orderBy('name', 'ASC')->limit(10)->get()->getResultArray();
        }

        if ($data['tabel'] == 'kabupaten') {
            $dbn = db('provinsi', 'indonesia');
            $id = $dbn->where('name', $data['provinsi'])->get()->getRowArray();

            if (!$id) {
                if ($data['provinsi'] == '') {
                    $res = $db->like('name', $data['value'], 'both')->orderBy('name', 'ASC')->limit(10)->get()->getResultArray();
                    sukses_js('Koneksi sukses.', $res);
                }
                gagal_js('Provinsi tidak ditemukan!.');
            }
            $res = $db->where('provinsi_id', $id['id'])->like('name', $data['value'], 'both')->orderBy('name', 'ASC')->limit(10)->get()->getResultArray();
        }
        if ($data['tabel'] == 'kecamatan') {
            $dbn = db('kabupaten', 'indonesia');
            $id = $dbn->where('name', $data['kabupaten'])->get()->getRowArray();
            if (!$id) {
                gagal_js('Kabupaten tidak ditemukan!.');
            }
            $res = $db->where('kabupaten_id', $id['id'])->like('name', $data['value'], 'both')->orderBy('name', 'ASC')->limit(10)->get()->getResultArray();
        }
        if ($data['tabel'] == 'kelurahan') {
            $dbn = db('kecamatan', 'indonesia');
            $id = $dbn->where('name', $data['kecamatan'])->get()->getRowArray();
            if (!$id) {
                gagal_js('Kecamatan tidak ditemukan!.');
            }
            $res = $db->where('kecamatan_id', $id['id'])->like('name', $data['value'], 'both')->orderBy('name', 'ASC')->limit(10)->get()->getResultArray();
        }
        sukses_js('Koneksi sukses.', $res);
    }

    public function cari_lpk_db()
    {
        $tabel = clear($this->request->getVar('tabel'));
        $col = clear($this->request->getVar('col'));
        $value = clear($this->request->getVar('value'));

        $db = db($tabel, 'lpk');
        if ($tabel == 'siswa') {
            $q = $db->select('id,nama')->like($col, $value, 'both')->orderBy($col, 'ASC')->limit(10)->get()->getResultArray();
        } else {
            $q = $db->like($col, $value, 'both')->orderBy($col, 'ASC')->limit(10)->get()->getResultArray();
        }

        sukses_js('Koneksi sukses.', $q);
    }
}
