<?php

namespace App\Controllers\Lpk;

use App\Controllers\BaseController;
use App\Models\DataModel;

class Program extends BaseController
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

        return view('lpk/program', ['judul' => 'Program Lpk', 'data' => $db->allData('nama_program=Asc')]);
    }

    public function add()
    {
        $nama_program = clear(upper_first($this->request->getVar('nama_program')));

        $db = db(menu()['tabel'], 'lpk');
        if ($db->where('nama_program', $nama_program)->get()->getRowArray()) {
            gagal(base_url(menu()['controller']), 'Nama program sudah ada!.');
        }

        $data = [
            'nama_program' => $nama_program
        ];

        $db = new DataModel();
        $db->add($data);
    }

    public function update()
    {
        $id = clear($this->request->getVar('id'));
        $nama_program = clear(upper_first($this->request->getVar('nama_program')));



        $db = db(menu()['tabel'], 'lpk');

        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal(base_url(menu()['controller']), 'No. id tidak ada!.');
        }

        if ($db->whereNotIn('id', [$id])->where('nama_program', $nama_program)->get()->getRowArray()) {
            gagal(base_url(menu()['controller']), 'Nama program sudah ada!.');
        }

        $q['nama_program'] = $nama_program;

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
