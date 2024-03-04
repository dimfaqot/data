<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">
    <?php $kondisi = ['Baik', 'Dipinjam', 'Disewa', 'Service', 'Habis', 'Rusak', 'Hilang']; ?>
    <!-- Button trigger modal -->
    <div class="input-group input-group-sm mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn-sm btn_main" data-bs-toggle="modal" data-bs-target="#<?= menu()['controller']; ?>">
            <i class="fa-solid fa-circle-plus"></i> Tambah Data
        </button>

        <a class="nav-link dropdown-toggle btn_secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tahun [<?= url(4); ?>]
        </a>
        <ul class="dropdown-menu">
            <?php foreach ($tahuns as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= (url(4) == $i ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= $i; ?>/<?= url(5); ?>"><?= $i; ?></a></li>
            <?php endforeach; ?>
            <li style="font-size: small;"><a class="dropdown-item <?= (url(4) == 'All' ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/All/<?= url(5); ?>">All</a></li>
        </ul>
        <a class="nav-link dropdown-toggle btn_secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Bulan [<?= bulan(url(5))['bulan']; ?>]
        </a>
        <ul class="dropdown-menu">
            <?php foreach (bulan() as $i) : ?>
                <li style="font-size: small;"><a class="dropdown-item <?= (url(5) == $i['angka'] ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= $i['angka']; ?>"><?= $i['bulan']; ?></a></li>
            <?php endforeach; ?>
            <li style="font-size: small;"><a class="dropdown-item <?= (url(5) == 'All' ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/All">All</a></li>
        </ul>

    </div>



    <?php if (count($data) == 0) : ?>
        <div class="mt-2 text-danger"><i class="fa-solid fa-circle-exclamation"></i> Data tidak ditemukan!.</div>
    <?php else : ?>
        <div class="input-group input-group-sm">
            <span style="width: 100px;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cari daftar data di bawah." class="input-group-text">Cari <?= menu()['menu']; ?></span>
            <input data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cari daftar data di bawah." type="text" class="form-control cari" placeholder="...">
        </div>
        <div class="check_all_pesanan d-none mt-2">
            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Check All" href="" class="btn_bright_sm btn_check_all_pesanan" style="font-style:italic;"><i class="fa-solid fa-list-check"></i> Check All</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="text-align: center;" scope="col">#</th>
                    <th style="width: 90px;text-align:center">Tgl</th>
                    <th style="text-align: center;">Acara</th>
                    <th style="text-align: center;">Lokasi</th>
                    <th style="text-align: center;">Pj</th>
                    <th style="text-align: center;">Kamera</th>
                    <th style="text-align: center;">Act</th>
                </tr>
            </thead>
            <tbody class="tabel_search">
                <?php foreach ($data as $k => $i) : ?>
                    <tr>
                        <th scope="row" style="width: 35px;"><?= ($k + 1); ?></th>
                        <td><?= date('d/m/Y', $i['tgl']); ?></td>
                        <td><?= $i['acara']; ?></td>
                        <td style="text-align: right;"><?= $i['lokasi']; ?></td>
                        <td style="text-align: right;"><?= $i['pj']; ?></td>
                        <td style="text-align: right;"><?= $i['kamera']; ?></td>
                        <td style="text-align: center;"><a href="" data-method="delete" class="confirm" data-id="<?= $i['id']; ?>" data-controller="<?= menu()['controller']; ?>" style="font-size: medium;"><i class="fa-solid fa-square-xmark danger_color"></i></a> <a href="" type="button" data-bs-toggle="modal" style="font-size: medium;" data-bs-target="#detail_kamera_<?= $i['id']; ?>" class="main_color detail_kamera_<?= $i['id']; ?>"><i class="fa-solid fa-square-pen"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- modal update -->
    <?php foreach ($data as $i) : ?>

        <div class="modal fade" id="detail_kamera_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-body p-4">
                            <h6 class="mb-2"><?= $i['acara']; ?></h6>
                            <form class="row g-3" method="post" action="<?= base_url('kamera/update'); ?>">
                                <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span style="width: 120px;" class="input-group-text">Tgl</span>
                                        <?php if ($i['tgl'] == 0) : ?>
                                            <input type="text" class="form-control input_tgl input_tgl_<?= $i['id']; ?>" data-id="<?= $i['id']; ?>" data-val="<?= $i['tgl']; ?>" name="tgl" value="-">
                                        <?php else : ?>
                                            <input type="date" data-date="" class="form-control test input_date" style="padding-bottom: 25px;" name="tgl" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d', $i['tgl']); ?>">
                                        <?php endif; ?>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span style="width: 120px;" class="input-group-text">Acara</span>
                                        <input type="text" name="acara" class="form-control" value="<?= $i['acara']; ?>" placeholder="Acara" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span style="width: 120px;" class="input-group-text">Lokasi</span>
                                        <input type="text" name="lokasi" class="form-control" value="<?= $i['lokasi']; ?>" placeholder="Lokasi" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span style="width: 120px;" class="input-group-text">Kamera</span>
                                        <input type="text" name="kamera" class="form-control" value="<?= $i['kamera']; ?>" placeholder="Kamera" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <label style="width: 120px;" class="input-group-text">Pj</label>
                                        <select class="form-select" name="pj" required>
                                            <option value="">-</option>
                                            <?php foreach (get_users_djana() as $u) : ?>
                                                <option <?= ($u == $i['pj'] ? 'selected' : ''); ?> value="<?= $u; ?>"><?= upper_first($u); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn-sm btn_main"><i class="fa-regular fa-pen-to-square"></i> Update</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>


<!-- Modal add-->
<div class="modal fade" id="<?= menu()['controller']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div class="main_color" style="font-weight: bold;"><i class="<?= menu()['icon']; ?>"></i> Tambah Data <?= menu()['menu']; ?></div>
                    <div><a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark main_color"></i></a></div>
                </div>
                <hr class="dark_color" style="border: 1px solid;">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url(); ?><?= menu()['controller']; ?>/add" method="post">
                            <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <label style="width: 120px;" class="input-group-text">Tgl. Order</label>
                                        <input type="date" data-date="" class="form-control test input_date" style="padding-bottom: 25px;" name="tgl" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span style="width: 120px;" class="input-group-text">Acara</span>
                                        <input type="text" name="acara" class="form-control" value="" placeholder="Acara" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span style="width: 120px;" class="input-group-text">Lokasi</span>
                                        <input type="text" name="lokasi" class="form-control" value="" placeholder="Lokasi" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span style="width: 120px;" class="input-group-text">Kamera</span>
                                        <input type="text" name="kamera" class="form-control" value="" placeholder="Kamera" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <label style="width: 120px;" class="input-group-text">Pj</label>
                                        <select class="form-select" name="pj" required>
                                            <option value="">-</option>
                                            <?php foreach (get_users_djana() as $u) : ?>
                                                <option <?= ($u == session('username') ? 'selected' : ''); ?> value="<?= $u; ?>"><?= upper_first($u); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="d-grid mt-3">
                                <button type="submit" class="btn-sm btn_main"><i class="fa-regular fa-floppy-disk"></i> Save</button>

                            </div>
                        </form>



                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>