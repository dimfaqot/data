<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container-fluid" style="margin-top: 60px;">
    <div class="row">
        <!-- left akun medsos -->
        <div class="col-sm-12 col-md-3 d-none d-md-block">
            <div class="bg_secondary">
                <h6 class="judul">Akun Media Sosial</h6>
            </div>

            <div class="list-group p-2">
                <?php foreach (sosmed() as $i) : ?>
                    <?= $i; ?>
                <?php endforeach; ?>
            </div>


        </div>

        <!-- mid/profile & settings -->
        <div class="col-sm-12 col-md-7">
            <!-- profile -->
            <div class="bg_secondary">
                <h6 class="judul">Profile</h6>
            </div>

            <div class="list-group p-2">
                <h5 class="card-title"><?= session('nama'); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">[Section: <?= session('section'); ?>] [Role: <?= session('role'); ?>]</h6>
                <p class="card-text"><small class="text-muted">Username: <?= (session('username') == '' ? '-' : session('username')); ?> | No. Id: <?= (session('no_id') == 0 ? '-' : session('no_id')); ?></small></p>
            </div>

            <?php if (session('role') == 'Root') : ?>

                <div class="mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn_secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Make Temp Auth
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <select class="form-select section" required>
                                        <?php foreach (options('Section') as $b) : ?>
                                            <option value="<?= $b['value']; ?>"><?= $b['value']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <div class="d-grid mt-3">
                                        <button data-tabel="karyawan" data-id="000000000" data-section="Recruitment" data-role="Temp" data-nama="Temporary User" data-gender="L" data-no="00000" class="btn_main_inactive auth_url">Get Token</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <div class="mt-3">
                <h6 class="judul mb-2" style="margin-bottom:-15px;">Informasi</h6>
                <p>
                    <?php if (!get_informasi()) : ?>
                        -
                    <?php else : ?>
                        <?= get_informasi()['informasi']; ?>
                    <?php endif; ?>
                </p>
            </div>

            <!-- settings -->
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h6 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed judul" style="font-weight:500;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Ganti Password
                                    </button>
                                </h6>
                                <div id="flush-collapseOne" class="accordion-collapse collapse p-0" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <form action="<?= base_url(); ?>ganti_password" method="post">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="password_saat_ini" placeholder="Password Saat Ini" required autofocus>
                                                <label>Password Saat Ini</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="password_baru" placeholder="Password Baru" required>
                                                <label>Password Baru</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="ulangi_password_baru" placeholder="Ulangi Password Baru" required>
                                                <label>Ulangi Password Baru</label>
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
            </div>
        </div>

        <!-- right/banner -->
        <div class="col-sm-12 col-md-2 d-none d-md-block">
            <div class="row">
                <div><img width="200" src="<?= base_url(); ?>berkas/ppdb/right_side.jpg" alt="BANNER"></div>
            </div>
        </div>
    </div>

    <!-- sm sosmed-->
    <div class="row" id="sosmed">
        <div class="d-sm-none d-sm-block">
            <div style="margin-bottom:20px;">
                <h6 class="judul">Akun Media Sosial</h6>
                <div class="list-group p-2">
                    <?php foreach (sosmed() as $i) : ?>
                        <?= $i; ?>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- sm banner-->
    <div class="row">
        <div class="d-sm-none d-sm-block">
            <div class="row">
                <img src="<?= base_url(); ?>berkas/ppdb/right_side.jpg" alt="BANNER">

            </div>
        </div>
    </div>

</div>

<script>
    let section = document.querySelector('.section');
    section.addEventListener('change', function(e) {
        e.preventDefault();
        let val = section.value;
        let auth_url = document.querySelector('.auth_url');
        auth_url.setAttribute('data-section', val);
    })
</script>

<?= $this->endSection() ?>