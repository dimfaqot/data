<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<?php $penghasilan = ['Kurang dari Rp. 1.000.000', 'Rp. 1.000.000 - Rp. 2.000.000', 'Rp. 2.000.000 - Rp. 3.000.000', 'Lebih dari Rp. 3.000.000']; ?>
<div class="container" style="margin-top: 60px;">

    <?php $menus = ['Identitas', 'Profile', 'Ayah', 'Ibu']; ?>
    <ul class="nav nav-tabs my-3">
        <?php foreach ($menus as $i): ?>
            <li class="nav-item">
                <a class="nav-link <?= (strtolower($i) == $segmen ? 'active' : ''); ?>" aria-current="page" href="<?= base_url('member-sdi/' . strtolower($i)); ?>"><?= $i; ?></a>
            </li>
        <?php endforeach; ?>

    </ul>
    <form action="<?= base_url('member-sdi'); ?>/update" method="post">
        <input type="hidden" value="<?= $data['no_id']; ?>" name="no_id">
        <input type="hidden" value="<?= $segmen; ?>" name="segmen">
        <input type="hidden" value="<?= implode(",", $cols); ?>" name="cols">
        <?php foreach ($cols as $k => $i): ?>
            <div class="mb-2 <?= ($k % 2 == 0 ? 'box_card' : 'box_card_light'); ?>">
                <div class="form-label"><?= upper_first(str_replace("_", " ", $i)); ?><?= ($i == 'tinggi_badan' ? '/Cm' : ($i == 'berat_badan' ? '/Kg' : ($i == 'jarak_tempuh' ? '/Km' : ''))); ?></div>
                <?php if ($i == 'gender'): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="<?= $i; ?>" type="radio" value="L" <?= ($data[$i] == 'L' ? 'checked' : ''); ?>>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="<?= $i; ?>" type="radio" value="P" <?= ($data[$i] == 'P' ? 'checked' : ''); ?>>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                <?php elseif ($i == 'jenis_pendaftaran'): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="<?= $i; ?>" type="radio" value="Siswa Baru" <?= ($data[$i] == 'Siswa Baru' ? 'checked' : ''); ?>>
                        <label class="form-check-label">Siswa Baru</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="<?= $i; ?>" type="radio" value="Pindahan" <?= ($data[$i] == 'Pindahan' ? 'checked' : ''); ?>>
                        <label class="form-check-label">Pindahan</label>
                    </div>
                <?php elseif ($i == 'penghasilan_ayah' || $i == 'penghasilan_ibu'): ?>
                    <?php foreach ($penghasilan as $p): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="<?= $i; ?>" type="radio" value="<?= $p; ?>" <?= ($data[$i] == $p ? 'checked' : ''); ?>>
                            <label class="form-check-label"><?= $p; ?></label>
                        </div>

                    <?php endforeach; ?>
                <?php elseif ($i == 'usia'): ?>
                    <input name="<?= $i; ?>" type="text" value="<?= $data[$i]; ?>" class="form-control form-control-sm" placeholder="<?= upper_first(str_replace("_", " ", $i)); ?>" readonly>
                <?php elseif ($i == 'kota_lahir'): ?>
                    <input name="<?= $i; ?>" type="text" value="<?= $data[$i]; ?>" data-to="show_search_daerah" class="form-control form-control-sm show_search_daerah" placeholder="<?= upper_first(str_replace("_", " ", $i)); ?>" readonly>
                <?php elseif ($i == 'tgl_lahir'): ?>
                    <input type="date" style="height: 30px;" data-date="" class="input_date form-control" name="tgl_lahir" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d', $data['tgl_lahir']); ?>">
                <?php else: ?>
                    <input name="<?= $i; ?>" type="text" value="<?= $data[$i]; ?>" class="form-control form-control-sm" placeholder="<?= upper_first(str_replace("_", " ", $i)); ?>">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="d-grid mt-3">
            <button type="submit" class="btn_main"><i class="fa-solid fa-floppy-disk"></i> Save</button>

        </div>
    </form>
</div>

<!-- modal search -->
<div class="modal fade" id="modal_search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body body_modal_search">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.show_search_daerah', function(e) {
        e.preventDefault();

        let to = $(this).data('to');
        let html = '';

        html += '<input type="text" class="form-control form-control-sm get_kabupaten">';
        html += '<div class="list-group mt-2 hasil_pencarian">';
        html += '</div>';

        $('.body_modal_search').html(html);

        let myModal = document.getElementById('modal_search');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();

        $('#modal_search').on('shown.bs.modal', function() {
            $('.get_kabupaten').focus();
        })

        $(document).on('keyup', '.get_kabupaten', function(e) {
            e.preventDefault();
            let text = $(this).val();
            post('get_kabupaten', {
                text
            }).then(res => {
                if (res.status == '200') {
                    let html2 = '';
                    res.data.forEach(e => {
                        html2 += '<a href="#" data-to="' + to + '" class="list-group-item list-group-item-action select_hasil">' + e.name + '</a>';
                    });
                    $('.hasil_pencarian').html(html2);



                } else {
                    gagal_with_button('Connection failed!.');
                }
            })

        })



    })

    $(document).on('click', '.select_hasil', function(e) {
        let val = $(this).text();
        let to = $(this).data('to');

        $('.' + to).val(val);

        let myModal = document.getElementById('modal_search');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.hide();

    })

    $(".input_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format(this.getAttribute("data-date-format"))
        )

    }).trigger("change");
</script>
<?= $this->endSection() ?>