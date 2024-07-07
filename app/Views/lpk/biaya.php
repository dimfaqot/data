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
                        <input type="text" name="nama_biaya" class="form-control mb-2" placeholder="Nama Biaya" required>
                        <input type="text" name="jml_biaya" class="form-control mb-3 uang" placeholder="Jumlah Biaya" required>
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
                    <th>Nama Biaya</th>
                    <th>Jumlah Biaya</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $k => $i) : ?>
                    <tr>
                        <td><?= $k + 1; ?></td>
                        <td><?= $i['nama_biaya']; ?></td>
                        <td><?= rupiah($i['jml_biaya']); ?></td>
                        <td style="font-size: medium;">
                            <a data-bs-toggle="modal" data-bs-target="#update_<?= $i['id']; ?>" href=""><i class="fa-solid fa-square-pen"></i></a>
                            <a data-id="<?= $i['id']; ?>" data-alert="Yakin hapus data ini?" data-tabel="<?= menu()['tabel']; ?>" data-url="<?= menu()['controller']; ?>/delete" class="btn_confirm text-danger" href=""><i class="fa-regular fa-circle-xmark"></i></a>
                        </td>
                    </tr>

                    <!-- modal -->
                    <div class="modal fade" id="update_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body">

                                    <form action="<?= base_url(menu()['controller'] . '/update'); ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                        <input type="text" name="nama_biaya" value="<?= $i['nama_biaya']; ?>" class="form-control mb-2" placeholder="Nama Biaya" required>
                                        <input type="text" name="jml_biaya" value="<?= rupiah($i['jml_biaya']); ?>" class="form-control mb-3 uang" placeholder="Jumlah Biaya" required>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn_main"><i class="fa-solid fa-square-pen"></i> Update</button>
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