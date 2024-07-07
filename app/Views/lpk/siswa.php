<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">
    <!-- Button trigger modal -->
    <button type="button" class="btn-sm btn_main mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-circle-plus"></i> Tambah <?= menu()['menu']; ?>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">

                    <form action="<?= base_url(menu()['controller'] . '/add'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" name="username" class="form-control mb-2" placeholder="Username (Optional)">
                                <input type="text" name="nama" class="form-control mb-3" placeholder="Nama lengkap tanpa singkatan" required>
                                <input type="text" name="nik" class="form-control mb-3" placeholder="Nik" required>
                                <input type="text" name="hp" class="form-control mb-3" placeholder="No. Wa active" required>
                                <input type="text" name="kota_lahir" data-tabel="kabupaten" data-target="add_kota_lahir" class="form-control mb-3 add_kota_lahir btn_daerah" placeholder="Kota Lahir" required>
                                <div class="form-control mb-3">
                                    <label style="font-size: small;" class="form-label">Tanggal Lahir</label>
                                    <input type="date" style="height: 30px;" data-date="" class="input_date form-control" name="tgl_lahir" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d'); ?>">
                                </div>
                                <input type="text" name="alamat" class="form-control mb-3" placeholder="Alamat di bawah desa">
                                <input name="provinsi" data-tabel="provinsi" type="text" data-target="add_provinsi" class="form-control btn_daerah add_provinsi mb-3" value="" placeholder="Provinsi" readonly>
                                <input name="kabupaten" data-tabel="kabupaten" type="text" data-target="add_kabupaten" class="form-control btn_daerah add_kabupaten mb-3" value="" placeholder="Kabupaten" readonly>
                                <input name="kecamatan" data-tabel="kecamatan" type="text" data-target="add_kecamatan" class="form-control btn_daerah add_kecamatan mb-3" value="" placeholder="Kecamatan" readonly>
                                <input name="kelurahan" data-tabel="kelurahan" type="text" data-target="add_kelurahan" class="form-control btn_daerah add_kelurahan mb-3" value="" placeholder="kelurahan" readonly>

                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <img width="80" src="<?= base_url('berkas/file_not_found.jpg'); ?>" alt="Akta" class="mb-1">
                                    <label class="form-label">Akta Lahir</label>
                                    <input class="form-control form-control-sm" name="akta" type="file">
                                </div>
                                <div class="mb-3">
                                    <img width="80" src="<?= base_url('berkas/file_not_found.jpg'); ?>" alt="Ktp" class="mb-1">
                                    <label class="form-label">Ktp</label>
                                    <input class="form-control form-control-sm" name="ktp" type="file">
                                </div>
                                <div class="mb-3">
                                    <img width="80" src="<?= base_url('berkas/file_not_found.jpg'); ?>" alt="Kk" class="mb-1">
                                    <label class="form-label">Kk</label>
                                    <input class="form-control form-control-sm" name="kk" type="file">
                                </div>
                                <div class="mb-3">
                                    <img width="80" src="<?= base_url('berkas/file_not_found.jpg'); ?>" alt="Ijazah" class="mb-1">
                                    <label class="form-label">Ijazah</label>
                                    <input class="form-control form-control-sm" name="ijazah" type="file">
                                </div>
                            </div>
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
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>No. Wa</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $k => $i) : ?>
                    <tr>
                        <td><?= $k + 1; ?></td>
                        <td><?= $i['nama']; ?></td>
                        <td><?= $i['hp']; ?></td>
                        <td style="font-size: medium;">
                            <a data-bs-toggle="modal" data-bs-target="#update_<?= $i['id']; ?>" href=""><i class="fa-solid fa-square-pen"></i></a>
                            <a data-id="<?= $i['id']; ?>" data-alert="Yakin hapus data ini?" data-tabel="<?= menu()['tabel']; ?>" data-url="<?= menu()['controller']; ?>/delete" class="btn_confirm text-danger" href=""><i class="fa-regular fa-circle-xmark"></i></a>
                        </td>
                    </tr>

                    <!-- modal -->
                    <div class="modal fade" id="update_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <form action="<?= base_url(menu()['controller'] . '/update'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <input type="text" value="<?= $i['id']; ?>" name="id" class="form-control mb-2  bg-light" placeholder="No. Id" readonly>
                                                <input type="text" value="<?= $i['username']; ?>" name="username" class="form-control mb-2" placeholder="Username (Optional)">
                                                <input type="text" value="<?= $i['nama']; ?>" name="nama" class="form-control mb-3" placeholder="Nama lengkap tanpa singkatan" required>
                                                <input type="text" value="<?= $i['nik']; ?>" name="nik" class="form-control mb-3" placeholder="Nik" required>
                                                <input type="text" value="<?= $i['hp']; ?>" name="hp" class="form-control mb-3" placeholder="No. Wa active" required>
                                                <input type="text" value="<?= $i['kota_lahir']; ?>" name="kota_lahir" data-tabel="kabupaten" data-target="update_kota_lahir_<?= $i['id']; ?>" class="form-control mb-3 update_kota_lahir_<?= $i['id']; ?> btn_daerah" placeholder="Kota Lahir" required>
                                                <div class="form-control mb-3">
                                                    <label style="font-size: small;" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" style="height: 30px;" data-date="" class="input_date form-control" name="tgl_lahir" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d', $i['tgl_lahir']); ?>">
                                                </div>
                                                <input value="<?= $i['alamat']; ?>" type="text" name="alamat" class="form-control mb-3" placeholder="Alamat di bawah desa">
                                                <input value="<?= $i['provinsi']; ?>" name="provinsi" data-id="<?= $i['id']; ?>" data-tabel="provinsi" type="text" data-target="update_provinsi_<?= $i['id']; ?>" class="form-control btn_daerah update_provinsi_<?= $i['id']; ?> mb-3" placeholder="Provinsi" readonly>
                                                <input value="<?= $i['kabupaten']; ?>" name="kabupaten" data-id="<?= $i['id']; ?>" data-tabel="kabupaten" type="text" data-target="update_kabupaten_<?= $i['id']; ?>" class="form-control btn_daerah update_kabupaten_<?= $i['id']; ?> mb-3" placeholder="Kabupaten" readonly>
                                                <input value="<?= $i['kecamatan']; ?>" name="kecamatan" data-id="<?= $i['id']; ?>" data-tabel="kecamatan" type="text" data-target="update_kecamatan_<?= $i['id']; ?>" class="form-control btn_daerah update_kecamatan_<?= $i['id']; ?> mb-3" placeholder="Kecamatan" readonly>
                                                <input value="<?= $i['kelurahan']; ?>" name="kelurahan" data-id="<?= $i['id']; ?>" data-tabel="kelurahan" type="text" data-target="update_kelurahan_<?= $i['id']; ?>" class="form-control btn_daerah update_kelurahan_<?= $i['id']; ?> mb-3" placeholder="kelurahan" readonly>

                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <img width="80" src="<?= base_url('berkas/' . get_db(menu()['tabel']) . '/' . $i['akta']); ?>" alt="Akta" class="mb-1 zoom_image">
                                                    <label class="form-label">Akta Lahir</label>
                                                    <input class="form-control form-control-sm" name="akta" type="file">
                                                </div>
                                                <div class="mb-3">
                                                    <img width="80" src="<?= base_url('berkas/' . get_db(menu()['tabel']) . '/' . $i['ktp']); ?>" alt="Ktp" class="mb-1 zoom_image">
                                                    <label class="form-label">Ktp</label>
                                                    <input class="form-control form-control-sm" name="ktp" type="file">
                                                </div>
                                                <div class="mb-3">
                                                    <img width="80" src="<?= base_url('berkas/' . get_db(menu()['tabel']) . '/' . $i['kk']); ?>" alt="Kk" class="mb-1 zoom_image">
                                                    <label class="form-label">Kk</label>
                                                    <input class="form-control form-control-sm" name="kk" type="file">
                                                </div>
                                                <div class="mb-3">
                                                    <img width="80" src="<?= base_url('berkas/' . get_db(menu()['tabel']) . '/' . $i['ijazah']); ?>" alt="Ijazah" class="mb-1 zoom_image">
                                                    <label class="form-label">Ijazah</label>
                                                    <input class="form-control form-control-sm" name="ijazah" type="file">
                                                </div>
                                            </div>
                                        </div>
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


<!-- modal daerah -->
<div class="modal fade" id="modal_daerah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body body_modal_daerah">

            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>