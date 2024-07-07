<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">

    <?php if (count($data) == 0) : ?>
        <div class="alert alert-danger" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.
        </div>
    <?php else : ?>
        <?php foreach ($data as $k => $i) : ?>
            <a href="<?= base_url('setoran'); ?>/detail_setoran/<?= $i['id']; ?>" class="btn_main_inactive mb-1 d-flex gap-2">

                <div><?= $k + 1; ?>.</div>
                <div><?= date('d/m/Y', $i['tgl_pemberangkatan']); ?></div>
                <div><?= $i['nama']; ?></div>

            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>



<?= $this->endSection() ?>