<?php


namespace App\Controllers\Rental;

use App\Controllers\BaseController;

class Rental extends BaseController
{

    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
        if (session('section') !== 'Root' && session('section') !== 'Rental') {
            header("Location: " . base_url('home'));
            die;
        }
        $kat = options('Rental');
        $kats = [];
        foreach ($kat as $i) {
            $kats[] = $i['value'];
        }
        $kats[] = 'Root';

        if (!in_array(session('role'), $kats)) {
            header("Location: " . base_url('home'));
            die;
        }
    }

    public function index($tahun, $bulan, $kat = null)
    {

        // $dbs = ['apv', 'bus', 'l300', 'elf'];

        // foreach ($dbs as $i) {
        //     $db = db($i, 'rental');
        //     $q = $db->get()->getResultArray();

        //     foreach ($q as $i) {
        //         $i['kategori'] = "Masuk";
        //         $db->where('id', $i['id']);
        //         $db->update($i);
        //     }
        // }

        $kategori = session('role');

        if (session('role') == 'Root') {
            $kategori = ($kat == null ? 'Bus' : $kat);
        }


        $db = db(strtolower($kategori), 'rental');

        $q = $db->where('kategori', "Masuk")->orderBy('tgl', 'ASC')->get()->getResultArray();

        $data = [];

        $th = [];
        foreach ($q as $i) {
            if (!in_array(date('Y', $i['tgl']), $th)) {
                $th[] = date('Y', $i['tgl']);
            }
            if ($tahun == 'All' && $bulan == 'All') {
                $data[] = $i;
            } elseif ($tahun !== 'All' && $bulan !== 'All') {

                if (date('m', $i['tgl']) == $bulan && date('Y', $i['tgl']) == $tahun) {
                    $data[] = $i;
                }
            } elseif ($tahun == 'All' && $bulan !== 'All') {
                if (date('m', $i['tgl']) == $bulan) {
                    $data[] = $i;
                }
            } elseif ($tahun !== 'All' && $bulan == 'All') {
                if (date('Y', $i['tgl']) == $tahun) {
                    $data[] = $i;
                }
            }
        }

        return view('rental/' . menu()['controller'], ['judul' => 'Rental ' . $kategori, 'kategori' => $kategori, 'data' => $data, 'tahuns' => $th]);
    }


    public function add()
    {

        $tgl = strtotime(clear($this->request->getVar('tgl')));
        $waktu = clear($this->request->getVar('waktu'));
        $url = clear($this->request->getVar('url'));
        $pemakai = upper_first($this->request->getVar('pemakai'));
        $pj = upper_first($this->request->getVar('pj'));

        $kategori = clear($this->request->getVar('kategori'));

        if (session('role') !== 'Root') {
            $kategori = session('role');
        }
        if (session('role') == 'Root') {
            $url .= '/' . $kategori;
        }
        $data = [
            'kategori' => "Masuk",
            'tgl' => $tgl,
            'waktu' => $waktu,
            'pemakai' => $pemakai,
            'pj' => $pj
        ];

        $db = db(strtolower($kategori), 'rental');

        if ($db->insert($data)) {
            sukses($url, 'Data berhasil disimpan.');
        } else {
            gagal($url, 'Data gagal disimpan.');
        }
    }

    public function update_blur()
    {
        $kategori = session('role');

        if (session('role') == 'Root') {
            $kategori = strtolower(clear($this->request->getVar('tabel')));
        }

        $id = $this->request->getVar('id');
        $col = clear($this->request->getVar('col'));
        $val = upper_first(clear($this->request->getVar('val')));

        if ($col == 'masuk' || $col == 'keluar') {
            $val = (int)str_replace(".", "", $val);
        }


        $db = db(strtolower($kategori), 'rental');

        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q[$col] = $val;


        $db->where('id', $id);
        if ($db->update($q)) {
            sukses_js('Data berhasil diupdate.');
        } else {
            gagal_js('Data gagal diupdate!.');
        }
    }

    public function update_tgl()
    {
        $kategori = session('role');

        if (session('role') == 'Root') {
            $kategori = clear($this->request->getVar('tabel'));
        }


        $id = $this->request->getVar('id');
        $tgl = strtotime(clear($this->request->getVar('tgl')));


        $db = db(strtolower($kategori), 'rental');

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan!.');
        }

        $q['tgl'] = $tgl;
        $url = base_url(menu()['controller']) . '/' . date('Y', $tgl) . '/' . date('m', $tgl) . (session('role') == 'Root' ? '/' . $kategori : '');

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses($url, 'Data berhasil diupdate.');
        } else {
            gagal($url, 'Data gagal diupdate!.');
        }
    }



    public function delete()
    {
        $kategori = session('role');

        if (session('role') == 'Root') {
            $kategori = clear($this->request->getVar('tabel'));
        }
        $id = clear($this->request->getVar('id'));

        $db = db(strtolower($kategori), 'rental');
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

    public function add_image()
    {
        $url = clear($this->request->getVar('url'));
        $folder = clear($this->request->getVar('folder'));
        add_image($_FILES['file'], $url, $folder);
    }
    public function delete_file()
    {
        $dir = clear($this->request->getVar('dir'));

        if (unlink($dir)) {
            sukses_js('File berhasil dihapus.');
        } else {
            gagal_js('File gagal dihapus.');
        }
    }

    public function add_pengeluaran()
    {
        $kategori = session('role');

        if (session('role') == 'Root') {
            $kategori = clear(strtolower($this->request->getVar('tabel')));
        }

        $tahun = clear($this->request->getVar('tahun'));
        $bulan = clear($this->request->getVar('bulan'));

        $db = db(strtolower($kategori), 'rental');

        $data = [
            'kategori' => "Keluar",
            'tgl' => time(),
            'barang' => upper_first(clear($this->request->getVar('barang'))),
            'pj' => upper_first(clear($this->request->getVar('pj'))),
            'keluar' => (int)str_replace(".", "", clear($this->request->getVar('harga'))),
        ];
        if ($db->insert($data)) {
            $q = $db->where('kategori', "Keluar")->orderBy('tgl', 'ASC')->get()->getResultArray();

            $data = [];
            foreach ($q as $i) {
                if (date('m', $i['tgl']) == $bulan && date('Y', $i['tgl']) == $tahun) {
                    $data[] = $i;
                }
            }
            sukses_js("Data berhasil disimpan.", $data);
        } else {
            gagal_js('Data gagal disimpan!.');
        }
    }

    public function pengeluaran()
    {
        $kategori = session('role');

        if (session('role') == 'Root') {
            $kategori = clear(strtolower($this->request->getVar('tabel')));
        }

        $tahun = clear($this->request->getVar('tahun'));
        $bulan = clear($this->request->getVar('bulan'));

        $db = db(strtolower($kategori), 'rental');

        $q = $db->where('kategori', "Keluar")->orderBy('tgl', 'ASC')->get()->getResultArray();

        $data = [];
        foreach ($q as $i) {
            if (date('m', $i['tgl']) == $bulan && date('Y', $i['tgl']) == $tahun) {
                $data[] = $i;
            }
        }

        sukses_js("Sukses.", $data);
    }
}
