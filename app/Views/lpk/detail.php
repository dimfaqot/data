<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">
    <a class="btn_main_inactive" href="<?= base_url(menu()['controller']); ?>"><i class="fa-solid fa-circle-chevron-left"></i> Back</a>
    <?php $tahun = date('Y', $siswa['tgl_pemberangkatan']); ?>
    <div class="row my-3">
        <div class="col-md-4">
            <div class="card" style="height: 230px;">
                <div class="card-body">
                    <h6 class="btn_main_inactive">IDENTITAS</h6>
                    <h5 class="card-title"><?= $siswa['nama']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= ttl($siswa); ?></h6>
                    <h6><i class="fa-brands fa-whatsapp"></i> <?= $siswa['hp']; ?></h6>
                    <p class="card-text"><?= alamat_lengkap($siswa); ?></p>
                    <h6 class="btn_main_inactive">Berangkat: <?= date('d/m/Y', $siswa['tgl_pemberangkatan']); ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height: 230px;">
                <div class="card-body">

                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <?php $th = $tahun + $i; ?>
                        <?php $total = 0; ?>
                        <?php $bulans = []; ?>
                        <?php foreach ($data as $t) : ?>
                            <?php if ($th == date('Y', $t['tgl_tf'])) : ?>
                                <?php $total += $t['jml_tf']; ?>
                                <?php $bulans[] = date('m', $t['tgl_tf']); ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <h6 class="btn_main_inactive d-flex justify-content-around">
                            <div><?= $th; ?></div>
                            <div class="d-flex gap-1">
                                <?php foreach ($bulans as $bl) : ?>
                                    <div class="bg-success" style="padding:2px;font-size:xx-small;border: 1px solid white;border-radius:3px;color:white;"><?= $bl; ?></div>
                                <?php endforeach; ?>
                            </div>
                            <div><?= rupiah($total); ?></div>
                        </h6>

                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height: 230px;">
                <div class="card-body">
                    <h6 class="btn_main_inactive">TOTAL</h6>
                    <?php $totals = 0; ?>
                    <?php foreach ($data as $i) : ?>
                        <?php $totals += $i['jml_tf']; ?>
                    <?php endforeach; ?>
                    <h1><?= rupiah($totals); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <?php for ($i = 0; $i < 5; $i++) : ?>
        <?php $th = $tahun + $i; ?>
        <?php $total_per_tahun = 0; ?>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#setoran_<?= $th; ?>" aria-expanded="false" aria-controls="setoran_<?= $tahun; ?>">
                        <?= $th; ?>
                    </button>
                </h2>
                <div id="setoran_<?= $th; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <?php foreach (bulan() as $b) : ?>
                        <?php $hasil = null; ?>
                        <?php foreach ($data as $s) : ?>
                            <?php if ($th == date('Y', $s['tgl_tf']) && $b['angka'] == date('m', $s['tgl_tf'])) : ?>
                                <?php $hasil = $s; ?>
                                <?php $total_per_tahun += $s['jml_tf']; ?>
                            <?php endif; ?>

                        <?php endforeach; ?>
                        <div class="btn_main_inactive mb-1 d-flex justify-content-between" style="border-radius: 3px;">
                            <div class="d-flex gap-2">

                                <div style="width: 70px;"><?= $b['bulan']; ?></div>
                                <div>
                                    <input data-bulan="<?= $b['angka']; ?>" data-tahun="<?= $th; ?>" data-pemberangkatan_id="<?= $siswa['id']; ?>" data-tabel="setoran" type="date" style="height:30px;" data-date="" class="input_date date_setoran <?= ($hasil == null ? '' : 'tgl_tf' . $hasil['id']); ?> form-control form-control-sm" data-id="<?= ($hasil == null ? '' : $hasil['id']); ?>" name="tgl_pembayaran" data-date-format="DD/MM/YYYY" value="<?= ($hasil == null ? $th . '-' . $b['angka'] . '-01' : date('Y-m-d', $hasil['tgl_tf'])); ?>">
                                </div>
                                <div>
                                    <input data-bulan="<?= $b['angka']; ?>" data-tahun="<?= $th; ?>" data-pemberangkatan_id="<?= $siswa['id']; ?>" type="text" value="<?= ($hasil == null ? rupiah($siswa['setoran']) : rupiah($hasil['jml_tf'])); ?>" class="form-control form-control-sm uang jml_tf <?= ($hasil == null ? '' : 'jml_tf_' . $hasil['id']); ?>" data-id="<?= ($hasil == null ? '' : $hasil['id']); ?>" name="jml_tf" placeholder="Jumlah setoran" required>
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <input data-bulan="<?= $b['angka']; ?>" data-tahun="<?= $th; ?>" data-pemberangkatan_id="<?= $siswa['id']; ?>" class="form-check-input btn_setoran" data-id="<?= ($hasil == null ? '' : $hasil['id']); ?>" <?= ($hasil == null ? '' : 'checked'); ?> type="checkbox" role="switch">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="btn_main_inactive total_<?= $th; ?>"><?= rupiah($total_per_tahun); ?></div>
                </div>
            </div>
        </div>
    <?php endfor; ?>
</div>



<?= $this->endSection() ?>