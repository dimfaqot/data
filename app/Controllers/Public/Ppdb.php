<?php


namespace App\Controllers\Public;

use App\Controllers\BaseController;


class Ppdb extends BaseController
{

    public function index($sub = null, $gender = null): string
    {
        $tahun = tahun_santri('ppdb');
        $sub = ($sub == null ? 'SMP' : $sub);
        $gender = ($gender == null ? 'L' : $gender);

        $db = db('ppdb', 'santri');
        $db->select('no_id,nama,gender,sub,kabupaten,status')->where('deleted', 0);

        if ($tahun !== 'All') {
            $db->where('tahun_masuk', $tahun);
        }
        if ($sub !== 'All') {
            $db->where('sub', $sub);
        }

        if ($gender !== 'All') {
            $db->where('gender', $gender);
        }

        $q = $db->get()->getResultArray();

        return view('root/ppdb/landing', ['judul' => 'PPDB', 'data' => $q, 'sub' => ($sub == 'All' ? 'All' : $sub), 'gender' => ($gender == 'All' ? 'All' : $gender)]);
    }

    public function kuitansi($data)
    {

        $data = decode_jwt($data);
        $db = db('ppdb', 'santri');
        $q = $db->where('no_id', $data['no_id'])->get()->getRowArray();

        if (!$q) {
            gagal($data['url'], 'No id not found!');
        }
        if ($q['ket_pendaftaran'] !== 'Lunas' && $q['bukti_pendaftaran'] !== 'file_not_found.jpg') {
            gagal($data['url'], 'Belum lunas!');
        }

        $judul = 'Kuitansi Pendaftaran ' . $q['nama'];

        $set = [
            'mode' => 'utf-8',
            'format' => [215, 165],
            'orientation' => 'P',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5,
        ];

        $mpdf = new \Mpdf\Mpdf($set);

        $q['kop'] = '<img width="12%" src="berkas/menu/ppdb.png" alt="Kop"/>';
        $encode = encode_jwt(['id' => $q['no_id'], 'section' => 'Ppdb', 'role' => 'Member', 'gender' => $q['gender'], 'nama' => $q['nama']]);
        $url = base_url() . 'public/a/ppdb/' . $encode;
        $q['url'] = $url;
        $html = view('cetak/kuitansi_ppdb', ['judul' => $judul, 'data' => $q]);
        $mpdf->AddPage();

        $mpdf->WriteHTML($html);



        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($judul . '.pdf', 'I');
    }
}
