<?php


namespace App\Controllers\Root;

use App\Controllers\BaseController;

class Kts extends BaseController
{
    function __construct()
    {
        helper('functions');
        if (!session('id')) {
            gagal(base_url('login'), 'Anda belum login.');
        }
        check_role();
    }

    public function index($tahun = null, $sub = 'SMP')
    {

        $tahun = ($tahun == null ? date('Y') : $tahun);

        $db = db('santri', 'santri');
        $q = $db->where('tahun_masuk', $tahun)->where('sub', $sub)->orderBy('nama', 'ASC')->get()->getResultArray();
        $tahuns = $db->groupBy('tahun_masuk')->orderBy('tahun_masuk', 'ASC')->get()->getResultArray();
        return view('root/santri/kts', ['judul' => menu()['menu'], 'data' => $q, 'tahuns' => $tahuns, 'tahun' => $tahun, 'sub' => $sub]);
    }

    public function cetak($tahun = null, $sub = 'SMP')
    {
        $tahun = ($tahun == null ? date('Y') : $tahun);

        $db = db('santri', 'santri');
        $data = $db->where('tahun_masuk', $tahun)->where('sub', $sub)->orderBy('nama', 'ASC')->get()->getResultArray();

        // $data = [];
        // foreach ($q as $i) {

        //     $q = $db->where('kode', $i)->get()->getResultArray();
        //     $img1 = 'berkas/ekstra/sertifikat1.jpg';
        //     $img2 = 'berkas/ekstra/sertifikat2.jpg';

        //     if ($q) {
        //         $q[0]['link_qr_code'] = $q[0]['qr_code'];
        //         $q[0]['qr_code'] = '<img width="80px" src="' .  $q[0]['qr_code'] . '" alt="QR CODE"/>';
        //     }
        //     $data[] = ['bg_img' => $img1, 'data' => $q, 'profile' => ($q ? $q[0] : [])];
        //     $data[] = ['bg_img' => $img2, 'data' => $q, 'profile' => ($q ? $q[0] : [])];
        // }

        $judul = 'Kts santri ' . upper_first($sub . ' Tahun ' . $tahun);
        if (count($data) == 1) {
            $judul = 'Kts ' . $data[0]['nama'];
        }


        $set = [
            'mode' => 'utf-8',
            'format' => [175, 295],
            'orientation' => 'L',
            'margin-left' => 20,
            'margin-right' => 20,
            'margin-top' => -0,
            'margin-bottom' => 0
        ];

        $mpdf = new \Mpdf\Mpdf($set);
        $mpdf->useSubstitutions = false;

        foreach ($data as $k => $i) {
            $i['ttl'] = ttl($i);
            $i['alamat_lengkap'] = alamat_lengkap($i);
            $i['bg'] = 'berkas/santri/kts.png';
            $i['photo'] = '<img width="200" src="' .  'berkas/santri/' . $i['profile'] . '" alt="Kop"/>';

            $html = view('cetak/kts', ['judul' => $judul, 'data' => $i, 'k' => $k]);
            $mpdf->AddPage();

            $mpdf->SetDefaultBodyCSS('background', "url(" . $i['bg'] . ")");
            $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
            $mpdf->WriteHTML($html);
            $html = view('cetak/kts', ['judul' => $judul, 'data' => $i]);
        }


        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($judul . '.pdf', 'I');
    }
}
