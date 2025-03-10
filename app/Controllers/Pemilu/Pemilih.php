<?php


namespace App\Controllers\Pemilu;

use App\Controllers\BaseController;

class Pemilih extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
        check_role();
    }
    public function index($tahun, $voted, $page, $kategori, $pondok, $col, $asc): string
    {
        $db = db(menu()['tabel'], get_db(menu()['tabel']));
        $tahuns = $db->groupBy('tahun')->orderBy('tahun', 'DESC')->get()->getResultArray();
        $limit = 0;
        $db;
        if ($page !== 'All') {
            $limit = $page * 50;
            $db->limit($limit);
        }
        if ($voted !== 'All') {
            if ($voted == 'Belum') {

                $db->where('voted', 0);
            }
            if ($voted == 'Sudah') {

                $db->whereNotIn('voted', [0]);
            }
        }

        if ($kategori !== 'All') {
            $db->where('kategori', $kategori);
        }
        if ($tahun !== 'All') {
            $db->where('tahun', $tahun);
        }
        if ($pondok !== 'All') {
            $db->where('pondok', $pondok);
        }

        $q = $db->get()->getResultArray();

        $db;
        if ($voted !== 'All') {
            if ($voted == 'Belum') {

                $db->where('voted', 0);
            }
            if ($voted == 'Sudah') {

                $db->whereNotIn('voted', [0]);
            }
        }

        if ($kategori !== 'All') {
            $db->where('kategori', $kategori);
        }
        if ($tahun !== 'All') {
            $db->where('tahun', $tahun);
        }
        if ($pondok !== 'All') {
            $db->where('pondok', $pondok);
        }
        $total = $db->countAllResults();



        $short_by = ($asc == 'ASC' ? SORT_ASC : SORT_DESC);

        $keys = array_column($q, $col);
        array_multisort($keys, $short_by, $q);


        $data = [
            'status' => '200',
            'total_data' => $total,
            'data_ditampilkan' => ($limit == 0 ? $total : ($total < $limit ? $total : $limit)),
            'data' => $q
        ];

        $kat = db('kategori', get_db('kategori'));
        $ktgr = $kat->orderBy('suara', 'DESC')->get()->getResultArray();

        $vtd = ['Sudah', 'Belum'];
        $pdk = ['Putra', 'Putri'];

        $cal = db('calon', get_db('calon'));
        $calon = $cal->groupBy('tahun')->orderBy('tahun', 'DESC')->get()->getResultArray();

        return view('pemilu/' . menu()['controller'], ['judul' => menu()['menu'], 'data' => $data, 'kategori' => $ktgr, 'voted' => $vtd, 'tahun' => $calon, 'pondok' => $pdk, 'tahuns' => $tahuns]);
    }

    public function add_data_from_api()
    {

        $no_id = clear($this->request->getVar('no_id'));
        $kategori = clear($this->request->getVar('kategori'));
        $nama = clear($this->request->getVar('nama'));
        $gender = clear($this->request->getVar('gender'));

        $sub = '';
        if ($kategori !== 'Santri') {
            $sub = clear($this->request->getVar('sub'));
        }

        $pondok = 'Putra';
        if ($gender == 'P') {
            $pondok = 'Putri';
        }

        $db = db(menu()['tabel']);

        $q = $db->where('no_id', $no_id)->get()->getRowArray();

        if ($q) {
            gagal_js('Pemilih sudah ada.');
        }


        $data = [
            'no_id' => $no_id,
            'kategori' => $kategori,
            'nama' => $nama,
            'pondok' => $pondok,
            'sub' => $sub,
            'created_at' => time(),
            'petugas' => session('nama'),
        ];

        if ($db->insert($data)) {
            sukses_js('Data berhasil disimpan.');
        } else {
            gagal_js('Data gagal disimpan.');
        }
    }

    public function delete()
    {
        $id = clear($this->request->getVar('id'));

        $db = db(menu()['tabel'], get_db(menu()['tabel']));

        $q = $db->where('no_id', $id)->get()->getRowArray();

        if (!$q) {
            gagal_js('Id tidak ditemukan.');
        }


        $db->where('no_id', $id);
        if ($db->delete()) {
            sukses_js('Data berhasil dihapus.');
        } else {
            gagal_js('Data gagal dihapus.');
        }
    }

    public function absen()
    {

        $no_id = clear($this->request->getVar('no_id'));
        $url = clear($this->request->getVar('url'));


        $db = db('pemilih', 'pemilu');

        $q = $db->where('no_id', $no_id)->get()->getRowArray();
        if ($q['voted'] > 0) {
            gagal($url, 'Peserta sudah memilih.');
        }

        if ($q['absen'] == 0) {
            $all = $db->where('pondok', (session('gender') == 'L' ? 'Putra' : 'Putri'))->whereNotIn('absen', [0])->get()->getResultArray();

            foreach ($all as $i) {
                $i['absen'] = 0;
                $db->where('no_id', $i['no_id']);
                $db->update($i);
            }
        }

        $q['absen'] = ($q['absen'] == 0 ? 1 : 0);
        $q['tgl'] = 0;
        $q['voted'] = 0;
        $q['created_at'] = time();
        $q['updated_at'] = time();
        $q['petugas'] = session('nama');

        $db->where('no_id', $no_id);

        if ($db->update($q)) {
            sukses($url, 'Absen berhasil diupdate.');
        } else {
            gagal($url, 'Absen gagal diupdate.');
        }
    }

    public function reset()
    {

        if (session('role') !== 'Root' && session('role') !== 'Admin') {
            gagal(base_url('home'), 'Pemilu sudah dimulai.');
        }

        if (settings('pemilu_dimulai') == 1) {
            gagal(base_url('home'), 'Pemilu sudah dimulai.');
        }
        $db = db('pemilih', get_db('pemilih'));
        $q = $db->get()->getResultArray();



        foreach ($q as $i) {
            $i['tgl'] = 0;
            $i['voted'] = 0;
            $i['absen'] = 0;
            $i['updated_at'] = time();
            $i['petugas'] = 'Reset by ' . session('nama');

            $db->where('no_id', $i['no_id']);
            $db->update($i);
        }

        $db = db('calon', get_db('calon'));
        $q = $db->get()->getResultArray();

        foreach ($q as $i) {
            $i['suara'] = 0;
            $i['petugas'] = 'Reset by ' . session('nama');

            $db->where('id', $i['id']);
            $db->update($i);
        }

        sukses(base_url(menu()['controller']) . '/2023/Belum/1/Karyawan/Putra/updated_at/DESC', 'Reset success.');
    }

    public function copy_to_next_year()
    {

        $data = json_decode(json_encode($this->request->getVar('data')));
        $err = [];
        foreach ($data as $i) {
            $db = db('pemilih', 'pemilu');
            $q = $db->where('no_id', $i)->get()->getRowArray();
            if (!$q) {
                $err[] = $i;
            } else {
                $q['petugas'] = session('nama');
                $q['tahun'] = date('Y');
                $db->where('no_id', $i);
                if (!$db->update($q)) {
                    $err[] = $i;
                }
            }
        }

        if (count($err) == 0) {
            sukses_js('Data sukses diupdate.');
        } {
            gagal_js('Data ' . implode(", ", $err) . ' gagal diupdate!.');
        }
    }

    public function get_jwt_login()
    {
        $no_id = clear($this->request->getVar('no_id'));

        $dbs = db('santri', 'santri');
        $dbk = db('karyawan', 'karyawan');
        if (strlen($no_id) > 6) {
            $user = $dbk->where('no_id', $no_id)->get()->getRowArray();
        } else {
            $user = $dbs->where('no_id', $no_id)->get()->getRowArray();
        }

        if (!$user) {
            gagal_js('Id tidak ditemukan!.');
        }

        $data = [
            'id' => $user['no_id'],
            'no_id' => $user['no_id'],
            'gender' => $user['gender'],
            'username' => '',
            'section' => 'Pemilu',
            'role' => 'Member',
            'nama' => $user['nama']
        ];

        sukses_js('Copied.', base_url('public/a/') . encode_jwt($data), ($user['hp'] !== '' ? substr_replace($user['hp'], "+62", 0, 1) : ''), nama_gelar($user));
    }
}
