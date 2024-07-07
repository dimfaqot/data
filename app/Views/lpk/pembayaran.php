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
                            <label style="font-size: small;" class="form-label">Status Pembayaran</label>
                            <div class="form-check form-switch">
                                <input name="jenis_siswa" class="form-check-input" type="checkbox" role="switch">
                                <label class="form-check-label">Siswa Baru/Lanjutan</label>
                            </div>
                        </div>
                        <input type="text" name="siswa_id" data-tabel="siswa" data-col="nama" data-target="add_nama" class="form-control input_search_db add_nama" placeholder="Nama lengkap tanpa singkatan" required>
                        <div style="position:absolute;" class="body_add_nama"></div>';

                        <div class="mb-3">
                            <textarea class="form-control" name="catatan_siswa" placeholder="Catatan siswa/pembayaran" rows="3"></textarea>
                        </div>
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
        <?php foreach ($data as $k => $i) : ?>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acc_nota_<?= $i['id']; ?>" aria-expanded="false" aria-controls="acc_nota_<?= $i['id']; ?>">
                            <?= $i['nama']; ?>
                        </button>
                    </h2>
                    <div id="acc_nota_<?= $i['id']; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="mb-3 bg_bright" style="border:none;">
                                <div class="form-control mb-1">
                                    <label style="font-size: small;" class="form-label">Status Pembayaran</label>
                                    <div class="form-check form-switch">
                                        <input <?= ($i['jenis_siswa'] == 'Lanjutan' ? 'checked' : ''); ?> name="jenis_siswa" class="form-check-input jenis_siswa_<?= $i['id']; ?>" type="checkbox" role="switch">
                                        <label class="form-check-label">Siswa Baru/Lanjutan</label>
                                    </div>
                                </div>
                                <label>Catatan siswa/pembayaran</label>
                                <textarea class="form-control catatan_siswa_<?= $i['id']; ?>" name="catatan_siswa" placeholder="Catatan" rows="3"><?= $i['catatan_siswa']; ?></textarea>
                                <div class="d-flex justify-content-end gap-1 mt-1">
                                    <a data-id="<?= $i['id']; ?>" data-tabel="nota_lpk" data-url="<?= menu()['controller']; ?>/update_nota_lpk" class="btn_update_nota_lpk btn_bright_sm pt-1" href="" style="border-radius: 3px;"><i class="fa-solid fa-floppy-disk" style="font-size:medium;"></i></a>
                                    <a data-id="<?= $i['id']; ?>" data-alert="Yakin hapus data ini?" data-tabel="nota_lpk" data-url="<?= menu()['controller']; ?>/delete_nota_lpk" class="btn_confirm btn btn_danger pt-1" style="border-radius: 3px;" href=""><i class="fa-regular fa-circle-xmark" style="font-size: medium;"></i></a>
                                </div>
                            </div>
                            <div class="bg_light p-2">
                                <div class="row g-2">
                                    <div class="col-md-2">
                                        <label style="font-size: small;" class="form-label">Tanggal Pembayaran</label>
                                        <input type="date" style="height:30px;" data-date="" class="input_date form-control form-control-sm p_tgl_pembayaran" name="tgl_pembayaran" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label style="font-size: small;" class="form-label">Nama Pembayaran</label>
                                        <input type="text" name="nama_pembayaran" data-target_jml_pembayaran="add_jml_pembayaran" data-tabel="biaya" data-col="nama_biaya" data-target="add_nama_pembayaran" class="form-control form-control-sm input_search_db add_nama_pembayaran p_nama_pembayaran" placeholder="Nama pembayaran" required>
                                        <div style="position:absolute;" class="body_add_nama_pembayaran"></div>';
                                    </div>
                                    <div class="col-md-2">
                                        <label style="font-size: small;" class="form-label">Jml. Pembayaran</label>
                                        <input type="text" name="jml_pembayaran" class="form-control form-control-sm uang add_jml_pembayaran p_jml_pembayaran" placeholder="Jml. pembayaran" readonly required>
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-size: small;" class="form-label">Keterangan</label>
                                        <div class="row g-1">
                                            <div class="col-11">
                                                <textarea class="form-control p_catatan_pembayaran" name="catatan_pembayaran" placeholder="Catatan" rows="2"></textarea>
                                            </div>
                                            <div class="col-1">

                                                <button type="button" class="btn btn_main btn_pembayaran" data-id="<?= $i['id']; ?>" style="border-radius: 3px;font-size:15px"><i class="fa-regular fa-square-check"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">tgl</th>
                                        <th scope="col">Pembayaran</th>
                                        <th scope="col">Jml.</th>
                                        <th scope="col">Ket.</th>
                                        <th scope="col">Act</th>
                                    </tr>
                                </thead>
                                <tbody class="body_pembayaran_<?= $i['id']; ?>">
                                    <?php $total = 0; ?>
                                    <?php foreach ($pembayaran as $n) : ?>
                                        <?php if ($n['nota_id'] == $i['id']) : ?>
                                            <?php $total += $n['jml_pembayaran']; ?>
                                            <tr>
                                                <td><input type="date" style="height:30px;" data-date="" class="input_date form-control form-control-sm tgl_pembayaran_<?= $i['id']; ?>_<?= $n['id']; ?>" name="tgl_pembayaran" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d', $n['tgl_pembayaran']); ?>"></td>
                                                <td>
                                                    <input value="<?= $n['nama_pembayaran']; ?>" type="text" name="nama_pembayaran" data-tabel="biaya" data-col="nama_biaya" data-target_jml_pembayaran="update_jml_pembayaran_<?= $i['id']; ?>_<?= $n['id']; ?>" data-target="update_nama_pembayaran_<?= $i['id']; ?>_<?= $n['id']; ?>" class="form-control form-control-sm input_search_db update_nama_pembayaran_<?= $i['id']; ?>_<?= $n['id']; ?>" placeholder="Nama pembayaran" required>
                                                    <div style="position:absolute;" class="body_update_nama_pembayaran_<?= $i['id']; ?>_<?= $n['id']; ?>"></div>';
                                                </td>
                                                <td><input type="text" name="jml_pembayaran" value="<?= rupiah($n['jml_pembayaran']); ?>" class="form-control form-control-sm uang update_jml_pembayaran_<?= $i['id']; ?>_<?= $n['id']; ?>" placeholder="Jml. pembayaran" required></td>
                                                <td>
                                                    <textarea class="form-control update_catatan_pembayaran_<?= $i['id']; ?>_<?= $n['id']; ?>" name="catatan_pembayaran" placeholder="Catatan" rows="2"><?= $n['catatan_pembayaran']; ?></textarea>
                                                </td>

                                                <td>
                                                    <a href type="button" class="btn_update_pembayaran" data-id_nota="<?= $i['id']; ?>" data-id="<?= $n['id']; ?>"><i style="font-size: medium;" class="fa-solid fa-circle-check"></i></a>
                                                    <a data-id="<?= $n['id']; ?>" data-nota_id="<?= $i['id']; ?>" data-alert="Yakin hapus data ini?" data-tabel="<?= menu()['tabel']; ?>" data-url="<?= menu()['controller']; ?>/delete" class="btn_confirm text-danger" href=""><i style="font-size: medium;" class="fa-regular fa-circle-xmark"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div style="text-align: right;" class="bg_light p-2 fw-bold total_pembayaran">TOTAL <?= rupiah($total); ?></div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>




<?= $this->endSection() ?>