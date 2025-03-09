<?php


namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Rental extends BaseController
{

    public function index($tahun = null, $bulan = null, $kategori = null)
    {
        if ($tahun == null) {
            $tahun = date('Y');
        }
        if ($bulan == null) {
            $bulan = date('m');
        }
        if ($kategori == null) {
            $kategori = 'Bus';
        }

        $db = db(strtolower($kategori), 'rental');

        $q = $db->where('kategori', $kategori)->orderBy('tgl', 'ASC')->get()->getResultArray();

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

        return view('rental/landing', ['judul' => 'Walisongo Rental, Travel, and Tour', 'data' => $data, 'tahuns' => $th]);
    }

    public function laporan($order, $tahun, $bulan)
    {
        $kategori = session('role');

        if (session('role') == 'Root') {
            $kategori = clear(strtolower($order));
        }

        if (!$kategori) {
            $kategori = $order;
        }
        $bulan_lalu = (int)$bulan - 1;
        $bulan_lalu = bulan($bulan_lalu)['angka'];
        $tahun_lalu = $tahun;

        if ($bulan == "01") {
            $bulan_lalu = "12";
            $tahun_lalu = (int)$tahun - 1;
        }

        $db = db(strtolower($kategori), 'rental');

        $q = $db->orderBy('tgl', 'ASC')->get()->getResultArray();

        $data = [];
        $saldo_bulan_lalu = 0;
        $masuk = 0;
        $keluar = 0;
        foreach ($q as $i) {
            if (date('m', $i['tgl']) == $bulan && date('Y', $i['tgl']) == $tahun) {
                $data[] = $i;
                $masuk += (int)$i['masuk'];
                $keluar += (int)$i['keluar'];
            }
            if (date('m', $i['tgl']) == $bulan_lalu && date('Y', $i['tgl']) == $tahun_lalu) {
                $saldo_bulan_lalu += (int)$i['masuk'] - (int)$i['keluar'];
            }
        }

        $set = [
            'mode' => 'utf-8',
            'format' => [210, 330],
            'orientation' => 'P',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5
        ];

        $petugas = "";
        if (session('id')) {
            $petugas = session('nama');
        }
        $mpdf = new \Mpdf\Mpdf($set);

        $judul = "LAPORAN " . strtoupper($order) . " BULAN " . strtoupper(bulan($bulan)['bulan']) . " TAHUN " . $tahun;
        // Dapatkan konten HTML
        $logo = '<img width="200" src="berkas/menu/rental.png" alt="Kop"/>';
        $html = view('cetak/laporan_rental', ['judul' => $judul, 'logo' => $logo, 'tahun' => $tahun, 'bulan' => $bulan, 'order' => $order, 'data' => $data, 'petugas' => $petugas, 'bulan_lalu' => $bulan_lalu, "saldo_bulan_lalu" => $saldo_bulan_lalu, 'masuk' => $masuk, 'keluar' => $keluar]); // view('pdf_template') mengacu pada file view yang akan dirender menjadi PDF

        // Setel konten HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($judul . '.pdf', 'I');
    }
}
