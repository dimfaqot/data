<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<div class="container" style="margin-top: 60px;">

    <div class="input-group input-group-sm mb-3">
        <!-- Button trigger modal -->
        <select data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter data berdasar tahun masuk." class="form-select fltr tahun" data-filter="tahun">
            <?php foreach ($tahuns as $i) : ?>
                <option <?= ($i['tahun_masuk'] == $tahun ? 'selected' : ''); ?> value="<?= $i['tahun_masuk']; ?>"><?= $i['tahun_masuk']; ?></option>
            <?php endforeach; ?>
        </select>
        <select data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Filter data berdasar sub." class="form-select fltr sub" data-filter="sub">
            <?php foreach (sub() as $i) : ?>
                <option <?= ($i['singkatan'] == $sub ? 'selected' : ''); ?> value="<?= $i['singkatan']; ?>"><?= $i['singkatan']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="btn-sm btn_main cetak_kts">
            <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cetak Kts." class="fa-regular fa-credit-card"></i> Cetak <?= menu()['menu']; ?>
        </button>
    </div>

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Nisn</th>
                <th style="text-align: center;">Nama</th>
                <th style="text-align: center;">Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $k => $i): ?>
                <tr>
                    <td style="text-align: center;"><?= $k + 1; ?></td>
                    <td style="text-align: center;"><?= ($i['nisn'] == 0 ? '-' : $i['nisn']); ?></td>
                    <td><?= $i['nama']; ?></td>
                    <td><?= (alamat_lengkap($i) == '' ? '-' : alamat_lengkap($i)); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).on('click', '.cetak_kts', function(e) {
        e.preventDefault();

        window.open('<?= base_url('kts/cetak'); ?>/' + '/' + '<?= $tahun; ?>' + '/' + '<?= $sub; ?>', '_blank');
    })
    $(document).on('change', '.fltr', function(e) {
        e.preventDefault();

        let filter = $(this).data('filter');

        if (filter == 'tahun') {
            location.href = '<?= base_url('kts'); ?>/' + $(this).val() + '/' + $('.sub').val();
        }
        if (filter == 'sub') {
            location.href = '<?= base_url('kts'); ?>/' + $('.tahun').val() + '/' + $(this).val();
        }
    })
</script>
<?= $this->endSection() ?>