<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">
    <!-- Button trigger modal -->
    <button type="button" class="btn-sm btn_main mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-circle-plus"></i> Tambah <?= menu()['menu']; ?>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <form action="<?= base_url(menu()['controller'] . '/add'); ?>" method="post">
                        <div class="form-control mb-3">
                            <label style="font-size: small;" class="form-label">Status Keberangkatan</label>
                            <div class="form-check form-switch">
                                <input name="status_keberangkatan" class="form-check-input" type="checkbox" role="switch">
                                <label class="form-check-label">Berangkat Pertama/Lanjutan</label>
                            </div>
                        </div>
                        <div class="form-control mb-3">
                            <label style="font-size: small;" class="form-label">Tanggal Pemberangkatan</label>
                            <input type="date" style="height:30px;" data-date="" class="input_date form-control" name="tgl_pemberangkatan" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d'); ?>">
                        </div>
                        <input type="text" name="siswa_id" data-tabel="siswa" data-col="nama" data-target="add_nama" class="form-control input_search_db add_nama" placeholder="Nama lengkap tanpa singkatan" required>
                        <div style="position:absolute;" class="body_add_nama"></div>';

                        <input type="text" name="program" data-tabel="program" data-col="nama_program" data-target="add_program" class="form-control input_search_db add_program" placeholder="Nama program" required>
                        <div style="position:absolute;" class="body_add_program"></div>';

                        <div class="mb-3">
                            <textarea class="form-control" name="alamat_penempatan" placeholder="Alamat di Jepang" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="catatan_pemberangkatan" placeholder="Catatan" rows="3"></textarea>
                        </div>
                        <input type="text" name="setoran" class="form-control uang mb-3" placeholder="Jumlah setoran" required>
                        <div class="d-grid">
                            <button type="submit" class="btn btn_main"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php if (count($data) == 0) : ?>
        <div class="alert alert-danger" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.
        </div>
    <?php else : ?>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tgl</th>
                    <th>Nama</th>
                    <th>Program</th>
                    <th>Setoran</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $k => $i) : ?>
                    <tr>
                        <td><?= $k + 1; ?></td>
                        <td><?= date('d/m/Y', $i['tgl_pemberangkatan']); ?></td>
                        <td><?= $i['nama']; ?></td>
                        <td><?= $i['program']; ?></td>
                        <td><?= rupiah($i['setoran']); ?></td>
                        <td style="font-size: medium;">
                            <?= ($i['status_keberangkatan'] == 'Lanjutan' ? '<i class="fa-solid fa-angles-up"></i>' : '<i class="fa-solid fa-chevron-up"></i>'); ?>
                            <a data-bs-toggle="modal" data-bs-target="#update_<?= $i['id']; ?>" href=""><i class="fa-solid fa-square-pen"></i></a>
                            <a data-id="<?= $i['id']; ?>" data-alert="Yakin hapus data ini?" data-tabel="<?= menu()['tabel']; ?>" data-url="<?= menu()['controller']; ?>/delete" class="btn_confirm text-danger" href=""><i class="fa-regular fa-circle-xmark"></i></a>
                        </td>
                    </tr>

                    <!-- modal -->
                    <div class="modal fade" id="update_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <form action="<?= base_url(menu()['controller'] . '/update'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                        <div class="form-control mb-3">
                                            <label style="font-size: small;" class="form-label">Status Keberangkatan</label>
                                            <div class="form-check form-switch">
                                                <input <?= ($i['status_keberangkatan'] == 'Lanjutan' ? 'checked' : ''); ?> name="status_keberangkatan" class="form-check-input" type="checkbox" role="switch">
                                                <label class="form-check-label">Berangkat Pertama/Lanjutan</label>
                                            </div>
                                        </div>
                                        <div class="form-control mb-3">
                                            <label style="font-size: small;" class="form-label">Tanggal Pemberangkatan</label>
                                            <input type="date" style="height:30px;" data-date="" class="input_date form-control" name="tgl_pemberangkatan" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d', $i['tgl_pemberangkatan']); ?>">
                                        </div>
                                        <input type="text" name="siswa_id" data-tabel="siswa" data-col="nama" data-target="update_nama_<?= $i['id']; ?>" class="form-control input_search_db update_nama_<?= $i['id']; ?>" data-id="<?= $i['siswa_id']; ?>" value="<?= $i['nama']; ?>" placeholder="Nama lengkap tanpa singkatan" required>

                                        <div style="position:absolute;" class="body_update_nama_<?= $i['id']; ?>"></div>';

                                        <input type="text" name="program" data-tabel="program" data-col="nama_program" data-target="add_program_<?= $i['id']; ?>" class="form-control input_search_db add_program_<?= $i['id']; ?>" value="<?= $i['program']; ?>" placeholder="Nama program" required>
                                        <div style="position:absolute;" class="body_add_program_<?= $i['id']; ?>"></div>';

                                        <div class="mb-3">
                                            <textarea class="form-control" name="alamat_penempatan" placeholder="Alamat di Jepang" rows="3" required><?= $i['alamat_penempatan']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="catatan_pemberangkatan" placeholder="Catatan" rows="3"><?= $i['catatan_pemberangkatan']; ?></textarea>
                                        </div>
                                        <input type="text" name="setoran" value="<?= rupiah($i['setoran']); ?>" class="form-control uang mb-3" placeholder="Jumlah setoran" required>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn_main"><i class="fa-solid fa-square-pen"></i> update</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php foreach ($data as $k => $i) : ?>

        <?php endforeach; ?>
    <?php endif; ?>
</div>


<?= $this->endSection() ?>