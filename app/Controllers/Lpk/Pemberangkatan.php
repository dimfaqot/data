<?php

namespace App\Controllers\Lpk;

use App\Controllers\BaseController;
use App\Models\DataModel;

class Pemberangkatan extends BaseController
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

        return view('lpk/' . menu()['controller'], ['judul' => menu()['menu'] . ' Lpk', 'data' => $db->allDataJoin('siswa', 'pemberangkatan.id as id,siswa_id,setoran,nama,program,tgl_pemberangkatan,alamat_penempatan,status_keberangkatan,catatan_pemberangkatan', 'tgl_pemberangkatan=DESC')]);
    }

    public function add()
    {
        $siswa_id = clear($this->request->getVar('siswa_id'));
        $program = upper_first(clear($this->request->getVar('program')));
        $status_keberangkatan = clear($this->request->getVar('status_keberangkatan'));
        $tgl_pemberangkatan = strtotime(clear($this->request->getVar('tgl_pemberangkatan')));
        $alamat_penempatan = upper_first(clear($this->request->getVar('alamat_penempatan')));
        $catatan_pemberangkatan = clear($this->request->getVar('catatan_pemberangkatan'));
        $setoran = rp_to_int(clear($this->request->getVar('setoran')));


        $db = new DataModel();

        $data = [
            'siswa_id' => $siswa_id,
            'program' => $program,
            'status_keberangkatan' => ($status_keberangkatan == "" ? 'Pertama' : ($status_keberangkatan == "on" ? 'Lanjutan' : '')),
            'tgl_pemberangkatan' => $tgl_pemberangkatan,
            'catatan_pemberangkatan' => $catatan_pemberangkatan,
            'alamat_penempatan' => $alamat_penempatan,
            'setoran' => $setoran
        ];


        $db->add($data);
    }
    public function update()
    {
        $id = strtolower(clear($this->request->getVar('id')));
        $siswa_id = clear($this->request->getVar('siswa_id'));
        $program = upper_first(clear($this->request->getVar('program')));
        $tgl_pemberangkatan = strtotime(clear($this->request->getVar('tgl_pemberangkatan')));
        $alamat_penempatan = upper_first(clear($this->request->getVar('alamat_penempatan')));
        $status_keberangkatan = clear($this->request->getVar('status_keberangkatan'));
        $catatan_pemberangkatan = clear($this->request->getVar('catatan_pemberangkatan'));
        $setoran = rp_to_int(clear($this->request->getVar('setoran')));

        $db = new DataModel();
        $data = $db->singleData('id=' . $id);

        if (!is_numeric($siswa_id)) {
            $siswa_id = $data['siswa_id'];
        }

        $data['id'] = $id;
        $data['siswa_id'] = $siswa_id;
        $data['program'] = $program;
        $data['tgl_pemberangkatan'] = $tgl_pemberangkatan;
        $data['status_keberangkatan'] = ($status_keberangkatan == "" ? 'Pertama' : ($status_keberangkatan == "on" ? 'Lanjutan' : ''));
        $data['alamat_penempatan'] = $alamat_penempatan;
        $data['catatan_pemberangkatan'] = $catatan_pemberangkatan;
        $data['setoran'] = $setoran;

        $db->update($id, $data);
    }


    public function delete()
    {
        $data = json_decode(json_encode($this->request->getVar('data')), true);

        $db = new DataModel();
        $db->delete($data['id']);
    }
}
