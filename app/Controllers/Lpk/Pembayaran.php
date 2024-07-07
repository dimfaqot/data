<?php

namespace App\Controllers\Lpk;

use App\Controllers\BaseController;
use App\Models\DataModel;

class Pembayaran extends BaseController
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

        return view('lpk/' . menu()['controller'], ['judul' => menu()['menu'] . ' Lpk', 'data'  => $db->allDataJoin('siswa', 'nota_lpk.id as id,catatan_siswa,jenis_siswa,siswa_id,nama,kota_lahir,created_at,tgl_lahir,nik', 'created_at=DESC', 'nota_lpk'), 'pembayaran' => $db->allData('tgl_pembayaran=ASC')]);
    }

    public function add()
    {
        $siswa_id = clear($this->request->getVar('siswa_id'));
        $jenis_siswa = clear($this->request->getVar('jenis_siswa'));
        $catatan_siswa = clear($this->request->getVar('catatan_siswa'));

        $time = time();
        $db = new DataModel();

        $data = [
            'no_nota' => $db->no_nota_lpk($time, $siswa_id, ($jenis_siswa == "" ? 'NE' : ($jenis_siswa == "on" ? 'OL' : ''))),
            'siswa_id' => $siswa_id,
            'jenis_siswa' => ($jenis_siswa == "" ? 'Baru' : ($jenis_siswa == "on" ? 'Lanjutan' : '')),
            'catatan_siswa' => $catatan_siswa,
            'created_at' => $time
        ];


        $db->add($data, 'nota_lpk');
    }

    public function add_rincian_pembayaran()
    {
        $nota_id = clear($this->request->getVar('nota_id'));
        $nama_pembayaran = clear(upper_first($this->request->getVar('nama_pembayaran')));
        $jml_pembayaran = rp_to_int(clear($this->request->getVar('jml_pembayaran')));
        $tgl_pembayaran = strtotime(clear($this->request->getVar('tgl_pembayaran')));
        $catatan_pembayaran = clear($this->request->getVar('catatan_pembayaran'));

        $data = [
            'nota_id' => $nota_id,
            'nama_pembayaran' => $nama_pembayaran,
            'jml_pembayaran' => $jml_pembayaran,
            'tgl_pembayaran' => $tgl_pembayaran,
            'catatan_pembayaran' => $catatan_pembayaran
        ];

        $db = db(menu()['tabel'], 'lpk');
        if ($db->insert($data)) {
            $datas = $db->where('nota_id', $nota_id)->orderBy('tgl_pembayaran', 'ASC')->get()->getResultArray();
            $res = [];
            foreach ($datas as $i) {
                $i['tgl_pembayaran_new'] = date('Y-m-d', $i['tgl_pembayaran']);
                $res[] = $i;
            }
            sukses_js('Data berhasil disimpan.', $res);
        } else {
            gagal_js('Data gagal disimpan!.');
        }
    }

    public function update()
    {
        $id = clear($this->request->getVar('id'));
        $nama_pembayaran = clear(upper_first($this->request->getVar('nama_pembayaran')));
        $jml_pembayaran = rp_to_int(clear($this->request->getVar('jml_pembayaran')));
        $tgl_pembayaran = strtotime(clear($this->request->getVar('tgl_pembayaran')));
        $catatan_pembayaran = clear($this->request->getVar('catatan_pembayaran'));


        $db = db('pembayaran', 'lpk');

        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal_js('No. id tidak ada!.');
        }

        $q['nama_pembayaran'] = $nama_pembayaran;
        $q['jml_pembayaran'] = $jml_pembayaran;
        $q['tgl_pembayaran'] = $tgl_pembayaran;
        $q['catatan_pembayaran'] = $catatan_pembayaran;

        $db->where('id', $id);
        if ($db->update($id)) {
            sukses_js('Data berhasil diupdate');
        } else {
            gagal_js('Data gagal diupdate!.');
        }
    }

    public function update_nota_lpk()
    {
        $id = clear($this->request->getVar('id'));
        $tabel = clear($this->request->getVar('tabel'));
        $jenis_siswa = $this->request->getVar('jenis_siswa');
        $catatan_siswa = clear($this->request->getVar('catatan_siswa'));

        $db = db($tabel, 'lpk');
        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q['jenis_siswa'] = ($jenis_siswa == true ? 'Lanjutan' : ($jenis_siswa == false ? 'Baru' : ''));
        $q['catatan_siswa'] = $catatan_siswa;

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
        $nota_id = clear($this->request->getVar('nota_id'));

        $db = db(menu()['tabel'], get_db(menu()['tabel']));
        $q = $db->where('id', $id);

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }
        $db->where('id', $id);
        if ($db->delete()) {
            $datas = $db->where('nota_id', $nota_id)->orderBy('tgl_pembayaran', 'ASC')->get()->getResultArray();
            $res = [];
            foreach ($datas as $i) {
                $i['tgl_pembayaran_new'] = date('Y-m-d', $i['tgl_pembayaran']);
                $res[] = $i;
            }

            sukses_js('Data berhasil dihapus.', $res);
        } else {
            gagal_js('Data gagal dihapus!.');
        }
    }
    public function delete_nota_lpk()
    {
        $data = json_decode(json_encode($this->request->getVar('data')), true);

        $db = db($data['tabel'], get_db($data['tabel']));
        $q = $db->where('id', $data['id']);

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }
        $db->where('id', $data['id']);
        if ($db->delete()) {
            $dbp = db('pembayaran', 'lpk');
            $dbp->where('nota_id', $data['id']);
            if ($dbp->delete()) {
                sukses_js('Data berhasil dihapus.');
            }
        } else {
            gagal_js('Data gagal dihapus!.');
        }
    }
}
