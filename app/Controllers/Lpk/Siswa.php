<?php

namespace App\Controllers\Lpk;

use App\Controllers\BaseController;
use App\Models\DataModel;

class Siswa extends BaseController
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
        $db = new DataModel();

        return view('lpk/' . menu()['controller'], ['judul' => menu()['menu'] . ' Lpk', 'data' => $db->allData('nama=Asc')]);
    }

    public function add()
    {
        $username = strtolower(clear($this->request->getVar('username')));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $nik = clear($this->request->getVar('nik'));
        $hp = clear($this->request->getVar('hp'));
        $kota_lahir = upper_first(clear($this->request->getVar('kota_lahir')));
        $tgl_lahir = strtotime(clear($this->request->getVar('tgl_lahir')));
        $alamat = upper_first(clear($this->request->getVar('alamat')));
        $kelurahan = upper_first(clear($this->request->getVar('kelurahan')));
        $kecamatan = upper_first(clear($this->request->getVar('kecamatan')));
        $kabupaten = upper_first(clear($this->request->getVar('kabupaten')));
        $provinsi = upper_first(clear($this->request->getVar('provinsi')));

        if ($username !== '') {
            $db = db(menu()['tabel'], get_db(menu()['tabel']));
            $q = $db->where('username', $username)->get()->getRowArray();
            if ($q) {
                gagal(base_url(menu()['controller']), 'Username sudah ada!.');
            }
        }

        $db = new DataModel();

        $data = [
            'id' => $db->no_id_lpk(),
            'username' => $username,
            'nama' => $nama,
            'nik' => $nik,
            'hp' => $hp,
            'kota_lahir' => $kota_lahir,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi
        ];

        $files = [
            ['col' => 'akta', 'file' => $_FILES['akta']],
            ['col' => 'ktp', 'file' => $_FILES['ktp']],
            ['col' => 'kk', 'file' => $_FILES['kk']],
            ['col' => 'ijazah', 'file' => $_FILES['ijazah']]
        ];


        $db->addWithFile($data, $files);
    }
    public function update()
    {
        $id = strtolower(clear($this->request->getVar('id')));
        $username = strtolower(clear($this->request->getVar('username')));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $nik = clear($this->request->getVar('nik'));
        $hp = clear($this->request->getVar('hp'));
        $kota_lahir = upper_first(clear($this->request->getVar('kota_lahir')));
        $tgl_lahir = strtotime(clear($this->request->getVar('tgl_lahir')));
        $alamat = upper_first(clear($this->request->getVar('alamat')));
        $kelurahan = upper_first(clear($this->request->getVar('kelurahan')));
        $kecamatan = upper_first(clear($this->request->getVar('kecamatan')));
        $kabupaten = upper_first(clear($this->request->getVar('kabupaten')));
        $provinsi = upper_first(clear($this->request->getVar('provinsi')));

        if ($username !== '') {
            $db = db(menu()['tabel'], get_db(menu()['tabel']));
            $q = $db->whereNotIn('id', [$id])->where('username', $username)->get()->getRowArray();
            if ($q) {
                gagal(base_url(menu()['controller']), 'Username sudah ada!.');
            }
        }


        $db = new DataModel();
        $data = $db->singleData('id=' . $id);

        $data['id'] = $id;
        $data['username'] = $username;
        $data['nama'] = $nama;
        $data['nik'] = $nik;
        $data['hp'] = $hp;
        $data['kota_lahir'] = $kota_lahir;
        $data['tgl_lahir'] = $tgl_lahir;
        $data['alamat'] = $alamat;
        $data['kelurahan'] = $kelurahan;
        $data['kecamatan'] = $kecamatan;
        $data['kabupaten'] = $kabupaten;
        $data['provinsi'] = $provinsi;


        $files = [
            ['col' => 'akta', 'file' => $_FILES['akta']],
            ['col' => 'ktp', 'file' => $_FILES['ktp']],
            ['col' => 'kk', 'file' => $_FILES['kk']],
            ['col' => 'ijazah', 'file' => $_FILES['ijazah']]
        ];

        $db->updateWithFile($data, $files);
    }


    public function delete()
    {
        $data = json_decode(json_encode($this->request->getVar('data')), true);

        $db = new DataModel();
        $db->deleteWithFile($data['id'], ['akta', 'ktp', 'kk', 'ijazah']);
    }
}
