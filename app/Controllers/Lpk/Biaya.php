<?php

namespace App\Controllers\Lpk;

use App\Controllers\BaseController;
use App\Models\DataModel;

class Biaya extends BaseController
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

        return view('lpk/' . menu()['controller'], ['judul' => menu()['menu'] . ' Lpk', 'data' => $db->allData('nama_biaya=Asc')]);
    }

    public function add()
    {
        $nama_biaya = clear(upper_first($this->request->getVar('nama_biaya')));
        $jml_biaya = clear($this->request->getVar('jml_biaya'));

        $db = db(menu()['tabel'], 'lpk');
        if ($db->where('nama_biaya', $nama_biaya)->get()->getRowArray()) {
            gagal(base_url(menu()['controller']), 'Nama biaya sudah ada!.');
        }

        $data = [
            'nama_biaya' => $nama_biaya,
            'jml_biaya' => rp_to_int($jml_biaya)
        ];

        $db = new DataModel();
        $db->add($data);
    }

    public function update()
    {
        $id = clear($this->request->getVar('id'));
        $nama_biaya = clear(upper_first($this->request->getVar('nama_biaya')));
        $jml_biaya = clear($this->request->getVar('jml_biaya'));


        $db = db(menu()['tabel'], 'lpk');

        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal(base_url(menu()['controller']), 'No. id tidak ada!.');
        }

        if ($db->whereNotIn('id', [$id])->where('nama_biaya', $nama_biaya)->get()->getRowArray()) {
            gagal(base_url(menu()['controller']), 'Nama biaya sudah ada!.');
        }

        $q['nama_biaya'] = $nama_biaya;
        $q['jml_biaya'] = rp_to_int($jml_biaya);

        $db = new DataModel();
        $db->update($id, $q);
    }

    public function delete()
    {
        $data = json_decode(json_encode($this->request->getVar('data')), true);

        $db = new DataModel();
        $db->delete($data['id']);
    }
}
