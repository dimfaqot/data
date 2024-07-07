<?php

namespace App\Controllers\Lpk;

use App\Controllers\BaseController;
use App\Models\DataModel;

class Setoran extends BaseController
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
        return view('lpk/setoran', ['judul' => 'Setoran Lpk', 'data' => $db->allDataJoin('siswa', 'pemberangkatan.id as id,siswa_id,setoran,nama,program,tgl_pemberangkatan,alamat_penempatan,status_keberangkatan,catatan_pemberangkatan', 'tgl_pemberangkatan=DESC', 'pemberangkatan')]);
    }

    public function detail($id)
    {
        $db = db('pemberangkatan', 'lpk');

        $siswa = $db->select('pemberangkatan.id as id,siswa_id,setoran,nama,program,tgl_pemberangkatan,alamat_penempatan,tgl_lahir,kota_lahir,alamat,kelurahan,kecamatan,kabupaten,provinsi,hp,status_keberangkatan,catatan_pemberangkatan')->join('siswa', 'siswa_id=siswa.id')->where('pemberangkatan.id', $id)->get()->getRowArray();

        if (!$siswa) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }

        $dbd = db('setoran', 'lpk');
        $data = $dbd->where('pemberangkatan_id', $id)->orderBy('tgl_tf', 'ASC')->get()->getResultArray();

        return view('lpk/detail', ['judul' => 'Setoran Lpk ' . $siswa['nama'], 'siswa' => $siswa, 'data' => $data]);
    }

    public function update()
    {
        $order = clear($this->request->getVar('order'));
        $pemberangkatan_id = clear($this->request->getVar('pemberangkatan_id'));
        $id = clear($this->request->getVar('id'));
        $tgl_tf = strtotime(clear($this->request->getVar('tgl_tf')));
        $jml_tf = rp_to_int($this->request->getVar('jml_tf'));
        $tahun = clear($this->request->getVar('tahun'));
        $col = clear($this->request->getVar('col'));
        $value = ($col == 'tgl_tf' ? strtotime($this->request->getVar('value')) : rp_to_int($this->request->getVar('value')));

        $db = db(menu()['tabel'], get_db(menu()['tabel']));

        if ($order == 'add') {
            $data = [
                'pemberangkatan_id' => $pemberangkatan_id,
                'tgl_tf' => $tgl_tf,
                'jml_tf' => $jml_tf,
            ];

            if ($db->insert($data)) {
                $res = $db->where('pemberangkatan_id', $pemberangkatan_id)->get()->getResultArray();
                $total = 0;
                foreach ($res as $i) {
                    if (date('Y', $i['tgl_tf']) == $tahun) {
                        $total += $i['jml_tf'];
                    }
                }
                sukses_js('Data berhasil disimpan.', rupiah($total));
            } else {
                gagal_js('Data gagal disimpan!.');
            }
        }

        if ($order == 'update') {
            $q = $db->where('id', $id)->get()->getRowArray();
            if (!$q) {
                gagal_js('Id tidak ditemukan!.');
            }

            $q[$col] = $value;

            $db->where('id', $id);
            if ($db->update($q)) {
                $res = $db->where('pemberangkatan_id', $pemberangkatan_id)->get()->getResultArray();
                $total = 0;
                foreach ($res as $i) {
                    if (date('Y', $i['tgl_tf']) == $tahun) {
                        $total += $i['jml_tf'];
                    }
                }
                sukses_js('Data berhasil diupdate.', rupiah($total));
            } else {
                gagal_js('Data gagal diupdate!.');
            }
        }
        if ($order == 'delete') {
            $q = $db->where('id', $id)->get()->getRowArray();
            if (!$q) {
                gagal_js('Id tidak ditemukan!.');
            }

            $db->where('id', $id);
            if ($db->delete()) {
                $res = $db->where('pemberangkatan_id', $pemberangkatan_id)->get()->getResultArray();
                $total = 0;
                foreach ($res as $i) {
                    if (date('Y', $i['tgl_tf']) == $tahun) {
                        $total += $i['jml_tf'];
                    }
                }
                sukses_js('Data berhasil diupdate.', rupiah($total));
            } else {
                gagal_js('Data gagal diupdate!.');
            }
        }
    }
}
