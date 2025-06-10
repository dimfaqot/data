<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<?php
$asc_icon = '<i class="fa-solid fa-arrow-down-short-wide secondary_dark_color"></i>';
$desc_icon = '<i class="fa-solid fa-arrow-down-wide-short"></i>';
$filter_by = ['Existing', 'Deleted', 'All'];
$gender = ['L', 'P', 'All'];

$db = db('recruitment', 'karyawan');
$tahun_rec = $db->groupBy('tahun_masuk')->orderBy('tahun_masuk', 'ASC')->get()->getResultArray();

?>

<div class="container" style="margin-top: 60px;">

    <div class="input-group input-group-sm mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn-sm btn_main" data-bs-toggle="modal" data-bs-target="#<?= menu()['controller']; ?>">
            <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tambah data baru." class="fa-solid fa-circle-plus"></i> <?= menu()['menu']; ?>
        </button>
        <select data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter data berdasar data yang eksis atau sudah dihapus." class="form-select filter_by">
            <?php foreach ($filter_by as $i) : ?>
                <option <?= ($i == url(4) ? 'selected' : ''); ?> value="<?= $i; ?>"><?= $i; ?></option>
            <?php endforeach; ?>
        </select>
        <select data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasarkan status <?= menu()['controller']; ?>." class="form-select filter_by_status">
            <?php foreach (options('Recruitment') as $i) : ?>
                <option <?= ($i['value'] == url(9) ? 'selected' : ''); ?> value="<?= $i['value']; ?>"><?= $i['value']; ?></option>
            <?php endforeach; ?>
            <option <?= (url(9) == 'All' ? 'selected' : ''); ?> value="All">All</option>
        </select>
    </div>


    <div class="modal fade" id="images" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-images"></i> Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <?php foreach (get_files('recruitment/public') as $k => $i) : ?>
                            <div class="col-md-4">
                                <div style="position: relative;">
                                    <div class="modal_confirm position-absolute top-50 start-50 d-none translate-middle btn_main_inactive message_confirm_<?= $k; ?>" style="z-index:9999;left:15px;right:15px;">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <span style="font-weight:500;">Delete?</span> <a href="" class="delete_file" data-dir="<?= $i; ?>"><i class="fa-solid fa-circle-check text-success"></i></a> <a href="" class="cancel_delete_file" data-i="<?= $k; ?>"><i class="fa-solid fa-circle-xmark text-danger"></i></a>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <a href="" class="top_right_corner confirm_delete_file" data-i="<?= $k; ?>"><i class="fa-solid fa-circle-xmark"></i></a>
                                            <img class="img-fluid" src="<?= base_url() . $i; ?>" alt="<?= $i; ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <small class="body_warning_img text-danger"></small>
    <form method="post" action="<?= base_url(); ?><?= menu()['controller']; ?>/add_image" class="form-floating mb-2" enctype="multipart/form-data">
        <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>">
        <input type="hidden" name="folder" value="<?= menu()['controller']; ?>/public">
        <div class="input-group input-group-sm mb-3 line_warning_img">
            <input type="file" class="form-control file" name="file" data-col="img" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pilih gambar.">
            <button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Upload gambar." class="btn_main_inactive" type="submit"><i class="fa-solid fa-circle-arrow-up"></i> Upload</button>
            <button data-bs-toggle="modal" data-bs-target="#images" class="btn_main" type="button"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat gambar." class="fa-solid fa-images"></i></button>
        </div>
    </form>

    <!-- Modal add-->
    <div class="modal fade" id="<?= menu()['controller']; ?>" tabindex="-1" aria-labelledby="cariLabel" aria-hidden="true" style="z-index:9999">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div class="main_color" style="font-weight: bold;"><i class="<?= menu()['icon']; ?>"></i> Tambah <?= menu()['menu']; ?></div>
                        <div><a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark main_color"></i></a></div>
                    </div>
                    <hr class="dark_color" style="border: 1px solid;">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url(menu()['controller']); ?>/add" method="post">
                                <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6) ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>">
                                <div class="form-floating mb-2">
                                    <input type="number" class="form-control check_tahun_masuk" name="tahun_masuk" value="<?= date('Y'); ?>" placeholder="Tahun Masuk" required>
                                    <label>Tahun Masuk</label>
                                    <div class="body_feedback_tahun_masuk invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control check_nama" name="nama" placeholder="Nama" required>
                                    <label>Nama</label>
                                    <div class="body_feedback_nama invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control check_hp" name="hp" placeholder="No. Hp" required>
                                    <label>No. Hp</label>
                                    <div class="body_feedback_hp invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-floating mb-2">
                                    <select style="font-size: small;" class="form-select check_gender" name="gender" required>
                                        <option value="">Click to gender</option>
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                    <label>Pilih Gender</label>
                                    <div class="body_feedback_gender invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-floating mb-2">
                                    <select style="font-size: small;" class="form-select check_sub" name="sub" required>
                                        <option value="">Click to select sub</option>
                                        <?php foreach (sub() as $i) : ?>
                                            <option value="<?= $i['singkatan']; ?>"><?= $i['singkatan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label>Pilih Sub</label>
                                    <div class="body_feedback_sub invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-floating mb-2">
                                    <select style="font-size: small;" class="form-select check_bidang_pekerjaan" name="bidang_pekerjaan" required>
                                        <option value="">Click to select bidang pekerjaan</option>
                                        <?php foreach (options('Pekerjaan') as $i) : ?>
                                            <option value="<?= $i['value']; ?>"><?= $i['value']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label>Pilih Bidang Pekerjaan</label>
                                    <div class="body_feedback_sub invalid-feedback">

                                    </div>
                                </div>

                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn-sm btn_main btn_check"><i class="fa-regular fa-floppy-disk"></i> Save</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-1 my-2">
        <div class="flex-grow-1">
            <div class="input-group input-group-sm">
                <button class="btn btn-outline-secondary" id="btn_custome_view" data-bs-toggle="offcanvas" data-bs-target="#canvas_custome_view" aria-controls="canvas_custome_view" type="button"><i class="fa-solid fa-filter"></i> View</button>
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cari daftar data di bawah." class="input-group-text">Cari <?= menu()['menu']; ?></span>
                <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cari daftar data di bawah." type="text" class="form-control cari" placeholder="...">
            </div>
        </div>
        <div>
            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tampilkan semua data berdasar filter." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= (url(5) == 'All' ? 1 : 'All'); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" type="button" class="btn-sm <?= (url(5) == 'All' ? 'btn_main' : 'btn_main_inactive'); ?>"><i class="fa-solid fa-eye"></i> Show All</a>
        </div>

    </div>

    <div class="d-none d-md-block mt-2">
        <div class="d-flex gap-1 mb-2">
            <?php foreach (sub() as $i) : ?>
                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasar sub <?= $i['singkatan']; ?>." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= $i['singkatan']; ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class="<?= (strtolower(url(6)) == strtolower($i['singkatan']) ? 'btn_secondary' : 'btn_main_inactive'); ?>">
                    <i class="fa-solid fa-sitemap"></i> <?= $i['singkatan']; ?>
                </a>
            <?php endforeach; ?>
            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tampilkan semua sub." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/All/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class="<?= (url(6) == 'All' ? 'btn_secondary' : 'btn_main_inactive'); ?>">
                <i class="fa-solid fa-sitemap"></i> All
            </a>
        </div>
    </div>

    <!-- sub menu sm -->
    <div class="d-block d-md-none d-sm-block mt-2">
        <button class="btn-sm btn_main_inactive" type="button" data-bs-toggle="offcanvas" data-bs-target="#sub_menu" aria-controls="sub_menu"><i class="fa-solid fa-bars"></i> Filter</button>
    </div>

    <!-- off canvas sub menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sub_menu" aria-labelledby="sub_menuLabel" style="width: 70%;">
        <div class="offcanvas-header shadow shadow-sm">
            <h6 class="offcanvas-title main_color" id="sub_menuLabel">Filter Sub</h6>
            <button type="button" class="btn-close main_color" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-1">
            <div class="list-group">
                <?php foreach (sub() as $i) : ?>
                    <a href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= $i['singkatan']; ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" type="button" class="<?= (url(6) == $i['singkatan'] ? 'btn_secondary' : 'btn_main_inactive'); ?> mb-1 sub_menu" data-sub_menu="<?= $i['singkatan']; ?>" style="border-radius: 3px; text-align:left;"><i class="fa-solid fa-sitemap"></i> <?= $i['singkatan']; ?></a>
                <?php endforeach; ?>
                <a href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/All/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class="<?= (url(6) == 'All' ? 'btn_secondary' : 'btn_main_inactive'); ?>">
                    <i class="fa-solid fa-sitemap"></i> All
                </a>
            </div>
        </div>
    </div>

    <?php if (count($data['data']) == 0) : ?>
        <div class="d-flex justify-content-between mb-2">
            <div class="d-flex gap-1">
                <div class="btn_main_inactive">
                    <?php foreach ($gender as $i) : ?>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasar gender(<?= $i; ?>)." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= $i; ?>"><span class="badge <?= (url(10) == $i ? 'text-bg-success' : 'text-bg-light'); ?>"><?= $i; ?></span></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="mt-2 text-danger"><i class="fa-solid fa-circle-exclamation"></i> Data tidak ditemukan!.</div>
    <?php else : ?>
        <div class="d-flex justify-content-between mb-2">
            <div>
                <small data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Total data dari total data." class="dark_color"><?= $data['data_ditampilkan']; ?> from <?= $data['total_data']; ?></small>
            </div>
            <div class="d-flex gap-1">

                <div class="btn_main_inactive">
                    <?php foreach ($gender as $i) : ?>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasar gender(<?= $i; ?>)." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= $i; ?>"><span class="badge <?= (url(10) == $i ? 'text-bg-success' : 'text-bg-light'); ?>"><?= $i; ?></span></a>
                    <?php endforeach; ?>
                </div>
                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download excel" target="_blank" href="<?= base_url(menu()['controller']); ?>/cetak/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>/excel" class="btn_main_inactive" style="font-style:italic;"><i class="fa-solid fa-file-excel"></i> Print Excel</a>
                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download pdf" target="_blank" href="<?= base_url(menu()['controller']); ?>/cetak/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>/pdf" class="btn_main_inactive" style="font-style:italic;"><i class="fa-solid fa-paste"></i> Print Pdf</a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <th scope="col">#</th>
                <th>No. Id <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar no. id." href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/no_id/<?= (url(8) == 'ASC' ? 'DESC' : 'ASC'); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= (url(7) == 'no_id' && url(8) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Nama <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar nama." href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/nama/<?= (url(8) == 'ASC' ? 'DESC' : 'ASC'); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= (url(7) == 'nama' && url(8) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Hp <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar hp." href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/hp/<?= (url(8) == 'ASC' ? 'DESC' : 'ASC'); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= (url(7) == 'hp' && url(8) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Umur <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar umur." href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/umur/<?= (url(8) == 'ASC' ? 'DESC' : 'ASC'); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= (url(7) == 'umur' && url(8) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Cv</th>
                <th>Status <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar status." href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/status/<?= (url(8) == 'ASC' ? 'DESC' : 'ASC'); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= (url(7) == 'status' && url(8) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Act</th>
            </thead>
            <tbody class="tabel_search">
                <?php foreach ($data['data'] as $k => $i) : ?>
                    <?php $sapaan = ($i['gender'] == 'L' ? 'Bapak' : 'Ibu'); ?>
                    <?php $no = "+62" . substr($i['hp'], 1); ?>
                    <tr>
                        <th scope="row"><?= ($k + 1); ?></th>
                        <td><?= $i['no_id']; ?></td>
                        <td><a href="" data-tabel="karyawan" data-id="<?= $i['no_id']; ?>" data-no="<?= $no; ?>" data-section="Recruitment" data-role="Member" data-nama="<?= $i['nama']; ?>" data-gender="<?= $i['gender']; ?>" class="auth_url" style="text-decoration: none;"><?= $i['nama']; ?></a></td>
                        <td><?= ($i['hp'] == '' || strlen($i['hp']) < 11 ? '-' : '<a class="btn_main btn_send_wa_with_link" data-col="hp" data-link="' . base_url('public/a/') . encode_jwt(['id' => $i['no_id'], 'username' => '', 'gender' => $i['gender'], 'no_id' => $i['no_id'], 'section' => 'Recruitment', 'role' => 'Member', 'nama' => $i['nama']]) . '" data-role="Member" data-gender="' . $i['gender'] . '" data-section="Recruitment" data-order-id="' . $i['no_id'] . '" data-sapaan="' . $sapaan . '" data-nama="' . $i['nama'] . '" data-no="+62' . substr($i['hp'], 1) . '" style="font-size:10px;" href=""><i class="fa-brands fa-whatsapp"></i> ' . $i['hp'] . '</a>'); ?></td>
                        <td><?= $i['umur']; ?></td>
                        <td><a target="_blank" class="btn_main" style="font-size:10px;" href="<?= base_url(); ?>berkas/<?= menu()['controller']; ?>/<?= $i['cv']; ?>"><i class="fa-regular fa-file-pdf"></i> Cv</a></td>
                        <td><?= $i['status']; ?></td>
                        <td>
                            <span class="btn_main_inactive"><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit data." class="main_color" href="<?= base_url() . url(3); ?>/detail/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>/<?= $i['no_id']; ?>/Profile" style="font-size: medium;"><i class="fa-solid fa-square-pen"></i></a> <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak pdf." style="font-size: 14px;" target="_blank" href="<?= base_url(menu()['controller']); ?>/cetak/single/<?= $i['no_id']; ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>/pdf" class="dark_color"><i class="fa-solid fa-file-pdf"></i></a>
                                <?php if ($i['deleted'] == 0) : ?>
                                    <?php if ($i['status'] == 'Diterima') : ?>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ke tahapan sebelumnya." href="" class="confirm secondary_dark_color" data-order="back" data-method="back" data-status="<?= $i['status']; ?>" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-chevron-left"></i></a> <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Masukkan data ke karyawan." href="" class="confirm secondary_dark_color" data-order="insert" data-method="insert_to_karyawan" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-square-arrow-up-right"></i></a>
                                    <?php endif; ?>

                                    <?php if ($i['status'] == 'Register') : ?>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ke tahapan selanjutnya." href="" class="confirm secondary_dark_color" data-order="next" data-method="next" data-status="<?= $i['status']; ?>" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-chevron-right"></i></a>
                                    <?php endif; ?>

                                    <?php if ($i['status'] == 'Interview') : ?>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ke tahapan sebelumnya." href="" class="confirm secondary_dark_color" data-order="back" data-method="back" data-status="<?= $i['status']; ?>" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-chevron-left"></i></a> <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Gagal/Tidak diterima" href="" class="confirm text-danger" data-order="gagal" data-method="gagal" data-status="<?= $i['status']; ?>" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-stop"></i></a> <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lolos/Diterima." href="" class="confirm secondary_dark_color" data-order="next" data-method="next" data-status="<?= $i['status']; ?>" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-chevron-right"></i></a>
                                    <?php endif; ?>

                                    <?php if ($i['status'] == 'Gagal') : ?>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kembali ke interview." href="" class="confirm secondary_dark_color" data-order="back" data-method="back" data-status="<?= $i['status']; ?>" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-chevron-left"></i></a> <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lolos/Diterima." href="" class="confirm secondary_dark_color" data-order="next" data-method="next" data-status="<?= $i['status']; ?>" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-circle-chevron-right"></i></a>
                                    <?php endif; ?>
                                    <?php if ($i['status'] !== 'Diterima') : ?>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove data ini." href="" class="confirm" data-order="remove" data-method="remove" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-square-xmark danger_color"></i></a>
                                    <?php endif; ?>
                                <?php else : ?>

                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Restore data ini." href="" class="confirm secondary_dark_color" data-order="restore" data-method="restore" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-rotate-left"></i></a> <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete permanen data ini." href="" class="confirm text-danger" data-order="delete" data-method="delete" data-id="<?= $i['no_id']; ?>" style="font-size: medium;"><i class="fa-solid fa-trash"></i></a>
                                <?php endif; ?>
                            </span>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-grid text-center">
            <?php if (url(5) == 'All') : ?>
                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kurangi data yang ditampilkan" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/1/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class="btn_main_inactive" style="font-style:italic;">Load less <i class="fa-solid fa-angles-up"></i></a>

            <?php else : ?>
                <?php if ($data['data_ditampilkan'] < $data['total_data']) : ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Perbanyak data yang ditampilkan" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5) + 1; ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class=" btn_main" style="font-style:italic;">Load more <i class="fa-solid fa-angles-down"></i></a>
                <?php else : ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kurangi data yang ditampilkan" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/1/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class="btn_main_inactive" style="font-style:italic;">Load less <i class="fa-solid fa-angles-up"></i></a>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>


<!-- canvas custome view -->

<div class="offcanvas offcanvas-top vh-100" tabindex="-1" id="canvas_custome_view" aria-labelledby="canvas_custome_viewLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="canvas_custome_viewLabel">Custome View</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="judul mb-2">
            <label>Tahun</label>
            <select class="form-select form-select-sm canvas_tahun">
                <?php foreach ($tahun_rec as $i) : ?>
                    <option <?= ($i['tahun_masuk'] == date('Y') ? 'selected' : ''); ?> value="<?= $i['tahun_masuk']; ?>"><?= $i['tahun_masuk']; ?></option>
                <?php endforeach; ?>
                <option value="All">All</option>
            </select>
        </div>
        <div class="judul mb-2">
            <label>Data Yang Dihapus dan Exist</label>
            <div class="d-flex gap-2">
                <div class="form-check form-switch">
                    <input name="deleted" class="form-check-input" value="Deleted" type="radio" role="switch">
                    <label class="form-check-label">Deleted</label>
                </div>
                <div class="form-check form-switch">
                    <input name="deleted" class="form-check-input" value="Existing" type="radio" role="switch" checked>
                    <label class="form-check-label">Existing</label>
                </div>
                <div class="form-check form-switch">
                    <input name="deleted" class="form-check-input" value="All" type="radio" role="switch">
                    <label class="form-check-label">All</label>
                </div>
            </div>
        </div>
        <div class="judul mb-2">
            <label>Tahapan Peserta Recruitment</label>
            <div class="d-flex gap-2">
                <div class="form-check form-switch">
                    <input name="proses" class="form-check-input" value="Register" type="radio" role="switch" checked>
                    <label class="form-check-label">Register</label>
                </div>
                <div class="form-check form-switch">
                    <input name="proses" class="form-check-input" value="Interview" type="radio" role="switch">
                    <label class="form-check-label">Interview</label>
                </div>
                <div class="form-check form-switch">
                    <input name="proses" class="form-check-input" value="Diterima" type="radio" role="switch">
                    <label class="form-check-label">Diterima</label>
                </div>
                <div class="form-check form-switch">
                    <input name="proses" class="form-check-input" value="Gagal" type="radio" role="switch">
                    <label class="form-check-label">Gagal</label>
                </div>
                <div class="form-check form-switch">
                    <input name="proses" class="form-check-input" value="All" type="radio" role="switch">
                    <label class="form-check-label">All</label>
                </div>
            </div>
        </div>

        <div class="judul mb-2">
            <label>Sub</label>
            <select class="form-select form-select-sm canvas_sub">
                <?php foreach (sub() as $i) : ?>
                    <option <?= ($i['singkatan'] == 'SMP' ? 'selected' : ''); ?> value="<?= $i['singkatan']; ?>"><?= $i['singkatan']; ?></option>
                <?php endforeach; ?>
                <option value="All">All</option>
            </select>
        </div>

        <div class="judul mb-2">
            <label>Bidang Pekerjaan</label>
            <select class="form-select form-select-sm canvas_pekerjaan">
                <?php foreach (options('pekerjaan') as $i) : ?>
                    <option value="<?= $i['value']; ?>"><?= $i['value']; ?></option>
                <?php endforeach; ?>
                <option value="All" selected>All</option>
            </select>
        </div>

        <div class="judul mb-2">
            <label>Data Yang Ingin Ditampilkan</label>
            <div class="d-flex gap-2">
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="nama" type="checkbox" role="switch" checked>
                    <label class="form-check-label">Nama</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="gender" type="checkbox" role="switch">
                    <label class="form-check-label">Gender</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="ttl" type="checkbox" role="switch">
                    <label class="form-check-label">Ttl</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="alamat_lengkap" type="checkbox" role="switch">
                    <label class="form-check-label">Alamat</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="hp" type="checkbox" role="switch">
                    <label class="form-check-label">Hp</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="bidang_pekerjaan" type="checkbox" role="switch">
                    <label class="form-check-label">Pekerjaan</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="sub" type="checkbox" role="switch">
                    <label class="form-check-label">Sub</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="pendidikan" type="checkbox" role="switch">
                    <label class="form-check-label">Pendidikan</label>
                </div>
                <div class="form-check form-switch">
                    <input name="cols" class="form-check-input" value="cv" type="checkbox" role="switch" checked>
                    <label class="form-check-label">Cv</label>
                </div>
            </div>
        </div>

        <div class="d-grid">
            <button class="btn_main btn_tampilkan_costome_view">Tampilkan</button>
        </div>


        <div class="fixed-top mt-5 canvas_custome_view_popup" style="display: none;">
            <div class="container h-100">
                <div class="d-flex justify-content-end">
                    <a href="" class="close_canvas_popup"><i class="fa-solid fa-circle-xmark" style="font-size:x-large;color:red"></i></a>

                </div>
                <div class="row h-100 justify-content-center align-items-center body_custome_view_popup bg-light p-3" style="border-radius: 5px;border:1px solid #e0dddd">

                </div>
            </div>
        </div>
        <div class="vh-100 body_canvas_custome_view" style="overflow-y: auto;">

        </div>
    </div>
</div>

<script>
    // CK EDITOR MEMBER IDENTITAS
    let ck_input_identitas;
    ClassicEditor
        .create(document.querySelector('#ck_input'))
        .then(newEditor => {
            ck_input_identitas = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
    let datas;
    const get_data_custome_view = () => {
        let deleted = $('input[name="deleted"]:checked').val();
        let proses = $('input[name="proses"]:checked').val();
        let sub = $('.canvas_sub').val();
        let pekerjaan = $('.canvas_pekerjaan').val();
        let tahun = $('.canvas_tahun').val();
        let cols = $('input:checkbox:checked').map(function() {
            if (this.value !== 'on') {
                return this.value;
            }
        }).get();
        let data = {
            deleted,
            proses,
            sub,
            pekerjaan,
            tahun,
            cols
        }

        post('recruitment/custome_view', data).then(res => {
            if (res.status == '200') {
                datas = res.data;
                let html = '';
                html += '<div class="mt-3 body_cetak_interview" style="display:none">';
                html += '<a href="" data-order="absen" class="btn_secondary_inactive btn_cetak_interview">Absen</a> <a href="" data-order="form" class="btn_secondary btn_cetak_interview">Form</a>';
                html += '</div>';
                html += '<table class="table table-sm table-striped mt-3">';
                html += '<thead>';
                html += '<tr>';
                html += '<th scope="col">#</th>';
                html += '<td>Check</td>';
                cols.forEach(e => {
                    html += '<th scope="col">' + upper_first(e) + '</th>';
                })
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                res.data.forEach((e, i) => {
                    html += '<tr>';
                    html += '<th scope="row">' + (i + 1) + '</th>';
                    html += '<td>';
                    html += '<input data-no_id="' + e.no_id + '" class="form-check-input cetak_interview" type="checkbox" value="">';
                    html += '</td>';
                    cols.forEach(el => {
                        if (el == 'pendidikan' || el == 'hp' || el == 'cv') {
                            if (el == 'cv') {
                                if (e['cv'] == 'file_not_found.jpg') {
                                    html += '<td style="color:red"><i class="fa-solid fa-circle-xmark"></i></td>';
                                } else {
                                    html += '<td><a href="" class="btn_detail_canvas text-success" data-no_id="' + e.no_id + '" data-col="' + el + '"><i class="fa-solid fa-square-up-right"></i></a></td>'
                                }
                            } else {
                                html += '<td><a href="" class="btn_detail_canvas text-success" data-no_id="' + e.no_id + '" data-col="' + el + '">' + (el == 'hp' ? '<i class="fa-brands fa-square-whatsapp"></i>' : e[el]) + '</a></td>'
                            }
                        } else {
                            html += '<td>' + e[el] + '</td>'
                        }
                    })
                    html += '</tr>';
                })
                html += '</tbody>';
                html += '</table>';

                $('.body_canvas_custome_view').html(html);
            } else {
                gagal_with_button(res.message);
            }
        })

    }

    function pendidikan(data) {

        let html = '';
        html += '<h6 class="judul">S1</h6>'
        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Kampus</span>';
        html += '<input type="text" class="form-control" value="' + (data.kampus_s1 == '' ? '-' : data.kampus_s1) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Fakultas</span>';
        html += '<input type="text" class="form-control" value="' + (data.fakultas_s1 == '' ? '-' : data.fakultas_s1) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Jurusan</span>';
        html += '<input type="text" class="form-control" value="' + (data.jurusan_s1 == '' ? '-' : data.jurusan_s1) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">IPK</span>';
        html += '<input type="text" class="form-control" value="' + (data.ipk_s1 == '' ? '-' : data.ipk_s1) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Gelar</span>';
        html += '<input type="text" class="form-control" value="' + (data.gelar_s1 == '' ? '-' : data.gelar_s1) + '" readonly>';
        html += '</div>';

        html += '<h6 class="judul">S2</h6>'
        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Kampus</span>';
        html += '<input type="text" class="form-control" value="' + (data.kampus_s2 == '' ? '-' : data.kampus_s2) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Fakultas</span>';
        html += '<input type="text" class="form-control" value="' + (data.fakultas_s2 == '' ? '-' : data.fakultas_s2) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Jurusan</span>';
        html += '<input type="text" class="form-control" value="' + (data.jurusan_s2 == '' ? '-' : data.jurusan_s2) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">IPK</span>';
        html += '<input type="text" class="form-control" value="' + (data.ipk_s2 == '' ? '-' : data.ipk_s2) + '" readonly>';
        html += '</div>';

        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Gelar</span>';
        html += '<input type="text" class="form-control" value="' + (data.gelar_s2 == '' ? '-' : data.gelar_s2) + '" readonly>';
        html += '</div>';

        html += '<h6 class="judul">KHUSUS SELAIN SARJANA</h6>'
        html += '<div class="input-group input-group-sm mb-2">';
        html += '<span style="width:80px" class="input-group-text">Pendidikan</span>';
        html += '<input type="text" class="form-control" value="' + (data.pendidikan_terakhir == '' ? '-' : data.pendidikan_terakhir) + '" readonly>';
        html += '</div>';

        $('.body_custome_view_popup').html(html);
        $('.canvas_custome_view_popup').fadeIn();
    }

    function cv(data) {
        window.open('<?= base_url(); ?>' + 'berkas/recruitment/' + data.cv, '_blank').focus();
    }

    function hp(data) {
        let link = "<?= settings('pengumuman'); ?>";
        let nama = data.nama;
        let no = '+62' + data.hp.substring(1);
        let pembuka = "<?= settings('pembuka'); ?>";
        let tgl = "<?= settings('tgl'); ?>";
        let jam = "<?= settings('jam'); ?>";
        let tempat = "<?= settings('tempat'); ?>";
        let acara = "<?= settings('acara'); ?>";
        let penutup = "<?= settings('penutup'); ?>";
        let nb = "<?= settings('nb'); ?>";

        let text = 'Assalamualaikum wr.wb%0a';
        text += 'Yth: ' + nama + '%0a%0a';
        text += pembuka + '%0a';
        text += 'Tanggal: ' + tgl + '%0a';
        text += 'Waktu: ' + jam + '%0a';
        text += 'Tempat: ' + tempat + '%0a';
        text += 'Acara: ' + acara + '%0a';
        text += '%0a';
        text += penutup + '%0a';
        text += 'Wassalamualaikum Wr. Wb.';
        text += '%0a%0a';
        text += '*NB:*%0a';
        text += nb;
        text += 'Klik link di bawah ini untuk join grup whatsapp!.%0a';
        text += '*_JANGAN BAGIKAN LINK INI KEPADA SIAPAPUN!_*%0a';
        text += link;
        text += '%0a%0aTTD%0a%0a';
        text += 'PANITIA';

        window.location.href = 'whatsapp://send/?phone=' + no + '&text=' + text;
    }
    $(document).on('click', '.btn_tampilkan_costome_view', function(e) {
        e.preventDefault();
        get_data_custome_view();
    })
    $(document).on('click', '#btn_custome_view', function(e) {
        e.preventDefault();
        get_data_custome_view();
    })
    $(document).on('click', '.btn_detail_canvas', function(e) {
        e.preventDefault();
        let col = $(this).data('col');
        let no_id = $(this).data('no_id');
        let data;
        datas.forEach(e => {
            if (e.no_id == no_id) {
                data = e;
            }
        })
        window[col](data);
    })
    $(document).on('click', '.close_canvas_popup', function(e) {
        e.preventDefault();
        $('.canvas_custome_view_popup').fadeOut();
    })
    $(document).on('change', '.cetak_interview', function(e) {
        e.preventDefault();
        let elems = document.getElementsByClassName('cetak_interview');
        let no_ids = [];
        for (let i = 0; i < elems.length; i++) {
            if (elems[i].checked) {
                no_ids.push(elems[i].getAttribute('data-no_id'));
            }
        }
        if (no_ids.length <= 0) {
            $('.body_cetak_interview').fadeOut();

        } else {
            $('.body_cetak_interview').fadeIn();
        }
    })
    $(document).on('click', '.btn_cetak_interview', function(e) {
        e.preventDefault();
        let order = $(this).data('order');
        let elems = document.getElementsByClassName('cetak_interview');
        let no_ids = [];
        for (let i = 0; i < elems.length; i++) {
            if (elems[i].checked) {
                no_ids.push(elems[i].getAttribute('data-no_id'));
            }
        }
        if (no_ids.length <= 0) {
            gagal('Data belum dipilih!.');
            return false;
        }
        let data = {
            data: no_ids.join(","),
            order
        }


        post("encode", {
            data
        }).then((res) => {
            if (res.status == '200') {
                window.open('<?= base_url('recruitment/cetak_interview/'); ?>' + res.data, '_blank');
            } else {
                gagal(res.message);
            }
        })
    })
</script>
<?= $this->endSection() ?>