<?php
$logo = strtolower(session('section'));

if ($logo == 'root' ||  $logo == 'member' || $logo == 'yayasan' || $logo == 'angkatan' || $logo == 'region') {
    $logo = 'karyawan';
}
if ($logo == 'pondok') {
    $logo = 'ppdb';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a193ca89ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>berkas/menu/<?= $logo; ?>.png" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/style.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <?php if (get_db(menu()['tabel']) == 'djana' || get_db(menu()['tabel']) == 'lpk') : ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <?php endif; ?>

    <?php if (url() == 'sdi-admin' || url() == 'member-sdi') : ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <?php endif; ?>

</head>


<body style="margin-bottom: 70px;" class="bg-light">

    <!-- warning alert message -->
    <div class="box_warning" style="position:fixed;z-index:999999;display:none;">

    </div>
    <!-- warning alert message with button -->
    <div class="box_warning_with_button" style="position:fixed;z-index:999999;display:none;">

    </div>
    <!-- warning confirm -->
    <div class="box_confirm" style="position:fixed;z-index:999999;display:none;">

    </div>

    <!-- zoom_image -->
    <div class="box_zoom_image" style="position:fixed;z-index:999999;display:none;">

    </div>

    <!-- loading -->
    <div class="blur waiting" style="display:none">
        <div class="middlecenter">
            <div class="load">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>




    <!-- sukses js -->
    <div class="sukses middlecenter" style="display: none;">
        <div class="wrapper"> <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </div>
    </div>



    <!-- gagal js -->
    <div class="gagal blur" style="border-radius: 10px; z-index:99999999; display:none">
        <div class="middlecenter">
            <div class="d-flex justify-content-between bg-danger px-1" style="border-radius: 10px;width:300px; color:lightpink;font-size:12px;">

                <div class="toast-body p-2 textGagal" style="border-radius: 10px; font-size:12px;">

                </div>
                <div>
                    <button type="button" class="btn btn-sm m-auto btnclose" style="color:lightpink;"><i class="fa fa-times-circle"></i></button>
                </div>
            </div>
        </div>
    </div>

    <?php if (url() !== 'pemilu') : ?>
        <!-- navbar md-->

        <div class="d-none d-md-block fixed-top shadow shadow-sm">
            <div class="container bg-light d-flex d-flex justify-content-between">
                <div class="d-flex gap-2">
                    <a class="navbar-brand" style="padding-top: 7px;" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>berkas/menu/<?= $logo; ?>.png" alt="LOGO" width="30"></a>

                    <?php if (session('role') == 'Root') : ?>
                        <?= view('menu/root'); ?>
                    <?php else : ?>
                        <?= view('menu/member'); ?>
                    <?php endif; ?>
                </div>
                <div class="d-flex p-1 gap-1">
                    <?php if (session('role') == 'Admin' || session('role') == 'Root') : ?>

                        <div class="pt-1 mx-1" style="margin-top: 1px;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Template Whatsapp.">
                            <a type="button" class="main_color" style="font-size:large;" data-bs-toggle="modal" data-bs-target="#template_wa">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>

                    <?php endif; ?>
                    <div class="pt-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tampilkan panduan.">
                        <div class="form-check form-switch" style="padding-top: 5px;">
                            <input class="form-check-input panduan" type="checkbox" role="switch" <?= (panduan() == 1 ? 'checked' : ''); ?>>
                        </div>
                    </div>
                    <div class="input-group input-group-sm my-1">
                        <span class="px-3 py-1" style="background-color: #f2f2f2; border:1px solid #cccccc; color:#666666;font-size:small;border-radius:10px;"><?= session('nama'); ?>/<?= session('role'); ?></span>
                    </div>
                    <form action="<?= base_url(); ?>logout" method="post">
                        <div class="my-1 text-end" style="width:80px">
                            <button type="submit" class="btn btn-danger" data-order="md" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Logout
                            </button>
                        </div>
                    </form>
                </div>



            </div>
        </div>


        <!-- navbar sm -->
        <div class="d-block d-md-none d-sm-block fixed-top" style="top:-5px">
            <div class="container bg-light py-2 shadow shadow-sm">
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>berkas/menu/<?= $logo; ?>.png" alt="LOGO" width="30"></a>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="pt-1">
                            <span class="px-3 py-1" style="background-color: #f2f2f2; border:1px solid #cccccc; color:#666666;font-size:x-small;border-radius:10px;"><i class="<?= menu()['icon']; ?>"></i> <?= session('nama'); ?>/<?= session('role'); ?></span>
                        </div>
                        <div style="padding-top: 3px;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Template Whatsapp.">
                            <a type="button" class="main_color" style="font-size:large;" data-bs-toggle="modal" data-bs-target="#template_wa">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>

                    </div>

                    <div class="pt-1">
                        <a href="" class="text-muted" data-bs-toggle="offcanvas" data-bs-target="#leftMenu" aria-controls="leftMenu"><i class="fa-solid fa-bars"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <!-- camvas -->
        <div class="offcanvas offcanvas-start" style="width:90%" data-bs-scroll="true" tabindex="-1" id="leftMenu" aria-labelledby="leftMenuLabel">
            <div class="offcanvas-header shadow shadow-bottom shadow-sm">
                <h6 class="offcanvas-title" id="leftMenuLabel">Menu</h6>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php foreach (menus() as $i) : ?>
                    <div class="mb-1 d-grid">
                        <a href="<?= base_url(); ?><?= $i['controller']; ?><?= ($i['controller'] == 'menu' ? '/Root' : ($i['controller'] == 'user' ? '/Recruitment' : ($i['controller'] == 'options' ? '/Role' : ($i['controller'] == 'rebana' || $i['controller'] == 'rental' ? '/' . date('Y') . '/' . date('m') : ($i['controller'] == 'karyawan' || $i['controller'] == 'recruitment' ? '/Existing/1/SMP/updated_at/DESC/' . ($i["controller"] == "karyawan" ? "Aktif" : "Register") . '/All' : ($i['controller'] == 'sk' ? '/All/' . date('Y') . '/updated_at/DESC' : ($i['controller'] == 'pilangsari' ? '/Karyawan/1/updated_at/DESC/SSJ'  : ($i['controller'] == 'piagam' ? '/Dinas/' . date('Y') : ($i['controller'] == 'santri' || $i['controller'] == 'ppdb' ? '/' . ($i['controller'] == 'santri' ? 'All' : tahun_santri('ppdb')) . '/Existing/1/SMP/updated_at/DESC/' . ($i["controller"] == "santri" ? "Aktif" : "Register") . '/All' : ($i['controller'] == 'mapel' ? '/MUL' : ($i['controller'] == 'nilai' ? '/' . date('Y') . '/MUL' : ($i['controller'] == 'calon' || $i['controller'] == 'hasil' ? '/' . date('Y') : ($i['controller'] == 'pemilih' ? '/' . date('Y') . '/Belum/1/Karyawan/Putra/updated_at/DESC' : ($i['controller'] == 'artikel' ? '/label/Headlines/1/updated_at/DESC' : ($i['controller'] == 'pesanan' || $i['controller'] == 'laporan' || $i['controller'] == 'inventaris' || $i['controller'] == 'nota' ? '/' . date('Y') . '/' . date('m') : ($i['controller'] == 'tugasku' ? '/' . date('Y') . '/' . date('m') . '/All' : ($i['controller'] == 'kamera' ? '/' . date('Y') . '/' . date('m') : ($i['controller'] == 'sk' ? '/All/' . date('Y') . '/updated_at/DESC' : ($i['controller'] == 'identitas' ? '/' . strtolower(session('role')) . '/' . strtolower(session('section')) . '/Profile' : ''))))))))))))))))))); ?>" style="font-size: small;" class="px-3 py-1 <?= (url() == $i['controller'] ? 'btn_main' : 'btn_main_inactive'); ?>"><i class="<?= $i['icon']; ?>"></i> <?= $i['menu']; ?></a>
                    </div>
                <?php endforeach; ?>
                <form class="mt-3" action="<?= base_url(); ?>logout" method="post">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger" data-order="md" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Logout
                        </button>
                    </div>
                </form>

            </div>
        </div>

    <?php endif; ?>
    <div class="modal_confirm position-absolute top-50 start-50 translate-middle" style="display: none;z-index:9000"></div>

    <!-- body_modal_cari_db-->
    <div class="modal fade" id="body_modal_cari_db" tabindex="-1" aria-labelledby="cariLabel" aria-hidden="true" style="z-index:9999">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-2">
                    <div class="body_tabel_api"></div>
                    <div class="input-group input-group-sm mb-2 body_modal_cari_db">

                    </div>

                </div>
                <div style="position:relative">
                    <div class="list-group px-2 pb-2 body_hasil_cari_db">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal zoom -->
    <div class="modal fade" id="modal_zoom" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <h6 class="judul_modal" style="margin-left:20px;margin-top:20px;"></h6>
                <div class="modal-body d-flex justify-content-center body_download">

                </div>
                <div class="download_footer d-grid gap-2 d-flex justify-content-center mb-3">

                </div>
            </div>
        </div>
    </div>

    <!-- modal auth url -->
    <div class="modal fade" id="modal_auth_url" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body py-2">
                    <div class="card">
                        <div class="card-body body_auth_url">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- template whatsapp -->
    <div class="modal fade" id="template_wa" tabindex="-1" aria-labelledby="template_waLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-content">
                    <h6 class="main_color mb-0" style="margin-left:20px;margin-top:20px;font-size:small;"><i class="fa-brands fa-whatsapp"></i> Template Whatsapp</h6>
                    <div class="modal-body">
                        <form action="<?= base_url(); ?>/update_wa" method="post">
                            <input type="hidden" name="url" value="<?= url(); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>/<?= url(11); ?>/<?= url(12); ?>/<?= url(13); ?>/<?= url(4); ?>/<?= url(15); ?>">
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control text_selected" placeholder="Text Selected" readonly>
                                <button type="button" class="btn_main_inactive miring" style="font-style: italic;font-weight:bold;">I (_..._)</button>
                                <button type="button" class="btn_main_inactive tebal" style="font-weight:bold;">B (*...*)</button>
                                <button type="button" class="btn_main_inactive enter" style="font-weight:bold;"><i class="fa-solid fa-arrow-turn-down"></i> (%0a)</button>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <div class="form-check form-switch form-check-reverse">
                                    <input class="form-check-input wa_template_link" type="checkbox" role="switch">
                                    <label class="form-check-label">Link</label>
                                </div>
                                <div class="form-check form-switch form-check-reverse">
                                    <input class="form-check-input radio_sapaan" type="checkbox" role="switch">
                                    <label class="form-check-label">Sapaan</label>
                                </div>

                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pembuka." type="text" class="form-control selection selection_pembuka" data-class="pembuka" placeholder="Pembuka" name="pembuka" value="<?= template_wa()['pembuka']; ?>">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" name="text_wa" value="pembuka" type="checkbox">
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hari dan tanggal." type="text" class="form-control selection selection_tgl" data-class="tgl" placeholder="Hari dan tanggal" name="tgl" value="<?= template_wa()['tgl']; ?>">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" name="text_wa" value="tgl" type="checkbox">
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jam." type="text" class="form-control selection selection_jam" data-class="jam" placeholder="Jam" name="jam" value="<?= template_wa()['jam']; ?>">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" name="text_wa" value="jam" type="checkbox">
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tempat." type="text" class="form-control selection selection_tempat" data-class="tempat" placeholder="Tempat" name="tempat" value="<?= template_wa()['tempat']; ?>">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" name="text_wa" value="tempat" type="checkbox">
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Acara." type="text" class="form-control selection selection_acara" data-class="acara" placeholder="Acara" name="acara" value="<?= template_wa()['acara']; ?>">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" name="text_wa" value="acara" type="checkbox">
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Penutup." type="text" class="form-control selection selection_penutup" data-class="penutup" placeholder="Penutup" name="penutup" value="<?= template_wa()['penutup']; ?>">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" name="text_wa" value="penutup" type="checkbox">
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <textarea data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pengumuman." class="form-control selection selection_pengumuman" data-class="pengumuman" placeholder="Pengumuman" name="pengumuman"><?= template_wa()['pengumuman']; ?></textarea>
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" name="text_wa" value="pengumuman" type="checkbox">
                                </div>
                            </div>

                            <textarea data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Nb." class="form-control selection selection_nb mb-2" data-class="nb" placeholder="Nb" name="nb"><?= template_wa()['nb']; ?></textarea>


                            <div class="d-grid">
                                <button class="btn_main" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- modal copy -->
    <div class="modal fade" id="copy" tabindex="-1" aria-labelledby="copyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-content">
                    <h6 class="main_color mb-0" style="margin-left:20px;margin-top:20px;font-size:small;"><i class="fa-solid fa-copy"></i> Copy Data</h6>
                    <div class="modal-body body_copy">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?= $this->renderSection('content') ?>


    <nav class="fixed-bottom border-top">
        <div class="m-auto text-center p-3 bg-light">
            <a target="_blank" href="https://www.instagram.com/djanasragen/">
                <svg width="98" height="17" viewBox="0 0 98 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.02734 2.80078V1.48828L9.90234 0.550781V2.80078V3.73828V7.39453C9.90234 8.23828 9.69531 9.01172 9.28125 9.71484C8.86719 10.4102 8.3125 10.9648 7.61719 11.3789C6.92188 11.793 6.14844 12 5.29688 12C4.45312 12 3.68359 11.793 2.98828 11.3789C2.29297 10.9648 1.73828 10.4102 1.32422 9.71484C0.910156 9.01953 0.703125 8.25 0.703125 7.40625C0.703125 6.55469 0.910156 5.78125 1.32422 5.08594C1.73828 4.39062 2.29297 3.83594 2.98828 3.42188C3.69141 3.00781 4.46484 2.80078 5.30859 2.80078H8.02734ZM8.02734 7.39453V4.67578H5.30859C4.55859 4.67578 3.91406 4.94141 3.375 5.47266C2.84375 6.00391 2.57812 6.64844 2.57812 7.40625C2.57812 8.15625 2.84375 8.79688 3.375 9.32812C3.90625 9.85938 4.54688 10.125 5.29688 10.125C6.05469 10.125 6.69922 9.85938 7.23047 9.32812C7.76172 8.78906 8.02734 8.14453 8.02734 7.39453Z" fill="#80DEEA" />
                    <path d="M14.9766 5.08594V12.3281H14.9648H14.9766C14.9766 13.1719 14.7695 13.9414 14.3555 14.6367C13.9414 15.3398 13.3828 15.8984 12.6797 16.3125C11.9844 16.7266 11.2148 16.9336 10.3711 16.9336V15.0586C11.1211 15.0586 11.7617 14.7891 12.293 14.25C12.832 13.7188 13.1016 13.0781 13.1016 12.3281V5.08594H14.9766ZM14.9766 1.42969V3.30469H13.1016V2.36719L14.9766 1.42969Z" fill="#80DEEA" />
                    <path d="M20.9766 2.80078C21.8281 2.80078 22.6016 3.00781 23.2969 3.42188C23.9922 3.83594 24.5469 4.39062 24.9609 5.08594C25.375 5.78125 25.582 6.55469 25.582 7.40625V12H20.9883C20.1445 12 19.3711 11.793 18.668 11.3789C17.9727 10.9648 17.418 10.4102 17.0039 9.71484C16.5898 9.01172 16.3828 8.23828 16.3828 7.39453C16.3828 6.55078 16.5898 5.78125 17.0039 5.08594C17.418 4.39062 17.9727 3.83594 18.668 3.42188C19.3633 3.00781 20.1328 2.80078 20.9766 2.80078ZM23.707 10.125V7.40625C23.707 6.64844 23.4414 6.00391 22.9102 5.47266C22.3789 4.94141 21.7344 4.67578 20.9766 4.67578C20.2266 4.67578 19.5859 4.94141 19.0547 5.47266C18.5234 6.00391 18.2578 6.64453 18.2578 7.39453C18.2578 8.14453 18.5234 8.78906 19.0547 9.32812C19.5938 9.85938 20.2383 10.125 20.9883 10.125H23.707Z" fill="#80DEEA" />
                    <path d="M31.1133 2.8125C31.8633 2.8125 32.5469 3 33.1641 3.375C33.7891 3.74219 34.2852 4.23828 34.6523 4.86328C35.0273 5.48047 35.2148 6.16797 35.2148 6.92578V12H33.3398V6.92578C33.3398 6.30859 33.1211 5.78125 32.6836 5.34375C32.2461 4.90625 31.7227 4.6875 31.1133 4.6875C30.4961 4.6875 29.9688 4.90625 29.5312 5.34375C29.0938 5.78125 28.875 6.30859 28.875 6.92578V12H27V6.92578C27 6.16797 27.1836 5.48047 27.5508 4.86328C27.9258 4.23828 28.4219 3.74219 29.0391 3.375C29.6641 3 30.3555 2.8125 31.1133 2.8125Z" fill="#80DEEA" />
                    <path d="M41.2266 2.80078C42.0781 2.80078 42.8516 3.00781 43.5469 3.42188C44.2422 3.83594 44.7969 4.39062 45.2109 5.08594C45.625 5.78125 45.832 6.55469 45.832 7.40625V12H41.2383C40.3945 12 39.6211 11.793 38.918 11.3789C38.2227 10.9648 37.668 10.4102 37.2539 9.71484C36.8398 9.01172 36.6328 8.23828 36.6328 7.39453C36.6328 6.55078 36.8398 5.78125 37.2539 5.08594C37.668 4.39062 38.2227 3.83594 38.918 3.42188C39.6133 3.00781 40.3828 2.80078 41.2266 2.80078ZM43.957 10.125V7.40625C43.957 6.64844 43.6914 6.00391 43.1602 5.47266C42.6289 4.94141 41.9844 4.67578 41.2266 4.67578C40.4766 4.67578 39.8359 4.94141 39.3047 5.47266C38.7734 6.00391 38.5078 6.64453 38.5078 7.39453C38.5078 8.14453 38.7734 8.78906 39.3047 9.32812C39.8438 9.85938 40.4883 10.125 41.2383 10.125H43.957Z" fill="#80DEEA" />
                    <path d="M53.6133 6.45703C54.3789 6.45703 55.0312 6.73047 55.5703 7.27734C56.1172 7.81641 56.3906 8.46875 56.3906 9.23438C56.3906 9.99219 56.1172 10.6445 55.5703 11.1914C55.0312 11.7305 54.3789 12 53.6133 12H47.625V10.125H53.6133C53.8633 10.125 54.0742 10.0391 54.2461 9.86719C54.4258 9.6875 54.5156 9.47656 54.5156 9.23438C54.5156 8.98438 54.4258 8.77344 54.2461 8.60156C54.0742 8.42188 53.8633 8.33203 53.6133 8.33203H52.9336H52.5586H50.0156C49.2578 8.33203 48.6055 8.0625 48.0586 7.52344C47.5195 6.98438 47.25 6.33203 47.25 5.56641C47.25 4.80078 47.5195 4.14844 48.0586 3.60938C48.6055 3.07031 49.2578 2.80078 50.0156 2.80078H56.0156V4.67578H50.0156C49.7734 4.67578 49.5625 4.76172 49.3828 4.93359C49.2109 5.10547 49.125 5.31641 49.125 5.56641C49.125 5.81641 49.2109 6.02734 49.3828 6.19922C49.5625 6.37109 49.7734 6.45703 50.0156 6.45703H52.5586H52.9336H53.6133Z" fill="#00BCD4" />
                    <path d="M62.3906 2.78906C63.2422 2.78906 64.0156 3 64.7109 3.42188C65.4062 3.83594 65.9609 4.39062 66.375 5.08594C66.7891 5.78125 66.9961 6.55078 66.9961 7.39453V11.0625V12V14.2383L65.1211 13.3008V12H62.4023C61.5586 12 60.7852 11.793 60.082 11.3789C59.3867 10.957 58.832 10.3984 58.418 9.70312C58.0039 9.00781 57.7969 8.23828 57.7969 7.39453C57.7969 6.55078 58.0039 5.78125 58.418 5.08594C58.832 4.38281 59.3867 3.82422 60.082 3.41016C60.7773 2.99609 61.5469 2.78906 62.3906 2.78906ZM62.4023 10.125H65.1211V7.39453C65.1211 6.64453 64.8555 6.00391 64.3242 5.47266C63.793 4.93359 63.1484 4.66406 62.3906 4.66406C61.6406 4.66406 61 4.93359 60.4688 5.47266C59.9375 6.00391 59.6719 6.64453 59.6719 7.39453C59.6719 8.14453 59.9375 8.78906 60.4688 9.32812C61.0078 9.85938 61.6523 10.125 62.4023 10.125Z" fill="#00BCD4" />
                    <path d="M74.7539 7.93359V2.78906H76.6289V7.93359C76.6289 8.68359 76.4414 9.36719 76.0664 9.98438C75.6992 10.5938 75.2031 11.082 74.5781 11.4492C73.9609 11.8164 73.2773 12 72.5273 12C71.7695 12 71.0781 11.8164 70.4531 11.4492C69.8359 11.082 69.3398 10.5938 68.9648 9.98438C68.5977 9.36719 68.4141 8.68359 68.4141 7.93359V2.78906H70.2891V7.93359C70.2891 8.54297 70.5078 9.06641 70.9453 9.50391C71.3828 9.93359 71.9102 10.1484 72.5273 10.1484C73.1367 10.1484 73.6602 9.93359 74.0977 9.50391C74.5352 9.06641 74.7539 8.54297 74.7539 7.93359Z" fill="#00BCD4" />
                    <path d="M82.6406 2.80078C83.4922 2.80078 84.2656 3.00781 84.9609 3.42188C85.6562 3.83594 86.2109 4.39062 86.625 5.08594C87.0391 5.78125 87.2461 6.55469 87.2461 7.40625V12H82.6523C81.8086 12 81.0352 11.793 80.332 11.3789C79.6367 10.9648 79.082 10.4102 78.668 9.71484C78.2539 9.01172 78.0469 8.23828 78.0469 7.39453C78.0469 6.55078 78.2539 5.78125 78.668 5.08594C79.082 4.39062 79.6367 3.83594 80.332 3.42188C81.0273 3.00781 81.7969 2.80078 82.6406 2.80078ZM85.3711 10.125V7.40625C85.3711 6.64844 85.1055 6.00391 84.5742 5.47266C84.043 4.94141 83.3984 4.67578 82.6406 4.67578C81.8906 4.67578 81.25 4.94141 80.7188 5.47266C80.1875 6.00391 79.9219 6.64453 79.9219 7.39453C79.9219 8.14453 80.1875 8.78906 80.7188 9.32812C81.2578 9.85938 81.9023 10.125 82.6523 10.125H85.3711Z" fill="#00BCD4" />
                    <path d="M95.9883 2.80078V1.48828L97.8633 0.550781V2.80078V3.73828V7.39453C97.8633 8.23828 97.6562 9.01172 97.2422 9.71484C96.8281 10.4102 96.2734 10.9648 95.5781 11.3789C94.8828 11.793 94.1094 12 93.2578 12C92.4141 12 91.6445 11.793 90.9492 11.3789C90.2539 10.9648 89.6992 10.4102 89.2852 9.71484C88.8711 9.01953 88.6641 8.25 88.6641 7.40625C88.6641 6.55469 88.8711 5.78125 89.2852 5.08594C89.6992 4.39062 90.2539 3.83594 90.9492 3.42188C91.6523 3.00781 92.4258 2.80078 93.2695 2.80078H95.9883ZM95.9883 7.39453V4.67578H93.2695C92.5195 4.67578 91.875 4.94141 91.3359 5.47266C90.8047 6.00391 90.5391 6.64844 90.5391 7.40625C90.5391 8.15625 90.8047 8.79688 91.3359 9.32812C91.8672 9.85938 92.5078 10.125 93.2578 10.125C94.0156 10.125 94.6602 9.85938 95.1914 9.32812C95.7227 8.78906 95.9883 8.14453 95.9883 7.39453Z" fill="#00BCD4" />
                </svg>
            </a>
        </div>
        </div>
    </nav>

    <?php if (url() == 'rebana' || url() == 'rental') : ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <?php endif; ?>

    <?= view('js'); ?>


    <?= view('validation_js'); ?>
    <?= view('functions_js'); ?>
    <?= (url() == 'cetak' ? view('root/cetak_js') : (url() == 'rebana' ? view('rebana/rebana_js') : (url() == 'rental' ? view('rental/rental_js') : ''))); ?>
    <?= (get_db(menu()['tabel']) == 'djana' ? view('djana/djana_js') : ''); ?>
    <?= (get_db(menu()['tabel']) == 'lpk' ? view('lpk/lpk_js') : ''); ?>
    <?= (get_db(menu()['tabel']) == 'alumni' ? view('alumni/alumni_js') : ''); ?>

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
        let ck_input_identitas2;
        ClassicEditor
            .create(document.querySelector('.ck_input'))
            .then(newEditor => {
                ck_input_identitas2 = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
        let ck_artikel;
        ClassicEditor
            .create(document.querySelector('#ck_artikel'))
            .then(newEditor => {
                ck_artikel = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>


</body>

</html>