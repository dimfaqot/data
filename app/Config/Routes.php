<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  landing/news
$routes->get('/', 'News\Landing::index');

// cari
$routes->post('/cari_nama_db', 'Cari\Cari::cari_nama_db');
$routes->post('/cari_daerah_db', 'Cari\Cari::cari_daerah_db');
$routes->post('/cari_lpk_db', 'Cari\Cari::cari_lpk_db');
$routes->post('alumni/cari_nama_santri', 'Cari\Cari::cari_nama_santri');
$routes->post('alumni/is_nama_alumni_exist', 'Cari\Cari::is_nama_alumni_exist');

// label
$routes->get('/label', 'News\Label::index');
$routes->post('/label/add', 'News\Label::add');
$routes->post('/label/update_blur', 'News\Label::update_blur');
$routes->post('/label/delete', 'News\Label::delete');

// artikel
$routes->get('/artikel/(:any)/(:any)/(:any)/(:any)/(:any)', 'News\Artikel::index/$1/$2/$3/$4/$5');
$routes->post('/artikel/add', 'News\Artikel::add');
$routes->post('/artikel/update', 'News\Artikel::update');
$routes->post('/artikel/delete', 'News\Artikel::delete');

$routes->get('/login', 'News\Landing::login');
$routes->post('/login', 'News\Landing::proses_login');
$routes->post('/ganti_password', 'News\Home::ganti_password');
$routes->post('/logout', 'News\Home::logout');
$routes->get('/p/karyawan', 'Public\Recruitment::karyawan');
$routes->post('/p/cari_db_niy', 'Public\Recruitment::cari_db_niy');

// tahun
$routes->post('/tahun/add', 'Root\Tahun::add');
$routes->post('/tahun/update', 'Root\Tahun::update');

// home
$routes->get('/home', 'News\Home::index');
$routes->post('/search_by_text', 'News\Home::search_by_text');
$routes->post('/add_data_from_db', 'News\Home::add_data_from_db');
$routes->post('/check_no_id', 'News\Home::check_no_id');
$routes->post('/check_no_sk', 'News\Home::check_no_sk');
$routes->post('/indonesia', 'News\Home::indonesia');
$routes->post('/panduan', 'News\Home::panduan');
$routes->post('/update_wa', 'News\Home::update_wa');
$routes->post('/encode', 'News\Home::encode');
$routes->post('/auth_url', 'News\Home::auth_url');
$routes->post('/update_checkbox', 'News\Home::update_checkbox');
$routes->post('/change_status', 'News\Home::change_status');



// ROOT -------------------------------------------------
// user
$routes->get('/menu/(:any)', 'Root\Menu::index/$1');
$routes->post('/menu/add', 'Root\Menu::add');
$routes->post('/menu/update', 'Root\Menu::update');
$routes->post('/menu/copy', 'Root\Menu::copy');
$routes->post('/menu/delete', 'Root\Menu::delete');

// menu
$routes->get('/user/(:any)', 'Root\User::index/$1');
$routes->post('/user/add', 'Root\User::add');
$routes->post('/user/update', 'Root\User::update');
$routes->post('/user/reset_password', 'Root\User::reset_password');
$routes->post('/user/copy', 'Root\User::copy');
$routes->post('/user/delete', 'Root\User::delete');

// options
$routes->get('/options/(:any)', 'Root\Options::index/$1');
$routes->post('/options/add', 'Root\Options::add');
$routes->post('/options/update', 'Root\Options::update');
$routes->post('/options/copy', 'Root\Options::copy');
$routes->post('/options/delete', 'Root\Options::delete');

// options
$routes->get('/settings', 'Root\Settings::index');
$routes->post('/settings/update', 'Root\Settings::update');

// karyawan
$routes->get('/karyawan/detail/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)/(:any)', 'Root\Karyawan::detail/$1/$2/$3/$4/$5/$6/$7/$8/$9');
$routes->get('/karyawan/cetak/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Karyawan::cetak/$1/$2/$3/$4/$5/$6/$7/$8');
$routes->get('/karyawan/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Karyawan::index/$1/$2/$3/$4/$5/$6/$7');
$routes->post('/karyawan/add', 'Root\Karyawan::add');
$routes->post('/karyawan/update', 'Root\Karyawan::update');
$routes->post('/karyawan/remove', 'Root\Karyawan::remove');
$routes->post('/karyawan/restore', 'Root\Karyawan::restore');
$routes->post('/karyawan/delete', 'Root\Karyawan::delete');
$routes->post('/karyawan/update_check', 'Root\Karyawan::update_check');

// recruitment
$routes->get('/recruitment/detail/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)/(:any)', 'Root\Recruitment::detail/$1/$2/$3/$4/$5/$6/$7/$8/$9');
$routes->get('/recruitment/cetak/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Recruitment::cetak/$1/$2/$3/$4/$5/$6/$7/$8');
$routes->get('/recruitment/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Recruitment::index/$1/$2/$3/$4/$5/$6/$7');
$routes->post('/recruitment/add', 'Root\Recruitment::add');
$routes->post('/recruitment/update', 'Root\Recruitment::update');
$routes->post('/recruitment/remove', 'Root\Recruitment::remove');
$routes->post('/recruitment/restore', 'Root\Recruitment::restore');
$routes->post('/recruitment/delete', 'Root\Recruitment::delete');
$routes->post('/recruitment/insert_to_karyawan', 'Root\Recruitment::insert_to_karyawan');
$routes->post('/recruitment/next', 'Root\Recruitment::next');
$routes->post('/recruitment/back', 'Root\Recruitment::back');
$routes->post('/recruitment/gagal', 'Root\Recruitment::gagal');
$routes->post('recruitment/add_image', 'Root\Recruitment::add_image');
$routes->post('recruitment/delete_file', 'Root\Recruitment::delete_file');
$routes->post('recruitment/custome_view', 'Root\Recruitment::custome_view');
$routes->get('recruitment/cetak_interview/(:any)', 'Root\Recruitment::cetak_interview/$1');

// santri
$routes->get('/santri/detail/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)/(:any)', 'Root\Santri::detail/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10');
$routes->get('/santri/cetak/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Santri::cetak/$1/$2/$3/$4/$5/$6/$7/$8/$9');
$routes->get('/santri/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Santri::index/$1/$2/$3/$4/$5/$6/$7/$8');
$routes->post('/santri/add', 'Root\Santri::add');
$routes->post('/santri/update', 'Root\Santri::update');
$routes->post('/santri/remove', 'Root\Santri::remove');
$routes->post('/santri/restore', 'Root\Santri::restore');
$routes->post('/santri/delete', 'Root\Santri::delete');
$routes->post('/santri/insert_to_karyawan', 'Root\Santri::insert_to_karyawan');
$routes->post('/santri/update_uid', 'Root\Santri::update_uid');
$routes->post('/santri/get_rfid', 'Root\Santri::get_rfid');


// kts
$routes->get('/kts/cetak/(:num)/(:any)', 'Root\Kts::cetak/$1/$2');
$routes->get('/kts', 'Root\Kts::index');
$routes->get('/kts/(:num)/(:any)', 'Root\Kts::index/$1/$2');

// alumni
// angkatan
$routes->get('/angkatan', 'Alumni\Angkatan::index');
$routes->post('angkatan/add', 'Alumni\Angkatan::add');
$routes->post('angkatan/detail', 'Alumni\Angkatan::detail');
$routes->post('angkatan/update', 'Alumni\Angkatan::update');
$routes->post('angkatan/delete', 'Alumni\Angkatan::delete');
// region
$routes->get('/region', 'Alumni\Region::index');
$routes->post('region/add', 'Alumni\Region::add');
$routes->post('region/detail', 'Alumni\Region::detail');
$routes->post('region/update', 'Alumni\Region::update');
$routes->post('region/delete', 'Alumni\Region::delete');


// ppdb
$routes->get('/ppdb/detail/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)/(:any)', 'Root\Ppdb::detail/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10');
$routes->get('/ppdb/cetak/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Ppdb::cetak/$1/$2/$3/$4/$5/$6/$7/$8/$9');
$routes->get('ppdb/cetak_form_interview/(:any)/(:any)', 'Root\Ppdb::cetak_form_interview/$1/$2');
$routes->get('/ppdb/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Root\Ppdb::index/$1/$2/$3/$4/$5/$6/$7/$8');
$routes->get('ppdb/cetak_pembagian_ruang/(:any)', 'Root\Ppdb::cetak_pembagian_ruang/$1');
$routes->get('ppdb/absen/(:any)/(:num)/(:any)', 'Root\Ppdb::absen/$1/$2/$3');
$routes->post('/ppdb/add', 'Root\Ppdb::add');
$routes->post('/ppdb/update', 'Root\Ppdb::update');
$routes->post('/ppdb/remove', 'Root\Ppdb::remove');
$routes->post('/ppdb/restore', 'Root\Ppdb::restore');
$routes->post('/ppdb/delete', 'Root\Ppdb::delete');
$routes->post('/ppdb/insert_to_santri', 'Root\Ppdb::insert_to_santri');
$routes->post('/ppdb/next', 'Root\Ppdb::next');
$routes->post('/ppdb/back', 'Root\Ppdb::back');
$routes->post('/ppdb/gagal', 'Root\Ppdb::gagal');
$routes->post('ppdb/add_image', 'Root\Ppdb::add_image');
$routes->post('ppdb/delete_file', 'Root\Ppdb::delete_file');
$routes->post('ppdb/pembagian_ruang_seleksi_ppdb', 'Root\Ppdb::pembagian_ruang_seleksi_ppdb');
$routes->post('ppdb/daftar_capel_by_penguji', 'Root\Ppdb::daftar_capel_by_penguji');
$routes->post('ppdb/save_pembagian_ruang', 'Root\Ppdb::save_pembagian_ruang');
$routes->post('ppdb/del_daftar_capel', 'Root\Ppdb::del_daftar_capel');

// sk
$routes->get('/sk/dtl/(:any)/(:any)/(:any)/(:any)/(:num)', 'Root\Sk::detail/$1/$2/$3/$4/$5');
$routes->get('/sk/cetak/(:any)/(:num)/(:any)', 'Root\Sk::cetak/$1/$2/$3');
$routes->get('/sk/(:any)/(:any)/(:any)/(:any)', 'Root\Sk::index/$1/$2/$3/$4');
$routes->post('/sk/update_no_sk', 'Root\Sk::update_no_sk');
$routes->post('/sk/copy', 'Root\Sk::copy');
$routes->post('/sk/delete', 'Root\Sk::delete');
$routes->post('/sk/update', 'Root\Sk::update');

// informasi
$routes->get('/informasi', 'Informasi\Informasi::index');
if (session('role') == 'Root') {
    $routes->get('/informasi/(:any)/(:any)', 'Informasi\Informasi::index/$1/$2');
}
$routes->post('/informasi/add', 'Informasi\Informasi::add');
$routes->post('/informasi/update', 'Informasi\Informasi::update');
$routes->post('/informasi/delete', 'Informasi\Informasi::delete');
$routes->post('/informasi/copy', 'Informasi\Informasi::copy');

// sertifikat
// piagam guru
$routes->get('/piagam/cetak/(:any)/(:num)/(:any)', 'Sertifikat\Piagam::cetak/$1/$2/$3');
$routes->get('/piagam/(:any)/(:any)', 'Sertifikat\Piagam::index/$1/$2');
$routes->post('/piagam/add', 'Sertifikat\Piagam::add');
$routes->post('/piagam/update', 'Sertifikat\Piagam::update');
$routes->post('/piagam/delete', 'Sertifikat\Piagam::delete');
$routes->post('/piagam/update_blur', 'Sertifikat\Piagam::update_blur');

// pilangsari
$routes->get('/pilangsari/cetak_data/(:any)/(:any)/(:any)/(:any)', 'Sertifikat\Pilangsari::cetak_data/$1/$2/$3/$4');
$routes->get('/pilangsari/cetak/(:any)/(:any)', 'Sertifikat\Pilangsari::cetak/$1/$2');
$routes->get('/pilangsari/(:any)/(:any)/(:any)/(:any)/(:any)', 'Sertifikat\Pilangsari::index/$1/$2/$3/$4/$5');
$routes->post('/pilangsari/add', 'Sertifikat\Pilangsari::add');
// $routes->post('/pilangsari/update', 'Sertifikat\Pilangsari::update');
$routes->post('/pilangsari/update_ket', 'Sertifikat\Pilangsari::update_ket');
$routes->post('/pilangsari/laporan', 'Sertifikat\Pilangsari::laporan');
$routes->post('/pilangsari/update_kategori', 'Sertifikat\Pilangsari::update_kategori');
$routes->post('/pilangsari/delete', 'Sertifikat\Pilangsari::delete');
$routes->post('/pilangsari/update_blur', 'Sertifikat\Pilangsari::update_blur');
$routes->post('/pilangsari/add_blur', 'Sertifikat\Pilangsari::add_blur');

// ekstra
// ekstra
$routes->get('/ekstra/cetak/(:any)/(:any)', 'Ekstra\Ekstra::cetak/$1/$2');
$routes->get('/ekstra', 'Ekstra\Ekstra::index');
$routes->post('/ekstra/add', 'Ekstra\Ekstra::add');
$routes->post('/ekstra/update', 'Ekstra\Ekstra::update');
$routes->post('/ekstra/delete', 'Ekstra\Ekstra::delete');
$routes->post('ekstra/add_image', 'Ekstra\Ekstra::add_image');
$routes->post('ekstra/delete_file', 'Ekstra\Ekstra::delete_file');

// mapel
$routes->get('/mapel/(:any)', 'Ekstra\Mapel::index/$1');
$routes->post('/mapel/add', 'Ekstra\Mapel::add');
$routes->post('/mapel/update', 'Ekstra\Mapel::update');
$routes->post('/mapel/delete', 'Ekstra\Mapel::delete');

// nilai
$routes->get('/nilai/(:any)/(:any)', 'Ekstra\Nilai::index/$1/$2');
$routes->post('/nilai/add', 'Ekstra\Nilai::add');
$routes->post('/nilai/update', 'Ekstra\Nilai::update');
$routes->post('/nilai/update_blur', 'Ekstra\Nilai::update_blur');
$routes->post('/nilai/update_nilai', 'Ekstra\Nilai::update_nilai');
$routes->post('/nilai/detail_js', 'Ekstra\Nilai::detail_js');
$routes->post('/nilai/delete', 'Ekstra\Nilai::delete');
$routes->post('/nilai/update_status', 'Ekstra\Nilai::update_status');

// pemilu
// partai
$routes->get('/partai', 'Pemilu\Partai::index');
$routes->get('/partai/dtl/(:num)', 'Pemilu\Partai::detail/$1');
$routes->post('/partai/add', 'Pemilu\Partai::add');
$routes->post('/partai/update', 'Pemilu\Partai::update');

// calon
$routes->get('/calon/(:any)', 'Pemilu\Calon::index/$1');
$routes->post('/calon/update', 'Pemilu\Calon::update');
$routes->post('/calon/flyer', 'Pemilu\Calon::flyer');
$routes->post('/calon/visi', 'Pemilu\Calon::visi');
$routes->post('/calon/delete', 'Pemilu\Calon::delete');

// kategori
$routes->get('/kategori', 'Pemilu\Kategori::index');
$routes->post('/kategori/add', 'Pemilu\Kategori::add');
$routes->post('/kategori/update', 'Pemilu\Kategori::update');
$routes->post('/kategori/delete', 'Pemilu\Kategori::delete');

// pemilih
$routes->get('/pemilih/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'Pemilu\Pemilih::index/$1/$2/$3/$4/$5/$6/$7');
$routes->post('/pemilih/update', 'Pemilu\Pemilih::update');
$routes->post('/pemilih/delete', 'Pemilu\Pemilih::delete');
$routes->post('/pemilih/absen', 'Pemilu\Pemilih::absen');
$routes->post('/pemilih/copy_to_next_year', 'Pemilu\Pemilih::copy_to_next_year');
$routes->post('/pemilih/get_jwt_login', 'Pemilu\Pemilih::get_jwt_login');
$routes->get('/pemilih/reset', 'Pemilu\Pemilih::reset');

// hasil
$routes->get('/hasil/(:any)', 'Pemilu\Hasil::index/$1');

// pemilu
$routes->get('/pemilu', 'Pemilu\Pemilu::index');

// vote
$routes->post('/vote', 'News\Home::execute');

// cetak
$routes->get('/cetak', 'Root\Cetak::index');
$routes->post('/cetak/db', 'Root\Cetak::db');
$routes->post('/cetak/col', 'Root\Cetak::col');
$routes->post('/cetak/filter', 'Root\Cetak::filter');
$routes->post('/cetak/get_data', 'Root\Cetak::get_data');
$routes->get('/cetak/cetak', 'Root\Cetak::cetak');
$routes->get('/cetak/ultah/(:any)/(:num)', 'Root\Cetak::ultah/$1/$2');



// rental
$routes->get('/rental/(:any)/(:any)', 'Rental\Rental::index/$1/$2');
if (session('role') == 'Root') {
    $routes->get('/rental/(:any)/(:any)/(:any)', 'Rental\Rental::index/$1/$2/$3');
}

// rental
$routes->post('/rental/pengeluaran', 'Rental\Rental::pengeluaran');
$routes->post('/rental/add_pengeluaran', 'Rental\Rental::add_pengeluaran');
$routes->post('/rental/add', 'Rental\Rental::add');
$routes->post('/rental/update_blur', 'Rental\Rental::update_blur');
$routes->post('/rental/update_tgl', 'Rental\Rental::update_tgl');
$routes->post('/rental/delete', 'Rental\Rental::delete');
$routes->post('rental/add_image', 'Rental\Rental::add_image');
$routes->post('rental/delete_file', 'Rental\Rental::delete_file');


// _____________________________________________________________________________________
// PUBLIC

// news
$routes->get('/public/news/single/(:any)', 'Public\News::single/$1');
$routes->get('/public/news/(:any)/(:any)', 'Public\News::filter_by/$1/$2');

// Member
// identitas untuk member ppdb
$routes->get('/identitas/member/ppdb/(:any)', 'Member\Ppdb::identitas/$1');
$routes->post('/identitas/member/ppdb/update', 'Member\Ppdb::update');

// identitas untuk member recruitment
$routes->get('/recruitment', 'Public\Recruitment::index');
$routes->get('/identitas/member/recruitment/(:any)', 'Member\Recruitment::identitas/$1');
$routes->post('/identitas/member/recruitment/update', 'Member\Recruitment::update');

// identitas untuk member ppdb sdi
$routes->get('/member-sdi', 'Member\Ppdb_sdi::index');
$routes->get('/member-sdi/(:any)', 'Member\Ppdb_sdi::index/$1');
$routes->post('/member-sdi/update', 'Member\Ppdb_sdi::update');

// rebana
$routes->get('/public/rental/laporan/cetak/(:any)/(:num)/(:any)', 'Public\Rental::laporan/$1/$2/$3');
$routes->get('/public/rebana/cetak/(:any)/(:any)/(:any)', 'Public\Rebana::cetak/$1/$2/$3');
$routes->get('/public/rebana', 'Public\Rebana::index');
$routes->get('/public/rebana/(:any)/(:any)', 'Public\Rebana::index/$1/$2');

// ppdb
$routes->get('/ppdb', 'Public\Ppdb::index');
$routes->get('/public/ppdb/kuitansi/(:any)', 'Public\Ppdb::kuitansi/$1');
$routes->get('/public/ppdb', 'Public\Ppdb::index');
$routes->get('/public/ppdb/(:any)/(:any)', 'Public\Ppdb::index/$1/$2');

// recruitment
$routes->get('/public/recruitment', 'Public\Recruitment::index');
$routes->get('/public/recruitment/(:any)/(:any)', 'Public\Recruitment::index/$1/$2');

// pemilu
$routes->get('/public/pemilu', 'Public\Pemilu::index');
$routes->get('/public/pemilu/(:any)/(:any)', 'Public\Pemilu::index/$1/$2');

// ekstra
$routes->get('/public/ekstra/cetak/pdf/(:any)', 'Public\Ekstra::cetak/$1');
$routes->get('/public/ekstra', 'Public\Ekstra::index');
$routes->get('/public/ekstra/(:any)', 'Public\Ekstra::index/$1');

// rental
$routes->get('/public/rental', 'Public\Rental::index');
$routes->get('/public/rental/(:any)/(:any)/(:any)', 'Public\Rental::index/$1/$2/$3');

// piagam
$routes->get('/public/piagam/(:any)', 'Public\Piagam::index/$1');

// pilangsari
$routes->get('/public/pilangsari/(:any)', 'Public\Pilangsari::index/$1');

// sertifikat
$routes->get('/public/sertifikat', 'Public\Sertifikat::index');
$routes->post('/public/sertifikat/get_data', 'Public\Sertifikat::get_data');

// auth
$routes->get('/public/a/(:any)', 'Public\Auth::index/$1');

// djana
$routes->get('/public/djana/nota/(:any)', 'Public\Djana::nota/$1');
$routes->get('/public/djana', 'Public\Djana::index');
$routes->get('/public/djana/(:any)/(:any)', 'Public\Djana::index/$1/$2');

// lpk
$routes->get('lpk', 'Public\Lpk::index');
$routes->get('public/lpk', 'Public\Lpk::index');


// ________________________________________________________________________________________
// rebana
$routes->get('rebana/cetak/(:any)/(:any)/(:any)', 'Rebana\Rebana::cetak/$1/$2/$3');
$routes->get('rebana/(:any)/(:any)', 'Rebana\Rebana::index/$1/$2');
$routes->post('rebana/add', 'Rebana\Rebana::add');
$routes->post('rebana/update', 'Rebana\Rebana::update');
$routes->post('rebana/update_lagu', 'Rebana\Rebana::update_lagu');
$routes->post('rebana/add_image', 'Rebana\Rebana::add_image');
$routes->post('rebana/delete_file', 'Rebana\Rebana::delete_file');
$routes->post('rebana/delete', 'Rebana\Rebana::delete');


// djana
// pesanan
$routes->get('pesanan/(:any)/(:any)', 'Djana\Pesanan::index/$1/$2');
$routes->post('pesanan/add', 'Djana\Pesanan::add');
$routes->post('pesanan/update', 'Djana\Pesanan::update');
$routes->post('pesanan/delete', 'Djana\Pesanan::delete');
$routes->post('pesanan/selesai', 'Djana\Pesanan::selesai');
$routes->post('pesanan/data_belum', 'Djana\Pesanan::data_belum');
$routes->post('pesanan/detail_js', 'Djana\Pesanan::detail_js');
$routes->post('pesanan/insert_to_laporan', 'Djana\Pesanan::insert_to_laporan');
$routes->post('pesanan/add_image', 'Djana\Pesanan::add_image');
$routes->post('pesanan/saldo', 'Djana\Pesanan::saldo');

// tugasku
$routes->get('tugasku/(:any)/(:any)/(:any)', 'Djana\Tugasku::index/$1/$2/$3');
$routes->post('tugasku/data_belum', 'Djana\Tugasku::data_belum');

// laporan
$routes->get('laporan/cetak/(:any)/(:any)', 'Djana\Laporan::cetak/$1/$2');
$routes->get('laporan/(:any)/(:any)', 'Djana\Laporan::index/$1/$2');

// inventaris
$routes->get('inventaris/cetak/(:any)/(:any)', 'Djana\Inventaris::cetak/$1/$2');
$routes->get('inventaris/(:any)/(:any)', 'Djana\Inventaris::index/$1/$2');
$routes->post('inventaris/update_kondisi', 'Djana\Inventaris::update_kondisi');

// nota
$routes->get('nota/cetak/(:any)', 'Djana\Nota::cetak/$1');
$routes->get('nota/(:any)/(:any)', 'Djana\Nota::index/$1/$2');
$routes->post('nota/update_qty', 'Djana\Nota::update_qty');
$routes->post('nota/cari_barang', 'Djana\Nota::cari_barang');
$routes->post('nota/create', 'Djana\Nota::create');

// kamera
$routes->get('kamera/(:any)/(:any)', 'Djana\Kamera::index/$1/$2');
$routes->post('kamera/add', 'Djana\Kamera::add');
$routes->post('kamera/update', 'Djana\Kamera::update');
$routes->post('kamera/delete', 'Djana\Kamera::delete');

// kamar
$routes->get('kamar', 'Kamar\Kamar::index');
if (session('role') == 'Root') {
    $routes->get('kamar/(:any)', 'Kamar\Kamar::index/$1');
}
$routes->post('kamar/add', 'Kamar\Kamar::add');
$routes->post('kamar/update', 'Kamar\Kamar::update');
$routes->post('kamar/delete', 'Kamar\Kamar::delete');

// iswa
$routes->get('iswa', 'Iswa\Iswa::index');
if (session('role') == 'Root') {
    $routes->get('iswa/(:any)', 'Iswa\Iswa::index/$1');
}
$routes->post('iswa/add', 'Iswa\Iswa::add');
$routes->post('iswa/update', 'Iswa\Iswa::update');
$routes->post('iswa/delete', 'Iswa\Iswa::delete');

// kelas
$routes->get('kelas', 'Kelas\Kelas::index');
$routes->get('kelas/(:any)', 'Kelas\Kelas::index/$1');
$routes->post('kelas/add', 'Kelas\Kelas::add');
$routes->post('kelas/update', 'Kelas\Kelas::update');
$routes->post('kelas/delete', 'Kelas\Kelas::delete');

// anggotakelas
$routes->get('anggotakelas', 'Anggotakelas\Anggotakelas::index');

// lpk
$routes->get('/program', 'Lpk\Program::index');
$routes->post('program/add', 'Lpk\Program::add');
$routes->post('program/update', 'Lpk\Program::update');
$routes->post('/program/delete', 'Lpk\Program::delete');

$routes->get('/biaya', 'Lpk\Biaya::index');
$routes->post('biaya/add', 'Lpk\Biaya::add');
$routes->post('biaya/update', 'Lpk\Biaya::update');
$routes->post('/biaya/delete', 'Lpk\Biaya::delete');

$routes->get('/siswa', 'Lpk\Siswa::index');
$routes->post('siswa/add', 'Lpk\Siswa::add');
$routes->post('siswa/update', 'Lpk\Siswa::update');
$routes->post('/siswa/delete', 'Lpk\Siswa::delete');

$routes->get('/pemberangkatan', 'Lpk\Pemberangkatan::index');
$routes->post('pemberangkatan/add', 'Lpk\Pemberangkatan::add');
$routes->post('pemberangkatan/update', 'Lpk\Pemberangkatan::update');
$routes->post('/pemberangkatan/delete', 'Lpk\Pemberangkatan::delete');

$routes->get('/pembayaran', 'Lpk\Pembayaran::index');
$routes->post('pembayaran/add', 'Lpk\Pembayaran::add');
$routes->post('pembayaran/add_rincian_pembayaran', 'Lpk\Pembayaran::add_rincian_pembayaran');
$routes->post('pembayaran/update_nota_lpk', 'Lpk\Pembayaran::update_nota_lpk');
$routes->post('pembayaran/update', 'Lpk\Pembayaran::update');
$routes->post('/pembayaran/delete', 'Lpk\Pembayaran::delete');
$routes->post('/pembayaran/delete_nota_lpk', 'Lpk\Pembayaran::delete_nota_lpk');

$routes->get('/setoran', 'Lpk\Setoran::index');
$routes->get('/setoran/detail_setoran/(:num)', 'Lpk\Setoran::detail/$1');
$routes->post('setoran/update', 'Lpk\Setoran::update');

// Sdi
$routes->get('/sdi-admin/detail-ppdb-sdi/(:any)/(:num)', 'Sdi\Admin::detail/$1/$2');
$routes->get('/sdi-admin/cetak/(:any)/(:any)', 'Sdi\Admin::cetak/$1/$2');
$routes->get('/sdi-admin', 'Sdi\Admin::index');
$routes->post('/sdi-admin/add', 'Sdi\Admin::add');
$routes->post('/sdi-admin/update', 'Sdi\Admin::update');
$routes->post('/sdi-admin/delete', 'Sdi\Admin::delete');
$routes->post('/sdi-admin/update_template_wa', 'Sdi\Admin::update_template_wa');
$routes->get('/sdi-admin/(:any)', 'Sdi\Admin::index/$1');

// Api
$routes->get('/api/tanah_baru', 'Api\Tanah_baru::index');
$routes->post('/api/add_rfid_santri', 'Api\Tanah_baru::add_rfid_santri');
