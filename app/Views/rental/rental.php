   <?= $this->extend('logged') ?>

   <?= $this->section('content') ?>

   <div class="container" style="margin-top: 60px;">
       <div class="input-group input-group-sm mb-2">
           <button type="button" class="btn-sm btn_secondary" data-bs-toggle="modal" data-bs-target="#<?= menu()['controller']; ?>">
               <i class="fa-solid fa-circle-plus"></i> <?= menu()['menu']; ?>
           </button>
           <a class="nav-link dropdown-toggle btn_secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Tahun [<?= url(4); ?>]
           </a>
           <ul class="dropdown-menu">
               <?php foreach ($tahuns as $i) : ?>
                   <li style="font-size: small;"><a class="dropdown-item <?= (url(4) == $i ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= $i; ?>/<?= url(5); ?>"><?= $i; ?></a></li>
               <?php endforeach; ?>
           </ul>
           <a class="nav-link dropdown-toggle btn_secondary_inactive" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Bulan [<?= url(5); ?>]
           </a>
           <ul class="dropdown-menu">
               <?php foreach (bulan() as $i) : ?>
                   <li style="font-size: small;"><a class="dropdown-item <?= (url(5) == $i['angka'] ? 'bg_main' : ''); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= $i['angka']; ?>"><?= $i['bulan']; ?></a></li>
               <?php endforeach; ?>
           </ul>
           <?php if (session('role') == 'Root') : ?>
               <a class="nav-link dropdown-toggle btn_secondary_inactive" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Kategori [<?= (url(6) == '' ? 'Bus' : url(6)); ?>]
               </a>
               <ul class="dropdown-menu">
                   <?php foreach (options('Rental') as $i) : ?>
                       <li style="font-size: small;"><a class="dropdown-item <?= (url(6) == '' && $i['value'] == 'Bus' ? 'bg_main' : (url(6) !== '' && $i['value'] == url(6) ? 'bg_main' : '')); ?>" href="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= $i['value']; ?>"><?= $i['value']; ?></a></li>
                   <?php endforeach; ?>
               </ul>

           <?php endif; ?>
       </div>
       <div class="input-group input-group-sm mb-2">
           <button type="button" class="btn-sm btn_main btn_pengeluaran">
               <i class="fa-solid fa-screwdriver-wrench"></i> Pengeluaran <?= menu()['menu']; ?>
           </button>
           <button type="button" class="btn-sm btn_secondary btn_laporan">
               <i class="fa-regular fa-file-pdf"></i> Laporan
           </button>
       </div>

       <!-- Modal detail -->
       <div class="modal fade" id="modal_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h6 class="modal-title fs-6" id="exampleModalLabel"><i class="fa-solid fa-screwdriver-wrench"></i> Pengeluaran <?= menu()['menu']; ?></h6>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body body_modal_detail">
                       <table class="table table-sm table-bordered" style="font-size: 12px;">
                           <thead>
                               <tr>
                                   <th class="text-center">Barang</th>
                                   <th class="text-center">Harga</th>
                                   <th class="text-center">Pj</th>
                                   <th class="text-center">Act</th>
                               </tr>
                           </thead>
                           <tbody class="isi_tabel">
                               <tr>
                                   <td style="vertical-align:middle" class="add_barang" contenteditable="true"></td>
                                   <td style="vertical-align:middle" class="text-end add_harga angka_text" contenteditable="true">0</td>
                                   <td style="vertical-align:middle" class="add_pj" contenteditable="true"></td>
                                   <td style="vertical-align:middle" class="text-center"><a class="add_pengeluaran fw-bold fs-5 text-success" href="">+</a></td>
                               </tr>
                           </tbody>
                       </table>

                       <div id="daftar_pengeluaran" class="mt-2"></div>

                   </div>

               </div>
           </div>
       </div>

       <small class="body_warning_img text-danger"></small>
       <form method="post" action="<?= base_url(); ?><?= menu()['controller']; ?>/add_image" class="form-floating mb-2" enctype="multipart/form-data">
           <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>">
           <input type="hidden" name="folder" value="<?= menu()['controller']; ?>">
           <div class="input-group input-group-sm mb-3 line_warning_img">
               <input type="file" class="form-control file" name="file" data-col="img" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pilih gambar.">
               <button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Upload gambar." class="btn_main_inactive" type="submit"><i class="fa-solid fa-circle-arrow-up"></i> Upload</button>
               <button data-bs-toggle="modal" data-bs-target="#images" class="btn_main" type="button"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat gambar." class="fa-solid fa-images"></i></button>
           </div>
       </form>

       <!-- Modal tambah data-->
       <div class="modal fade" id="<?= menu()['controller']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambah_dataLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h1 class="modal-title fs-5" id="tambah_dataLabel"><i class="fa-solid fa-circle-plus"></i> Tambah <?= menu()['menu']; ?> <?= session('role'); ?></h1>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <form action="<?= base_url(menu()['controller']); ?>/add" method="post">
                           <input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>">
                           <div class="mb-2">
                               <label>Tanggal</label>
                               <input type="date" data-date="" class="form-control form-control-sm input_date mt-1" name="tgl" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d'); ?>" required>
                           </div>
                           <div class="row g-2">
                               <?php if (session('role') == 'Root') : ?>
                                   <div class="col-md-6">
                                       <div class="input-group input-group-sm">
                                           <label style="width: 120px; font-size:small" class="input-group-text">Kategori</label>
                                           <select style="font-size: small;" class="form-select" name="kategori" required>
                                               <?php foreach (options('Rental') as $i) : ?>
                                                   <option <?= (url(6) == '' && $i['value'] == 'Bus' ? 'selected' : (url(6) !== '' && $i['value'] == url(6) ? 'selected' : '')); ?> value="<?= $i['value']; ?>"><?= $i['value']; ?></option>
                                               <?php endforeach; ?>
                                           </select>
                                       </div>
                                   </div>
                               <?php endif; ?>
                               <div class="col-md">
                                   <div class="input-group input-group-sm">
                                       <span style="width: 120px; font-size:small" class="input-group-text">Waktu</span>
                                       <input style="font-size: small;" type="text" name="waktu" class="form-control" placeholder="Waktu Keberangkatan">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="input-group input-group-sm">
                                       <span style="width: 120px; font-size:small" class="input-group-text">Pemakai</span>
                                       <input style="font-size: small;" type="text" name="pemakai" class="form-control" placeholder="Pemakai/penyewa bus">
                                   </div>
                               </div>
                               <div class="col-md-6 mb-2">
                                   <div class="input-group input-group-sm mb-3">
                                       <span style="width: 120px; font-size:small" class="input-group-text">Pj.</span>
                                       <input style="font-size: small;" type="text" name="pj" class="form-control" placeholder="Penanggung jawab">
                                   </div>
                               </div>
                           </div>
                           <div class="d-grid p-2">
                               <button type="submit" class="btn btn-primary btn_main" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                   <i class="fa-regular fa-floppy-disk"></i> Save
                               </button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>

       <?php if (count($data) == 0) : ?>
           <div class="mt-2 text-danger"><i class="fa-solid fa-circle-exclamation"></i> Data tidak ditemukan!.</div>
       <?php else : ?>
           <div class="input-group input-group-sm mb-3">
               <span style="width: 120px; font-size:small" class="input-group-text">Cari</span>
               <input style="font-size: small;" type="text" class="form-control cari" placeholder="...">
           </div>



           <table class="table table-sm table-striped table-bordered">
               <thead>
                   <tr>
                       <th class="text-center" scope="col">#</th>
                       <th class="text-center" scope="col">Tgl</th>
                       <th class="text-center" scope="col">Waktu</th>
                       <th class="text-center" scope="col">Pemakai</th>
                       <th class="text-center" scope="col">Pj</th>
                       <th class="text-center d-none d-md-table-cell" scope="col">Masuk</th>
                       <th class="text-center d-none d-md-table-cell" scope="col">Keluar</th>
                       <th scope="col">Saldo</th>
                       <th class="text-center" scope="col">Del</th>
                   </tr>
               </thead>
               <?php $saldo = 0; ?>
               <tbody class="tabel_search">
                   <?php foreach ($data as $k => $i) : ?>
                       <?php {
                            $saldo += (int)$i['masuk'] - (int)$i['keluar'];
                        } ?>
                       <tr>
                           <th scope="row"><?= $k + 1; ?></th>
                           <td><a href="" class="btn_bright_sm" data-bs-toggle="modal" data-bs-target="#modal_update_tgl_rental_<?= $i['id']; ?>"><?= date('d/m/Y', $i['tgl']); ?></a></td>
                           <td data-id="<?= $i['id']; ?>" class="update_blur_rental" contenteditable="true" data-col="waktu"><?= $i['waktu']; ?></td>
                           <td data-id="<?= $i['id']; ?>" class="update_blur_rental" contenteditable="true" data-col="pemakai"><?= $i['pemakai']; ?></td>
                           <td data-id="<?= $i['id']; ?>" class="update_blur_rental" contenteditable="true" data-col="pj"><?= $i['pj']; ?></td>
                           <td class="text-end d-none d-md-table-cell"><?= angka($i['masuk']); ?></td>
                           <td class="text-end d-none d-md-table-cell"><?= angka($i['keluar']); ?></td>
                           <td class="text-end"><?= angka($i['masuk'] - $i['keluar']); ?></td>
                           <td data-id="<?= $i['id']; ?>" data-col="waktu" class="text-center"><a href="" class="confirm" data-id="<?= $i['id']; ?>" data-order="hapus" data-method="delete" style="font-size: medium;"><i class="fa-solid fa-square-xmark danger_color"></i></a> <a href="" data-id="<?= $i['id']; ?>" class="btn_detail"><i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                       </tr>
                   <?php endforeach; ?>
                   <tr>
                       <td class="text-center d-none d-md-table-cell"></td>
                       <td class="text-center d-none d-md-table-cell"></td>
                       <th colspan="5" class="text-center">TOTAL</th>
                       <th class="text-end"><?= angka($saldo); ?></th>
                       <td class="text-center"><i class="fa-solid fa-ban"></i></td>
                   </tr>
               </tbody>
           </table>

           <?php foreach ($data as $i) : ?>
               <!-- Modal tambah update tgl-->
               <div class="modal fade" id="modal_update_tgl_rental_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="update_tglLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-body body_update_tgl_rental">
                               <form action="<?= base_url(menu()['controller']); ?>/update_tgl" method="post">
                                   <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                   <input type="hidden" name="tabel" value="<?= (url(6) == '' ? 'Bus' : url(6)); ?>">
                                   <div class="d-flex justify-content-center gap-2">
                                       <input type="date" data-date="" class="form-control form-control-sm input_date mt-1" name="tgl" data-date-format="DD/MM/YYYY" value="<?= date('Y-m-d', $i['tgl']); ?>">
                                       <button type="submit" class="main_color" style="font-size:medium;background-color:transparent;border:0px;padding-top:5px;"><i class="fa-solid fa-circle-check"></i></button>
                                   </div>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
           <?php endforeach; ?>
       <?php endif; ?>
   </div>

   <script>
       let data = <?= json_encode($data); ?>;
       const template_keluar = (data) => {
           let html = "<hr>";
           html += '<div class="input-group input-group-sm mb-1">';
           html += '<span style="width: 120px; font-size:small" class="input-group-text">Cari</span>';
           html += '<input style="font-size: small;" type="text" class="form-control cari_keluar" placeholder="...">';
           html += '</div>';
           html += '<table class="table table-sm table-bordered" style="font-size: 12px;">';
           html += '<thead>';
           html += '<tr>';
           html += '<th class="text-center">#</th>';
           html += '<th class="text-center">Barang</th>';
           html += '<th class="text-center">Pj</th>';
           html += '<th class="text-center">Harga</th>';
           html += '<th class="text-center">Act</th>';
           html += '</tr>';
           html += '</thead>';
           html += '<tbody class="tabel_cari_keluar">';
           let total = 0;
           data.forEach((e, i) => {
               total += parseInt(e.keluar);
               html += '<tr>';
               html += '<td>' + (i + 1) + '</td>'
               html += '<td data-id="' + e.id + '" data-col="barang" style="vertical-align:middle" class="update_blur_rental" contenteditable="true">' + e.barang + '</td>';
               html += '<td data-id="' + e.id + '" data-col="pj" style="vertical-align:middle" class="update_blur_rental" contenteditable="true">' + e.pj + '</td>';
               html += '<td data-id="' + e.id + '" data-col="keluar" style="vertical-align:middle" class="text-end update_blur_rental angka_text" contenteditable="true">' + angka(e.keluar) + '</td>';
               html += '<td data-id="' + e.id + '"  class="text-center"><a href="" class="confirm" data-id="' + e.id + '" data-order="hapus" data-method="delete" style="font-size: medium;"><i class="fa-solid fa-square-xmark danger_color"></i></a></td>';
               html += '</tr>';

           })
           html += '<tr>';
           html += '<th colspan="3" class="text-end">TOTAL</th>';
           html += '<th class="text-end">' + angka(total) + '</th>';
           html += '<td class="text-center"><i class="fa-solid fa-ban"></i></td>';
           html += '</tr>';

           html += '</tbody>';
           html += '</table>';

           return html;
       }
       $(document).on("click", ".btn_detail", function(e) {
           e.preventDefault();
           let id = $(this).data("id");

           let val = [];

           data.forEach(e => {
               if (e.id == id) {
                   val = e;
                   stop();
               }
           });
           let html = ` <div class="mb-2">
                           <label class="form-label" style="font-size: small;">Masuk</label>
                           <input type="text" data-id="${val.id}" value="${angka(val.masuk)}" class="form-control form-control-sm angka detail_uang detail_uang_Masuk" placeholder="Masuk">
                       </div>
                       <div class="mb-2">
                           <label class="form-label" style="font-size: small;">Keluar</label>
                           <input type="text" data-id="${val.id}" value="${angka(val.keluar)}" class="form-control form-control-sm angka detail_uang detail_uang_Keluar" placeholder="Keluar">
                       </div>
                       <div class="text-center fw-bold p-2 fs-3 rounded bg_main saldo_detail">${angka((parseInt(val.masuk)-parseInt(val.keluar)))}</div>`;

           $(".body_modal_detail").html(html);
           let myModal = document.getElementById("modal_detail");
           let modal = bootstrap.Modal.getOrCreateInstance(myModal);
           modal.show();

       })
       $(document).on("click", ".btn_pengeluaran", function(e) {
           e.preventDefault();
           let tabel = '<?= (url(6) == '' ? 'Bus' : url(6)); ?>';
           let tahun = '<?= url(4); ?>';
           let bulan = '<?= url(5); ?>';

           if (tabel == "All") {
               gagal('Tabel tidak boleh "All".');
               return;
           }
           if (tahun == "All") {
               gagal('Tahun tidak boleh "All".');
               return;
           }
           if (bulan == "All") {
               gagal('Bulan tidak boleh "All".');
               return;
           }
           post('rental/pengeluaran', {
               tabel,
               tahun,
               bulan
           }).then(res => {

               let html = template_keluar(res.data);
               $("#daftar_pengeluaran").html(html);
               let myModal = document.getElementById("modal_detail");
               let modal = bootstrap.Modal.getOrCreateInstance(myModal);
               modal.show();
           })

       })

       $(document).on("keyup", ".detail_uang", function(e) {
           e.preventDefault();
           let keluar = parseInt(str_replace(".", "", $(".detail_uang_Keluar").val()));
           let masuk = parseInt(str_replace(".", "", $(".detail_uang_Masuk").val()));

           $(".saldo_detail").text(angka(keluar - masuk));

       })
       $(document).on('keyup', '.cari_keluar', function(e) {
           e.preventDefault();
           let value = $(this).val().toLowerCase();
           $('.tabel_cari_keluar tr').filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
           });

       });
       $(document).on("blur", ".detail_uang", function(e) {
           e.preventDefault();
           let col = $(this).attr("placeholder").toLowerCase();
           let val = $(this).val();
           let id = $(this).data('id');

           post("rental/update_blur", {
               col,
               tabel: '<?= (url(6) == '' ? 'Bus' : url(6)); ?>',
               id,
               val
           }).then(res => {

           })

       })

       $(document).on('click', '.add_pengeluaran', function(e) {

           e.preventDefault();
           let tabel = '<?= (url(6) == '' ? 'Bus' : url(6)); ?>';
           let tahun = '<?= url(4); ?>';
           let bulan = '<?= url(5); ?>';

           if (tabel == "All") {
               gagal('Tabel tidak boleh "All".');
               return;
           }
           if (tahun == "All") {
               gagal('Tahun tidak boleh "All".');
               return;
           }
           if (bulan == "All") {
               gagal('Bulan tidak boleh "All".');
               return;
           }

           let barang = $(".add_barang").text();
           let pj = $(".add_pj").text();
           let harga = parseInt(str_replace(".", "", $(".add_harga").text()));

           if (barang == "") {
               gagal("Barang harus diisi!.");
               return;
           }
           if (harga == "" || harga == 0) {
               gagal("Harga harus diisi!.");
               return;
           }
           if (pj == "") {
               gagal("Pj harus diisi!.");
               return;
           }

           $(".add_barang").text("");
           $(".add_harga").text("0");
           $(".add_pj").text("");

           post("rental/add_pengeluaran", {
               barang,
               pj,
               harga,
               tabel,
               tahun,
               bulan
           }).then(res => {
               let html = template_keluar(res.data);
               $("#daftar_pengeluaran").html(html);
           })

       });

       $(document).on("click", ".btn_laporan", function(e) {
           e.preventDefault();
           let tabel = '<?= (url(6) == '' ? 'Bus' : url(6)); ?>';
           let tahun = '<?= url(4); ?>';
           let bulan = '<?= url(5); ?>';

           if (tabel == "All") {
               gagal('Tabel tidak boleh "All".');
               return;
           }
           if (tahun == "All") {
               gagal('Tahun tidak boleh "All".');
               return;
           }
           if (bulan == "All") {
               gagal('Bulan tidak boleh "All".');
               return;
           }

           window.open("<?= base_url('public/rental/laporan/cetak/'); ?>" + tabel + "/" + tahun + "/" + bulan, "_blank");
       })

       $('#modal_detail').on('hide.bs.modal', function() {
           location.reload();
       });
   </script>
   <?= $this->endSection() ?>