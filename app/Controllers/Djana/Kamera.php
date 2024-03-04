<?php

namespace App\Controllers\Djana;

use App\Controllers\BaseController;

class Kamera extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
        check_role();
    }
    public function index($tahun, $bulan): string
    {
        $db = db('kamera', 'djana');
        $q = $db->orderBy('tgl', 'DESC')->get()->getResultArray();
        $data = [];

        $tahuns = [];
        foreach ($q as $i) {
            if (!in_array(date('Y', $i['tgl']), $tahuns)) {
                $tahuns[] = date('Y', $i['tgl']);
            }
            if ($tahun !== 'All' && $bulan !== 'All') {
                if (date('Y', $i['tgl']) == $tahun && date('m', $i['tgl']) == $bulan) {
                    $data[] = $i;
                }
            } elseif ($tahun !== 'All' && $bulan == 'All') {
                if (date('Y', $i['tgl']) == $tahun) {
                    $data[] = $i;
                }
            } elseif ($tahun == 'All' && $bulan !== 'All') {
                if (date('m', $i['tgl']) == $bulan) {
                    $data[] = $i;
                }
            } else {
                $data[] = $i;
            }
        }
        return view('djana/' . menu()['controller'], ['judul' => menu()['menu'], 'data' => $data, 'tahuns' => $tahuns]);
    }

    public function add()
    {

        $tgl = strtotime(clear($this->request->getVar('tgl')));
        $acara = upper_first(clear($this->request->getVar('acara')));
        $lokasi = upper_first(clear($this->request->getVar('lokasi')));
        $pj = clear($this->request->getVar('pj'));
        $kamera = upper_first(clear($this->request->getVar('kamera')));
        $url = clear($this->request->getVar('url'));


        $db = db('kamera', 'djana');

        $data = [
            'tgl' => $tgl,
            'acara' => $acara,
            'lokasi' => $lokasi,
            'pj' => $pj,
            'kamera' => $kamera,
            'created_at' => time(),
            'updated_at' => time()
        ];


        if ($db->insert($data)) {
            sukses($url, 'Data sukses diupdate.');
        } else {
            gagal($url, 'Data gagal diupdate.');
        }
    }
    public function update()
    {

        $id = clear($this->request->getVar('id'));
        $tgl = strtotime(clear($this->request->getVar('tgl')));
        $acara = upper_first(clear($this->request->getVar('acara')));
        $lokasi = upper_first(clear($this->request->getVar('lokasi')));
        $pj = clear($this->request->getVar('pj'));
        $kamera = upper_first(clear($this->request->getVar('kamera')));
        $url = clear($this->request->getVar('url'));

        $db = db('kamera', 'djana');

        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal($url, 'Id tidak ditemukan.');
        }

        $q['tgl'] = $tgl;
        $q['acara'] = $acara;
        $q['lokasi'] = $lokasi;
        $q['pj'] = $pj;
        $q['kamera'] = $kamera;
        $q['updated_at'] = time();

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses($url, 'Data sukses diupdate.');
        } else {
            gagal($url, 'Data gagal diupdate.');
        }
    }


    public function delete()
    {
        $id = $this->request->getVar('id');

        $db = db(menu()['tabel'], 'djana');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan.');
        }


        $db->where('id', $id);
        if ($db->delete()) {
            sukses_js('Data berhasil dihapus.');
        } else {
            gagal_js('Data gagal dihapus.');
        }
    }
}
