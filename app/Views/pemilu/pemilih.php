<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<?php
$asc_icon = '<i class="fa-solid fa-arrow-down-short-wide secondary_dark_color"></i>';
$desc_icon = '<i class="fa-solid fa-arrow-down-wide-short"></i>';
$filter_by = ['Existing', 'Deleted', 'All'];
$gender = ['L', 'P', 'All'];

?>

<div class="container" style="margin-top: 60px;">

    <div class="input-group input-group-sm mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn-sm btn_main modal_cari_db"><i class="fa-solid fa-user-plus"></i> <?= menu()['menu']; ?></button>
        <a class="nav-link dropdown-toggle btn_secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tahun [<?= url(4); ?>]
        </a>
        <ul class="dropdown-menu">
            <?php foreach ($tahuns as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= (url(4) == $i['tahun'] ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= $i['tahun']; ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= $i['tahun']; ?></a></li>
            <?php endforeach; ?>
            <li style="font-size: small;"><a class="dropdown-item <?= (url(4) == 'All' ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/All/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>">All</a></li>
        </ul>
        <a class="nav-link dropdown-toggle btn_secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori [<?= url(7); ?>]
        </a>
        <ul class="dropdown-menu">
            <?php foreach ($kategori as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= (url(7) == $i['kategori'] ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= $i['kategori']; ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= $i['kategori']; ?></a></li>
            <?php endforeach; ?>
            <li style="font-size: small;"><a class="dropdown-item <?= (url(7) == 'All' ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/All/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>">All</a></li>
        </ul>
        <a class="nav-link dropdown-toggle btn_secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Voting [<?= url(5); ?>]
        </a>
        <ul class="dropdown-menu">
            <?php foreach ($voted as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= (url(5) == $i ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= $i; ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
            <li style="font-size: small;"><a class="dropdown-item <?= (url(5) == 'All' ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/All/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>">All</a></li>
        </ul>

    </div>

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
                                    <input type="text" class="form-control cari_db add_nama" data-order="add" name="nama" placeholder="Tabel">
                                    <label>Nama</label>
                                    <ul class="p-1 dropdown-menu add_body_search_nama" style="font-size:small;">

                                    </ul>
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




    <?php if (count($data['data']) == 0) : ?>
        <div class="d-flex justify-content-between mb-2">
            <div class="d-flex gap-1">
                <div class="btn_main_inactive">
                    <?php foreach ($pondok as $i) : ?>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasar pondok (<?= $i; ?>)." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= $i; ?>/<?= url(9); ?>/<?= url(10); ?>"><span class="badge <?= (url(8) == $i ? 'text-bg-success' : 'text-bg-light'); ?>"><?= $i; ?></span></a>
                    <?php endforeach; ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasar pondok (All)." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/All/<?= url(9); ?>/<?= url(10); ?>"><span class="badge <?= (url(8) == 'All' ? 'text-bg-success' : 'text-bg-light'); ?>">All</span></a>
                </div>
            </div>
        </div>
        <div class="mt-2 text-danger"><i class="fa-solid fa-circle-exclamation"></i> Data tidak ditemukan!.</div>
    <?php else : ?>
        <div class="input-group input-group-sm">
            <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cari daftar data di bawah." class="input-group-text">Cari <?= menu()['menu']; ?></span>
            <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cari daftar data di bawah." type="text" class="form-control cari" placeholder="...">
            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tampilkan semua data berdasar filter." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= (url(6) == 'All' ? 1 : 'All'); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" type="button" class="btn-sm <?= (url(6) == 'All' ? 'btn_main' : 'btn_main_inactive'); ?>"><i class="fa-solid fa-eye"></i> Show All</a>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <small data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Total data dari total data." class="dark_color"><?= $data['data_ditampilkan']; ?> from <?= $data['total_data']; ?></small>
            <div class="btn_main_inactive">
                <?php foreach ($pondok as $i) : ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasar pondok (<?= $i; ?>)." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= $i; ?>/<?= url(9); ?>/<?= url(10); ?>"><span class="badge <?= (url(8) == $i ? 'text-bg-success' : 'text-bg-light'); ?>"><?= $i; ?></span></a>
                <?php endforeach; ?>
                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter berdasar pondok (All)." href="<?= base_url(url()); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/All/<?= url(9); ?>/<?= url(10); ?>"><span class="badge <?= (url(8) == 'All' ? 'text-bg-success' : 'text-bg-light'); ?>">All</span></a>
            </div>
        </div>
        <div class="body_button"></div>
        <table class="table table-striped table-hover">
            <thead>
                <th scope="col">#</th>
                <th>Check</th>
                <th>No. Id <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar no. id" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/no_id/<?= (url(10) == 'ASC' ? 'DESC' : 'ASC'); ?>"><?= (url(9) == 'no_id' && url(10) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Nama <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar nama" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/nama/<?= (url(10) == 'ASC' ? 'DESC' : 'ASC'); ?>"><?= (url(9) == 'nama' && url(10) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Kategori <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar kategori" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/kategori/<?= (url(10) == 'ASC' ? 'DESC' : 'ASC'); ?>"><?= (url(9) == 'kategori' && url(10) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Pondok <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Urutkan berdasar pondok" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/pondok/<?= (url(10) == 'ASC' ? 'DESC' : 'ASC'); ?>"><?= (url(9) == 'pondok' && url(10) == 'DESC' ? $desc_icon : $asc_icon); ?></a></th>
                <th>Act</th>
            </thead>
            <tbody class="tabel_search">
                <?php foreach ($data['data'] as $k => $i) : ?>
                    <tr>
                        <th scope="row"><?= ($k + 1); ?></th>
                        <td>
                            <input class="form-check-input checkbox_pemilih" name="checkbox_pemilih" type="checkbox" value="<?= $i['no_id']; ?>">
                        </td>
                        <td><?= $i['no_id']; ?></td>
                        <td><?= $i['nama']; ?></td>
                        <td><?= $i['kategori']; ?></td>
                        <td><?= $i['pondok']; ?></td>
                        <td <?= ($i['voted'] == 0 ? 'class="d-flex gap-2"' : ''); ?>>
                            <?= ($i['voted'] == 0 ? '<a href="" class="confirm" data-id="' . $i['no_id'] . '" data-order="hapus" data-method="delete" style="font-size: medium;"><i class="fa-solid fa-square-xmark danger_color"></i></a> <form method="post" action="' . base_url() . menu()['controller'] . '/absen' . '"><input type="hidden" name="no_id" value="' . $i['no_id'] . '"><input type="hidden" name="url" value="' . base_url(url()) . '/' . url(4) . '/'  . url(5) . '/' . url(6) . '/' . url(7) . '/' . url(8) . '/' . url(9) . '/' . url(10) . '"><button class="' . ($i['absen'] == 0 ? 'btn_main_inactive' : 'btn_main') . '" type="submit">' . ($i['absen'] == 0 ? '<i class="fa-solid fa-square-person-confined"></i> Absen' : '<i class="fa-solid fa-spinner"></i> Aktif') . '</button></form>' : '<i class="text-success fa-regular fa-circle-check"></i>'); ?>
                            <?= ($i['voted'] == 0 ? '<a data-no_id="' . $i['no_id'] . '" href="" class="btn_main_inactive link_login"><i class="fa-solid fa-link"></i> Login</a>' : ''); ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-grid text-center">
            <?php if (url(6) == 'All') : ?>
                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kurangi data yang ditampilkan" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/1/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class="btn_main_inactive" style="font-style:italic;">Load less <i class="fa-solid fa-angles-up"></i></a>

            <?php else : ?>
                <?php if ($data['data_ditampilkan'] < $data['total_data']) : ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Perbanyak data yang ditampilkan" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6) + 1; ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class=" btn_main" style="font-style:italic;">Load more <i class="fa-solid fa-angles-down"></i></a>
                <?php else : ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kurangi data yang ditampilkan" href="<?= base_url() . url(3); ?>/<?= url(4); ?>/<?= url(5); ?>/1/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>" class="btn_main_inactive" style="font-style:italic;">Load less <i class="fa-solid fa-angles-up"></i></a>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- modal link_login -->
<div class="modal fade" id="link_login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:transparent;border:none">
            <div class="modal-body body_link_login">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('change', '.checkbox_pemilih', function(e) {
        e.preventDefault();
        let checkbox_pemilih = document.getElementsByName('checkbox_pemilih');

        let data = [];
        checkbox_pemilih.forEach(v => {
            if (v.checked && v.value) {
                data.push(v.value);
            }
        })

        if (data.length == 0) {
            $('.body_button').html('');
        } else {
            let html = '<button class="btn_main btn_copy_to_next_year">Copy to <?= (int)url(4) + 1; ?></button>';
            $('.body_button').html(html);
        }
    })

    $(document).on('click', '.btn_copy_to_next_year', function(e) {
        e.preventDefault();
        let checkbox_pemilih = document.getElementsByName('checkbox_pemilih');

        let datas = [];
        checkbox_pemilih.forEach(v => {
            if (v.checked && v.value) {
                datas.push(v.value);
            }
        })
        let data = Object.assign({}, datas);

        post('pemilih/copy_to_next_year', {
            data
        }).then(res => {
            if (res.status == "200") {
                sukses_js();
                setTimeout(() => {
                    location.reload();
                }, 1000);

            } else {
                gagal(res.message);
            }
        })
    })

    $(document).on('click', '.link_login', function(e) {
        e.preventDefault();
        let no_id = $(this).data('no_id');
        let html = '';
        html += '<div class="d-flex justify-content-center gap-2">';
        html += '<a data-order="link" data-no_id="' + no_id + '" href="" class="btn_main_inactive get_link_login"><i class="fa-solid fa-link"></i></a>';
        html += '<a data-order="wa" data-no_id="' + no_id + '" href="" class="btn_main_inactive get_link_login"><i class="fa-brands fa-whatsapp"></i></a>';
        html += '</div>';

        $('.body_link_login').html(html);
        let myModal = document.getElementById('link_login');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();
    })

    $(document).on('click', '.get_link_login', function(e) {
        e.preventDefault();

        let no_id = $(this).data('no_id');
        let order = $(this).data('order');

        post('pemilih/get_jwt_login', {
            no_id
        }).then(res => {
            if (res.status == "200") {
                if (order == 'link') {
                    let text = 'Assalamualaikum wr.wb%0a';
                    text += 'Yth: ' + res.data3 + '%0a%0a';
                    text += 'Silahkan kunjungi link di bawah ini untuk mengikuti Pemilu Iswa <?= date('Y'); ?>:%0a%0a';
                    text += res.data;

                    text += '*_JANGAN BAGIKAN LINK TERSEBUT KEPADA SIAPAPUN!_*%0a';
                    text += '%0a%0a%0aTTD%0a%0a';
                    text += 'PANITIA';
                    navigator.clipboard.writeText(res.data);

                    sukses_js(res.message);

                    setTimeout(() => {
                        window.location.href = 'whatsapp://send/?phone=' + res.data2 + '&text='; //Will take you to Google.
                    }, 1000);
                } else {

                    let text = 'Assalamualaikum wr.wb%0a';
                    text += 'Yth: ' + res.data3 + '%0a%0a';
                    text += 'Silahkan kunjungi link di bawah ini untuk mengikuti Pemilu Iswa <?= date('Y'); ?>:%0a%0a';
                    text += res.data;

                    text += '%0a%0a*_JANGAN BAGIKAN LINK TERSEBUT KEPADA SIAPAPUN!_*%0a';
                    text += '%0a%0a%0aTTD%0a%0a';
                    text += 'PANITIA';

                    window.location.href = 'whatsapp://send/?phone=' + res.data2 + '&text=' + text; //Will take you to Google.
                }
            } else {
                gagal(res.message);
            }
        })
    })
</script>
<?= $this->endSection() ?>