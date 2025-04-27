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
        $kategori = strtolower(session('role'));

        if (session('role') == 'Root') {
            $kategori = clear(strtolower($order));
        }

        if (!$kategori) {
            $kategori = strtolower($order);
        }


        $db = \Config\Database::connect('rental');
        $query = $db->query("
    SELECT 
        SUM(CASE WHEN MONTH(FROM_UNIXTIME(tgl)) < $bulan THEN masuk ELSE 0 END) 
        - SUM(CASE WHEN MONTH(FROM_UNIXTIME(tgl)) < $bulan THEN keluar ELSE 0 END) AS bulan_lalu,
        SUM(CASE WHEN MONTH(FROM_UNIXTIME(tgl)) = $bulan THEN masuk ELSE 0 END) 
        - SUM(CASE WHEN MONTH(FROM_UNIXTIME(tgl)) = $bulan THEN keluar ELSE 0 END) AS bulan_ini
    FROM $kategori
    WHERE YEAR(FROM_UNIXTIME(tgl)) = $tahun
");

        $result = $query->getRow();

        // Query terpisah untuk mendapatkan seluruh data bulan ini
        $query_data_bulan_ini = $db->query("
        SELECT * FROM elf
        WHERE YEAR(FROM_UNIXTIME(tgl)) = $tahun
        AND MONTH(FROM_UNIXTIME(tgl)) = $bulan
        ");

        $data = $query_data_bulan_ini->getResultArray();



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
        $html = view('cetak/laporan_rental', ['judul' => $judul, 'logo' => $logo, 'tahun' => $tahun, 'bulan' => $bulan, 'kategori' => $kategori, 'data' => $data, 'petugas' => $petugas, 'bulan_lalu' => $result->bulan_lalu, "bulan_ini" => $result->bulan_ini]); // view('pdf_template') mengacu pada file view yang akan dirender menjadi PDF

        // Setel konten HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($judul . '.pdf', 'I');
    }
}
