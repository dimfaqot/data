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
    public function cari_nama_santri()
    {
        $value = clear($this->request->getVar('value'));
        $col = clear($this->request->getVar('col'));

        $db = db('identitas', 'alumni');
        $q = $db->select('id,santri_id,alumni_id,nama_alumni')->whereIn($col, [''])->like('nama_alumni', $value, 'both')->orderBy('nama_alumni', 'ASC')->limit(10)->get()->getResultArray();

        if ($q) {
            $data = [];
            foreach ($q as $i) {
                $i['no_id'] = $i['santri_id'];
                $i['nama'] = $i['nama_alumni'];
                $data[] = $i;
            }
        } else {
            $db = db('santri', 'santri');
            $data = $db->select('no_id,nama')->whereIn('status', ['Lulus'])->whereNotIn('tahun_keluar', [0])->like('nama', $value, 'both')->orderBy('nama', 'ASC')->limit(10)->get()->getResultArray();
        }

        sukses_js('Koneksi sukses.', $data);
    }
    public function is_nama_alumni_exist()
    {
        $santri_id = clear($this->request->getVar('santri_id'));
        $nama_alumni = clear($this->request->getVar('nama_alumni'));
        $val = clear($this->request->getVar('val'));
        $col = clear($this->request->getVar('col'));

        $db = db('identitas', 'alumni');
        $q = $db->where('santri_id', $santri_id)->where($col, $val)->get()->getRowArray();

        if ($q) {
            gagal_js($nama_alumni . ' sudah ada di ' . upper_first($col) . ' ' . $val . '!.');
        }

        $q2 = $db->whereNotIn($col, [''])->where('santri_id', $santri_id)->get()->getRowArray();
        if ($q2) {
            if ($q2[$col] !== '') {
                gagal_js($nama_alumni . ' sudah ada di ' . upper_first($col) . ' ' . $q2[$col] . '!.');
            }
        }

        sukses_js('Koneksi sukses.');
    }

    public function get_daerah()
    {
        $text = clear($this->request->getVar('text'));

        $db = db('kabupaten', 'indonesia');

        $data = $db->like('name', $text, 'both')->limit(10)->get()->getResultArray();

        sukses_js('Koneksi sukses', $data);
    }
}
