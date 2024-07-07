<?= $this->extend('guest') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top:55px;margin-bottom:100px;margin-bottom:100px;">

    <div class="row g-4">
        <div class="col-md-6">
            <img width="70" src="<?= base_url(); ?>berkas/menu/lpk.png" alt="Logo">
            <p style="font-size: medium;">Unit usaha <a class="btn_secondary_inactive" href="<?= base_url(); ?>public/news/label/Pondok">Pondok Pesantren Walisongo Sragen.</a> dalam bidang penyaluran tenaga kerja ke Jepang.</p>
            <div class="mt-3">
                <div>
                    <h1 class="btn_main" style="border-radius: 3px;border-color:#054552">LAPORAN KEUANGAN <?= (url(6) == 'All' ? 'SEMUA BULAN' : 'BULAN ' . (url(6) == '' ? strtoupper(bulan(date('m'))['bulan']) : strtoupper(bulan(url(6))['bulan']))); ?> <?= (url(5) == 'All' ? 'SEMUA TAHUN' : 'TAHUN ' . strtoupper((url(5) == '' ? date('Y') : url(5)))); ?></h1>



                </div>

            </div>





        </div>
        <div class="col-md-6">
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <?php foreach (get_files('lpk') as $k => $i) : ?>
                        <?php if ($i !== 'berkas/lpk/file_not_found.jpg' && $i !== 'berkas/lpk/logo.png') : ?>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="<?= $k; ?>" <?= ($k == 0 ? 'class="active"' : ''); ?>></button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <?php foreach (get_files('lpk') as $k => $i) : ?>
                        <?php if ($i !== 'berkas/lpk/file_not_found.jpg' && $i !== 'berkas/lpk/logo.png') : ?>
                            <div class="carousel-item <?= ($k == 0 ? 'active' : ''); ?>">
                                <img src="<?= base_url(); ?>/<?= $i; ?>" alt="Los Angeles" class="d-block" style="width:100%">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>



            <h1 class="btn_main" style="border-radius: 3px;border-color:#054552">SOSMED</h1>
            <?php foreach (sosmed('data') as $i) : ?>
                <div class="d-grid mb-1">
                    <a class="btn_main_inactive" <?= (url() == '' ? 'target="_blank"' : ''); ?> style="border-color: #666666;border-radius:3px;" href="<?= $i['url']; ?>"><i class="<?= $i['icon']; ?>"></i> <?= $i['text']; ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <div class="row mt-2">
        <!-- mid/profile & settings -->
        <div class="col-sm-12 col-md-10">
            <!-- profile -->

            <h1 class="btn_main mt-3" style="border-radius: 3px;border-color:#054552">BERITA LPK</h1>
            <?php foreach (get_news('Lpk') as $k => $i) : ?>
                <?php if ($k < 5) : ?>
                    <a href="<?= base_url(); ?>public/news/single/<?= $i['slug']; ?>" class="card mb-2" style="max-width: 100%;text-decoration:none;color:#666666">
                        <div class="row g-0">
                            <div class="col-md-4 p-2">
                                <img src="<?= base_url(); ?>berkas/news/<?= $i['img']; ?>" class="img-fluid rounded-start" alt="<?= $i['judul']; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-title"><?= $i['judul']; ?></h6>
                                    <p class="card-text"><?= get_words($i['artikel']); ?></p>
                                    <p class="card-text"><small class="text-muted"><i class="fa-regular fa-clock"></i></span> <?= date('d/m/Y H:i:s', $i['tgl']); ?></small></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- right/banner -->
        <div class="col-sm-12 col-md-2 d-none d-md-block">
            <div class="row">
                <a href="<?= base_url(); ?>public/ppdb"><img width="200px" src="<?= base_url(); ?>berkas/ppdb/right_side.jpg" alt="BANNER"></a>
            </div>
        </div>
    </div>

    <!-- sm sosmed-->
    <div class="row">
        <div class="d-md-none d-sm-block">
            <div style="margin-bottom:20px;">
                <div class="col-sm-12 d-md-none d-sm-block">
                    <h1 class="btn_main" style="border-radius: 3px;border-color:#054552">SOSMED</h1>
                    <?php foreach (sosmed('data') as $i) : ?>
                        <div class="d-grid mb-1">
                            <a class="btn_main_inactive" <?= (url() == '' ? 'target="_blank"' : ''); ?> style="border-color: #666666;border-radius:3px;" href="<?= $i['url']; ?>"><i class="<?= $i['icon']; ?>"></i> <?= $i['text']; ?></a>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>
    </div>

    <!-- sm banner-->
    <div class="row">
        <div class="d-md-none d-sm-block">
            <div class="row">
                <a href="<?= base_url(); ?>public/ppdb"><img class="img-fluid" src="<?= base_url(); ?>berkas/ppdb/right_side.jpg" alt="BANNER"></a>

            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>