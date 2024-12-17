<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-center mt-5">

        <div class="input-group input-group-sm my-3">
            <span class="input-group-text">Ketik Nama</span>
            <input name="nama" type="text" class="form-control cari_db_niy" placeholder="....">
        </div>
    </div>


    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Sub</th>
                <th scope="col">NIY</th>
            </tr>
        </thead>
        <tbody class="hasil">

        </tbody>
    </table>
</div>

<?= $this->endSection() ?>