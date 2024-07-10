<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">
    <!-- Button trigger modal -->
    <button type="button" class="btn-sm btn_main mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-circle-plus"></i> Tambah Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <?php if (session('role') == 'Root') : ?>
                        <label>Nama Angkatan</label>
                        <select class="form-select add_val mb-2">
                            <?php foreach (options('Marhalah') as $k => $i) : ?>
                                <option <?= $k == 0 ? 'selected' : ''; ?> value="<?= $i['value']; ?>"><?= $i['value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                    <input data-val="<?= session('info'); ?>" data-role="<?= session('role'); ?>" type="text" data-col="angkatan" class="form-control cari_nama_santri add_cari_nama_santri" data-target="add_cari_nama_santri" placeholder="Cari nama" required>
                    <div style="position:absolute;" class="body_add_cari_nama_santri"></div>

                    <div class="d-grid mt-3">
                        <button data-order="angkatan" class="btn_main btn_add_data"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php if (count($data) == 0) : ?>
        <div class="alert alert-danger" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.
        </div>
    <?php else : ?>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">Cari</span>
            <input type="text" class="form-control cari" placeholder="Ketik...">
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                </tr>
            </thead>
            <tbody class="tabel_search">
                <?php foreach ($data as $k => $i) : ?>
                    <tr>
                        <td style="width: 60px;">
                            <div class="py-2"><?= $k + 1; ?></div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <div data-santri_id="<?= $i['santri_id']; ?>" data-id="<?= $i['id']; ?>" class="p-2 w-100 btn_detail_identitas" style="cursor:pointer">
                                    <div class="nama_<?= $i['id']; ?>" <?= (session('role') == 'Root' && $i['angkatan'] == '' && $i['region'] == '' ? 'style="color:#ab0818"' : (session('role') == 'Root' && $i['angkatan'] == '' ? 'style="color:#0841ab"' : (session('role') == 'Root' && $i['region'] == '' ? 'style="color:#08abab"' : ''))); ?>><?= $i['nama_alumni']; ?></div>
                                </div>
                                <div class="p-2 flex-shrink-1"><a href="" class="confirm_del" data-col="angkatan" data-id="<?= $i['id']; ?>"><i style="font-size: medium;color:red" class="fa-solid fa-circle-xmark"></i></a></div>
                            </div>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- modal detail identitas -->
<div class="modal fade" id="modal_detail_identitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h6 class="judul_modal_detail_identitas"></h6>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" data-judul="Identitas" aria-current="page" href="">Identitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-judul="Contact" href="">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-judul="Domisili" href="">Domisili</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-judul="Kuliah" href="">Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-judul="Kerja" href="">Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-judul="Riwayat" href="">Riwayat</a>
                    </li>
                </ul>

                <div class="div_body_daerah" style="position: absolute; left: 50%;top:30%;display:none">
                    <div style="position: relative; left: -50%;">
                        <div class="d-flex justify-content-end">
                            <a href="" class="btn_close_div_daerah"><i class="fa-solid fa-circle-xmark" style="color: brown;font-size:medium"></i></a>
                        </div>
                        <div class="shadow body_daerah" style="border:2px solid #d4ebf1;border-radius:8px;padding:5px;background-color:#f3f2f2;">

                        </div>
                    </div>
                </div>
                <div class="content_detail_identitas mt-3"></div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>