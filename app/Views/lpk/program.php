<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">
    <!-- Button trigger modal -->
    <button type="button" class="btn-sm btn_main mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-circle-plus"></i> Tambah Program
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">

                    <form action="<?= base_url('program/add'); ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_program" placeholder="Nama Program" required>
                            <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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


            <div class="d-flex justify-content-between gap-2 btn_main_inactive mb-1">
                <div style="cursor: pointer;" class="d-flex flex-fill gap-2" data-bs-toggle="modal" data-bs-target="#update_<?= $i['id']; ?>">
                    <div><?= $k + 1; ?>.</div>
                    <div><?= $i['nama_program']; ?></div>
                </div>
                <div><a class="text-danger btn_confirm" data-id="<?= $i['id']; ?>" data-alert="Yakin hapus data ini?" data-tabel="<?= menu()['tabel']; ?>" data-url="<?= menu()['controller']; ?>/delete" href=""><i class="fa-solid fa-circle-xmark"></i></a></div>
            </div>



            <!-- modal update-->
            <div class="modal fade" id="update_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">

                            <form action="<?= base_url('program/update'); ?>" method="post">
                                <div class="input-group">
                                    <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                    <input type="text" class="form-control" value="<?= $i['nama_program']; ?>" name="nama_program" placeholder="Nama Program" required>
                                    <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-square-pen"></i> update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>


</div>



<?= $this->endSection() ?>