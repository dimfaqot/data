<?php


namespace App\Controllers\Public;

use App\Controllers\BaseController;


class Recruitment extends BaseController
{

    public function index($sub = null, $pekerjaan = null): string
    {
        $tahun = date('Y');
        $pekerjaan = ($pekerjaan == null ? 'Guru Kelas' : str_replace("-", " ", $pekerjaan));
        $sub = ($sub == null ? 'SMP' : $sub);

        $db = db('recruitment', 'karyawan');
        $db->select('no_id,nama,sub,bidang_pekerjaan,kabupaten');

        if ($pekerjaan !== 'All') {
            $db->where('bidang_pekerjaan', $pekerjaan);
        }
        if ($sub !== 'All') {
            $db->where('sub', $sub);
        }

        $q = $db->where('status', 'Register')->get()->getResultArray();

        return view('root/recruitment/landing', ['judul' => 'Recruitment', 'data' => $q, 'tahun' => $tahun,  'sub' => ($sub == 'All' ? 'All' : $sub), 'pekerjaan' => ($pekerjaan == 'All' ? 'All' : str_replace(" ", "-", $pekerjaan))]);
    }

    public function karyawan()
    {
        return view('news/get_niy_karyawan', ['judul' => "NIY"]);
    }

    public function cari_db_niy()
    {
        $nama = clear($this->request->getVar('nama'));
        $db = db('karyawan', 'karyawan');
        $q = $db->select('no_id,nama,sub')->whereIn('status', ['Aktif'])->like('nama', $nama, 'both')->orderBy('sub', 'ASC')->orderBy('nama', 'ASC')->limit(10)->get()->getResultArray();
        sukses_js('Ok', $q);
    }
}
