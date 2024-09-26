<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">

    <button type="button" class="btn-sm btn_main" data-bs-toggle="modal" data-bs-target="#<?= menu()['controller']; ?>">
        <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tambah data baru." class="fa-solid fa-circle-plus"></i> Tambah Data Ppdb <?= menu()['menu']; ?>
    </button>
    <button type="button" class="btn-sm btn_secondary" data-bs-toggle="modal" data-bs-target="#template_whatsapp">
        <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Template whatsapp." class="fa-brands fa-whatsapp"></i>
    </button>

    <!-- Modal add-->
    <div class="modal fade" id="<?= menu()['controller']; ?>" tabindex="-1" aria-labelledby="cariLabel" aria-hidden="true" style="z-index:9999">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div class="main_color" style="font-weight: bold;"><i class="<?= menu()['icon']; ?>"></i> Tambah Data Ppdb <?= menu()['menu']; ?></div>
                        <div><a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark main_color"></i></a></div>
                    </div>
                    <hr class="dark_color" style="border: 1px solid;">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url(menu()['controller']); ?>/add" method="post">
                                <div class="mb-2 box_card">
                                    <div class="form-label">Jenis Pendaftaran</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="jenis_pendaftaran" type="radio" value="Siswa Baru" checked>
                                        <label class="form-check-label">Siswa Baru</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="jenis_pendaftaran" type="radio" value="Pindahan">
                                        <label class="form-check-label">Pindahan</label>
                                    </div>
                                </div>
                                <div class="mb-2 box_card">
                                    <div class="form-label">Asal Tk</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="asal_tk" type="radio" value="Tk Walisongo" checked>
                                        <label class="form-check-label">Tk Walisongo</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="asal_tk" type="radio" value="Tk Luar">
                                        <label class="form-check-label">Tk Luar</label>
                                    </div>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="number" class="form-control check_tahun_masuk" name="tahun_masuk" value="<?= tahun_santri('ppdb'); ?>" placeholder="Tahun Masuk">
                                    <label>Tahun Masuk</label>
                                    <div class="body_feedback_tahun_masuk invalid-feedback"></div>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control check_nama" placeholder="Nama" name="nama" required>
                                    <label>Nama</label>
                                    <div class="body_feedback_nama invalid-feedback"></div>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" name="no_hp" placeholder="No. W.A Aktif" required>
                                    <label>No. W.A Aktif</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <select style="font-size: small;" class="form-select check_gender" name="gender" required>
                                        <option value="">Click to gender</option>
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                    <label>Pilih Gender</label>
                                </div>

                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn-sm new_active btn_main"><i class="fa-regular fa-floppy-disk"></i> Save</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="mt-2 body_cetak"></div>

    <?php if (count($data) == 0): ?>
        <p class="text-danger mt-2"><i class="fa-solid fa-triangle-exclamation"></i> Data not found!.</p>

    <?php else: ?>
        <table class="table table-striped table-bordered mt-2">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Check</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Hp</th>
                    <th style="text-align: center;">L/P</th>
                    <th style="text-align: center;">Act</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $k => $i): ?>
                    <tr>
                        <td style="text-align: center;"><?= ($k + 1); ?></td>
                        <td style="text-align: center;">
                            <input class="form-check-input select_check" name="check" type="checkbox" value="<?= $i['no_id']; ?>">
                        </td>
                        <td><?= $i['nama']; ?></td>
                        <td><a class="kirim_whatsapp" data-id="<?= $i['no_id']; ?>" data-no_id="<?= $i['no_id']; ?>" data-gender="<?= $i['gender']; ?>" data-nama="<?= $i['nama']; ?>" href="" data-no_hp="+62<?= substr($i['no_hp'], 1); ?>"><i class="fa-brands fa-whatsapp"></i></a> <?= $i['no_hp']; ?></td>
                        <td style="text-align: center;"><?= $i['gender']; ?></td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-danger px-1 py-0 btn_confirm_sdi" data-no_id="<?= $i['no_id']; ?>" style="font-size: 12px;"><i class="fa-solid fa-square-xmark"></i></button>
                            <a href="<?= base_url('sdi-admin/detail-ppdb-sdi/identitas/' . $i['no_id']); ?>" class="btn btn-sm btn-primary px-1 py-0" style="font-size: 12px;"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Modal add-->
    <div class="modal fade" id="modal_confirm_sdi" tabindex="-1" aria-labelledby="cariLabel" aria-hidden="true" style="z-index:9999">
        <div class="modal-dialog modal-dialog-centered modal-lg d-flex justify-content-center">
            <div class="modal-content body_modal_confirm_sdi" style="background-color: transparent;border:none">

            </div>
        </div>
    </div>
    <!-- Modal template whatsapp-->
    <div class="modal fade" id="template_whatsapp" tabindex="-1" aria-labelledby="cariLabel" aria-hidden="true" style="z-index:9999">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="judul text-center mb-2">
                        <span style="font-style: italic;">I (_..._)</span>
                        <span style="font-weight: bold;">B (*...*)</span>
                        <span>Enter (...%0a)</span>
                    </div>
                    <form action="<?= base_url('sdi-admin/update_template_wa'); ?>" method="post">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <input class="form-check-input" type="radio" value="1" checked name="template_wwatsapp"> Template 1
                                <div class="mb-3">
                                    <textarea style="font-size: small;" name="template_1" class="form-control template_wa_1" rows="3"><?= $template_wa['template_1']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input class="form-check-input" type="radio" value="2" name="template_wwatsapp"> Template 2
                                <div class="mb-3">
                                    <textarea style="font-size: small;" name="template_2" class="form-control template_wa_2" rows="3"><?= $template_wa['template_2']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input class="form-check-input" type="radio" value="3" name="template_wwatsapp"> Template 3
                                <div class="mb-3">
                                    <textarea style="font-size: small;" name="template_3" class="form-control template_wa_3" rows="3"><?= $template_wa['template_3']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn_main"><i class="fa-solid fa-floppy-disk"></i> Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('change', '.select_check', function(e) {
        e.preventDefault();

        let elem = document.getElementsByName("check");

        let values = [];
        elem.forEach(e => {
            if (e.checked) {
                values.push(e.value);
            }
        })
        if (values.length === 0) {
            $('.body_cetak').html('');
        } else {
            let html = '<div class="d-flex gap-2">';
            html += '<a href="" data-order="pdf" data-no_id="' + values.join(',') + '" class="btn_main_inactive btn_cetak" style="font-size: medium;"><i class="fa-solid fa-file-pdf"></i></a>';
            html += '<a href="" data-order="excel" data-no_id="' + values.join(',') + '" class="btn_main_inactive btn_cetak" style="font-size: medium;"><i class="fa-solid fa-file-excel"></i></a>';
            html += '</div>';
            $('.body_cetak').html(html);
        }
    })

    $(document).on('click', '.btn_cetak', function(e) {
        e.preventDefault();
        let order = $(this).data('order');
        let data = $(this).data('no_id').toString().split(",");


        post("encode", {
            data
        }).then((res) => {
            if (res.status == '200') {
                window.open('<?= base_url(); ?>/sdi-admin/cetak/' + order + '/' + res.data, '_blank');

            } else {
                gagal(res.message);
            }
        })

    })

    $(document).on('click', '.btn_confirm_sdi', function(e) {
        e.preventDefault();
        let no_id = $(this).data('no_id');

        let html = '';
        html += '<div class="d-flex justify-content-center">';
        html += '<div class="d-flex justify-content-between gap-3 py-2 px-3" style="border: 1px solid #ECE5C7; background-color:#f1f8f9;padding:5px;border-radius:5px;">';
        html += '<div style="font-size: medium;"><i style="color: tomato;" class="fa-solid fa-triangle-exclamation"></i> Yakin hapus data ini?</div>';
        html += '<div class="d-flex gap-2">';
        html += '<a href="" data-bs-dismiss="modal" aria-label="Close" style="font-size: 9px;" class="py-1 px-3 btn_main_inactive"><i style="font-size:medium" class="fa-solid fa-rectangle-xmark"></i></a>';
        html += '<a href="" data-no_id="' + no_id + '" style="font-size: 9px;" class="py-1 px-3 btn_main btn_delete_sdi"><i style="font-size:medium" class="fa-solid fa-square-check"></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('.body_modal_confirm_sdi').html(html);

        let myModal = document.getElementById('modal_confirm_sdi');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();

    })
    $(document).on('click', '.btn_delete_sdi', function(e) {
        e.preventDefault();
        let no_id = $(this).data('no_id');

        post('sdi-admin/delete', {
            no_id
        }).then(res => {

            if (res.status == "200") {
                sukses_js(res.message);
                let myModal = document.getElementById('modal_confirm_sdi');
                let modal = bootstrap.Modal.getOrCreateInstance(myModal)
                modal.hide();
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                gagal_with_button(res.message);
            }

        })



    })

    $(document).on('click', '.kirim_whatsapp', function(e) {
        e.preventDefault();
        let template = $("input[type='radio'][name='template_wwatsapp']:checked").val();
        let no_hp = $(this).data('no_hp');
        let id = $(this).data('id');
        let no_id = $(this).data('no_id');
        let gender = $(this).data('gender');
        let nama = $(this).data('nama');
        let username = '';
        let section = 'Sdi';
        let role = 'Member';

        let text = 'Assalamualaikum wr.wb%0a';
        text += 'Yth: ' + nama + '%0a%0a';
        text += $('.template_wa_' + template).val();

        let data = {
            no_id,
            id,
            gender,
            username,
            nama,
            section,
            role
        }

        post("encode", {
            data
        }).then((res) => {
            if (res.status == '200') {
                let url = "<?= base_url(); ?>public/a/" + res.data;
                if (template == 1) {
                    text += url;

                }

                text += '%0a%0a%0aTTD%0a%0a';
                text += 'PANITIA';
                window.open('whatsapp://send/?phone=' + no_hp + '&text=' + text, '_blank');

            } else {
                gagal(res.message);
            }
        })



    })
</script>
<?= $this->endSection() ?>