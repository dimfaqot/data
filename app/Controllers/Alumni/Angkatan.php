<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use App\Models\DataModel;

class Angkatan extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
        check_role();
    }
    public function index()
    {
        $db = db('identitas', 'alumni');
        $db->select('id,santri_id,alumni_id,nama_alumni,angkatan,region');
        if (session('role') !== 'Root') {
            $db->where('angkatan', session('info'));
        }
        $q = $db->orderBy('nama_alumni', 'ASC')->get()->getResultArray();

        return view('alumni/' . menu()['controller'], ['judul' => 'Alumni ' . menu()['menu'], 'data' => $q]);
    }

    public function add()
    {
        $santri_id = clear($this->request->getVar('santri_id'));
        $value = clear($this->request->getVar('value'));
        $nama_alumni = upper_first(clear($this->request->getVar('nama_alumni')));

        $dbe = db('identitas', 'alumni');
        $q = $dbe->where('santri_id', $santri_id)->get()->getRowArray();

        if ($q) {
            if ($q['angkatan'] == '') {
                $q['angkatan'] = $value;
                $dbe->where('id', $q['id']);
                if ($dbe->update($q)) {
                    sukses_js('Data sukses disimpan.');
                } else {
                    gagal_js('Data gagal disimpan!.');
                }
            } else {
                gagal_js($nama_alumni . ' sudah ada di angkatan ' . $q['angkatan'] . '!.');
            }
        }

        $db = new DataModel();

        $data = [
            'alumni_id' => $db->no_id_alumni($santri_id),
            'nama_alumni' => $nama_alumni,
            'santri_id' => $santri_id,
            'angkatan' => $value,
            'profile_alumni' => 'file_not_found.jpg'
        ];

        $dba = db('identitas', 'alumni');

        if ($dba->insert($data)) {
            sukses_js('Data sukses disimpan.');
        } else {
            gagal_js('Data gagal disimpan!.');
        }
    }

    public function detail()
    {
        $id = clear($this->request->getVar('id'));
        $santri_id = clear($this->request->getVar('santri_id'));
        $judul = clear($this->request->getVar('judul'));
        $dba = db('identitas', 'alumni');
        $q = $dba->where('id', $id)->get()->getRowArray();
        $res = [];

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }
        if ($judul == 'Riwayat') {
            $db = db('santri', 'santri');
            $data = $db->where('no_id', $santri_id)->get()->getRowArray();
            if ($data) {
                $data['alamat_lengkap'] = alamat_lengkap($data);
                $data['ttl'] = ttl($data);
                $res = $data;
            }

            sukses_js('Koneksi sukses.', $res);
        } else {
            $db = new DataModel();
            sukses_js('Koneksi sukses.', $db->singleData('id=' . $id));
        }
    }
    public function update()
    {
        $id = clear($this->request->getVar('id'));
        $cols = clear($this->request->getVar('cols'));

        $arr_cols = explode(",", $cols);

        $db = db('identitas', 'alumni');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        foreach ($arr_cols as $i) {
            if ($i == 'email_alumni' || $i == 'ig_alumni' || $i == 'tiktok_alumni') {
                $q[$i] = strtolower(clear($this->request->getVar($i)));
            } else {
                $q[$i] = upper_first(clear($this->request->getVar($i)));
            }
        }

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Data berhasil diupdate.');
        } else {
            gagal_js('Data gagal diupdate!.');
        }
    }
    public function delete()
    {
        $id = clear($this->request->getVar('id'));
        $col = clear($this->request->getVar('col'));

        $db = db('identitas', 'alumni');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q[$col] = '';

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Data berhasil dihapus.');
        } else {
            gagal_js('Data gagal dihapus!.');
        }
    }
}
