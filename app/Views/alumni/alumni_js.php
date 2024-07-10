<script>
    $(document).on('keyup', '.cari_nama_santri', function(e) {
        e.preventDefault();
        let value = $(this).val();
        let target = $(this).data('target');
        let col = $(this).data('col');
        let role = $(this).data('role');
        let val = $(this).data('val');
        if (role == 'Root') {
            val = $('.add_val').val();
        }

        post('alumni/cari_nama_santri', {
            value,
            val,
            col
        }).then(res => {
            if (res.status == '200') {
                let html = '';
                html += '<a href="" data-target="' + target + '" style="display: block;border-radius:4px" class="btn_main_inactive cancel_cari_nama_santri"><i class="fa-solid fa-circle-xmark"></i> Cancel</a>';
                if (res.data.length == 0) {
                    html += '<div style="display: block;border-radius:4px" class="btn_main_inactive"><i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.</div>';
                } else {
                    res.data.forEach((el, idx) => {
                        html += '<a data-val="' + val + '" data-col="' + col + '" data-santri_id="' + el.no_id + '" data-target="' + target + '" data-id="' + el.id + '" href="" style="display: block;border-radius:4px" class="btn_main_inactive select_cari_nama_santri">' + el.nama + '</a>';
                    })

                }

                $('.body_' + target).html(html);
            } else {
                gagal_with_button(res.message);
            }
        })
    })

    $(document).on('click', '.cancel_cari_nama_santri', function(e) {
        e.preventDefault();
        $('.body_' + $(this).data('target')).html('');
    })

    $(document).on('click', '.select_cari_nama_santri', function(e) {
        e.preventDefault();
        let target = $(this).data('target');
        let santri_id = $(this).data('santri_id');
        let col = $(this).data('col');
        let val = $(this).data('val');
        let nama_alumni = $(this).text();

        post('alumni/is_nama_alumni_exist', {
            santri_id,
            nama_alumni,
            col,
            val
        }).then(res => {
            if (res.status == '200') {
                $('.' + target).data('santri_id', santri_id);
                $('.' + target).val(nama_alumni);
            } else {
                gagal_with_button(res.message);
            }

        })
        $('.body_' + target).html('');
    })


    $(document).on('click', '.btn_add_data', function(e) {
        e.preventDefault();
        let santri_id = $('.add_cari_nama_santri').data('santri_id');
        let role = $('.add_cari_nama_santri').data('role');
        let order = $(this).data('order');
        let value = $('.add_cari_nama_santri').data('val');
        let nama_alumni = $('.add_cari_nama_santri').val();
        if (role == 'Root') {
            value = $('.add_val').val();
        }

        post(order + '/add', {
            santri_id,
            value,
            nama_alumni
        }).then(res => {
            if (res.status == '200') {
                sukses_js(res.message);

                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                gagal_with_button(res.message);
            }
        })
    })

    let role = "<?= session('role'); ?>";

    function Identitas(id, order, data, data2) {

        let profesi = <?= json_encode(options('Profesi')); ?>;

        html = '';
        html += '<div class="box_card">';
        html += '<label class="form-label">No. Alumni</label>';
        html += '<input value="' + data.alumni_id + '" type="text" class="form-control" disabled>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">No. Id Santri</label>';
        html += '<input value="' + data.santri_id + '" type="text" class="form-control" disabled>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Nama Lengkap (Jangan disingkat!)</label>';
        html += '<input placeholder="Nama lengkap" value="' + data.nama_alumni + '" type="text" class="form-control update_nama_alumni_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Profesi</label>';
        html += '<select class="form-select update_profesi_' + id + '">';
        profesi.forEach((e, i) => {
            html += '<option ' + (data.profesi == '' ? (i == 0 ? 'selected' : '') : data.profesi == e.value ? 'selected' : '') + ' value="' + e.value + '">' + e.value + '</option>';

        })
        html += '</select>';
        html += '</div>';
        if (role == 'Root') {
            let marhalah = <?= json_encode(options('Marhalah')); ?>;
            let region = <?= json_encode(options('Region')); ?>;
            html += '<div class="box_card">';
            html += '<label class="form-label">Angkatan</label>';
            html += '<select class="form-select update_angkatan_' + id + '">';

            html += '<option value="">Kosong</option>';
            marhalah.forEach((e, i) => {
                html += '<option value="' + e.value + '" ' + (data.angkatan == e.value ? 'selected' : '') + '>' + e.value + '</option>';

            })
            html += '</select>';
            html += '</div>';

            html += '<div class="box_card">';
            html += '<label class="form-label">Region</label>';
            html += '<select class="form-select update_region_' + id + '">';
            html += '<option value="">Kosong</option>';
            region.forEach((e, i) => {
                html += '<option value="' + e.value + '" ' + (data.region == e.value ? 'selected' : '') + '>' + e.value + '</option>';

            })
            html += '</select>';
            html += '</div>';
        }
        if (role == 'Root' || controller == 'region') {
            html += '<div class="d-grid"><button data-id="' + id + '" ' + (role == 'Root' ? 'data-cols="nama_alumni,profesi,region,angkatan"' : 'data-cols="nama_alumni,profesi"') + ' data-order="Identitas" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';
        } else {
            if (data.region == '') {
                html += '<div class="d-grid"><button data-id="' + id + '" ' + (role == 'Root' ? 'data-cols="nama_alumni,profesi,region,angkatan"' : 'data-cols="nama_alumni,profesi"') + ' data-order="Identitas" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';
            } else {
                html += '<h6 style="font-style:italic;color:#C51605">*Hanya bisa diupdate oleh Admin Region!.</h6>';
            }
        }
        $('.content_detail_identitas').html(html);

    }

    function Contact(id, order, data, data2) {

        html = '';
        html += '<div class="box_card">';
        html += '<label class="form-label">Whatsapp Aktif</label>';
        html += '<input placeholder="No. Whatsapp aktif atau no. hp" value="' + data.hp_alumni + '" type="text" class="form-control update_hp_alumni_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Email</label>';
        html += '<input placeholder="Email" value="' + data.email_alumni + '" type="email" class="form-control update_email_alumni_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Instagram</label>';
        html += '<input placeholder="Akun instagram" value="' + data.ig_alumni + '" type="text" class="form-control update_ig_alumni_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Tiktok</label>';
        html += '<input placeholder="Akun tiktok" value="' + data.tiktok_alumni + '" type="text" class="form-control update_tiktok_alumni_' + id + '">';
        html += '</div>';

        if (role == 'Root' || controller == 'region') {
            html += '<div class="d-grid"><button data-id="' + id + '" data-cols="hp_alumni,email_alumni,ig_alumni,tiktok_alumni" data-order="Contact" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';

        } else {
            if (data.region == '') {
                html += '<div class="d-grid"><button data-id="' + id + '" data-cols="hp_alumni,email_alumni,ig_alumni,tiktok_alumni" data-order="Contact" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';

            } else {
                html += '<h6 style="font-style:italic;color:#C51605">*Hanya bisa diupdate oleh Admin Region!.</h6>';
            }
        }
        $('.content_detail_identitas').html(html);

    }

    function Domisili(id, order, data, data2) {

        html = '<h6>Tempat tinggal saat ini.</h6>';

        html += '<div class="box_card">';
        html += '<label class="form-label">Alamat</label>';
        html += '<input value="' + data.alamat_domisili + '" type="text" class="form-control update_alamat_domisili_' + id + '" placeholder="Alamat di bawah desa/kelurahan">';
        html += '</div>';

        html += '<div class="box_card">';
        html += '<label class="form-label">Provinsi</label>';
        html += '<input value="' + data.provinsi_domisili + '" data-id="' + id + '" data-tabel="provinsi" type="text" data-target="update_provinsi_domisili_' + id + '" class="form-control btn_daerah update_provinsi_domisili_' + id + '" placeholder="Provinsi" readonly>';
        html += '</div>';

        html += '<div class="box_card">';
        html += '<label class="form-label">Kabupaten</label>';
        html += '<input value="' + data.kabupaten_domisili + '" data-id="' + id + '" data-tabel="kabupaten" type="text" data-target="update_kabupaten_domisili_' + id + '" class="form-control btn_daerah update_kabupaten_domisili_' + id + '" placeholder="Kabupaten" readonly>';
        html += '</div>';

        html += '<div class="box_card">';
        html += '<label class="form-label">Kecamatan</label>';
        html += '<input value="' + data.kecamatan_domisili + '" data-id="' + id + '" data-tabel="kecamatan" type="text" data-target="update_kecamatan_domisili_' + id + '" class="form-control btn_daerah update_kecamatan_domisili_' + id + '" placeholder="Kecamatan" readonly>';
        html += '</div>';

        html += '<div class="box_card">';
        html += '<label class="form-label">Kelurahan</label>';
        html += '<input value="' + data.kelurahan_domisili + '" data-id="' + id + '" data-tabel="kelurahan" type="text" data-target="update_kelurahan_domisili_' + id + '" class="form-control btn_daerah update_kelurahan_domisili_' + id + '" placeholder="Kelurahan" readonly>';
        html += '</div>';

        if (role == 'Root' || controller == 'region') {
            html += '<div class="d-grid"><button data-id="' + id + '" data-cols="alamat_domisili,provinsi_domisili,kabupaten_domisili,kecamatan_domisili,kelurahan_domisili" data-order="Domisili" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';

        } else {
            if (data.region == '') {
                html += '<div class="d-grid"><button data-id="' + id + '" data-cols="alamat_domisili,provinsi_domisili,kabupaten_domisili,kecamatan_domisili,kelurahan_domisili" data-order="Domisili" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';

            } else {
                html += '<h6 style="font-style:italic;color:#C51605">*Hanya bisa diupdate oleh Admin Region!.</h6>';
            }
        }

        $('.content_detail_identitas').html(html);

    }

    function Kuliah(id, order, data, data2) {

        html = '';
        html += '<div class="box_card">';
        html += '<label class="form-label">Nama Kampus</label>';
        html += '<input placeholder="Nama lengkap kampus" value="' + data.kampus + '" type="text" class="form-control update_kampus_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Fakultas</label>';
        html += '<input placeholder="Nama lengkap fakultas" value="' + data.fakultas + '" type="text" class="form-control update_fakultas_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Jurusan</label>';
        html += '<input placeholder="Nama lengkap jurusan" value="' + data.jurusan + '" type="text" class="form-control update_jurusan_' + id + '">';
        html += '</div>';


        if (role == 'Root' || controller == 'region') {
            html += '<div class="d-grid"><button data-id="' + id + '" data-cols="kampus,fakultas,jurusan" data-order="Contact" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';

        } else {
            if (data.region == '') {

                html += '<div class="d-grid"><button data-id="' + id + '" data-cols="kampus,fakultas,jurusan" data-order="Contact" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';
            } else {
                html += '<h6 style="font-style:italic;color:#C51605">*Hanya bisa diupdate oleh Admin Region!.</h6>';
            }
        }
        $('.content_detail_identitas').html(html);

    }

    function Kerja(id, order, data, data2) {

        html = '';
        html += '<div class="box_card">';
        html += '<label class="form-label">Bidang Pekerjaan</label>';
        html += '<input placeholder="Bidang pekerjaan" value="' + data.bidang_pekerjaan + '" type="text" class="form-control update_bidang_pekerjaan_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Jabatan</label>';
        html += '<input placeholder="Jabatan di tempat kerja" value="' + data.jabatan_pekerjaan + '" type="text" class="form-control update_jabatan_pekerjaan_' + id + '">';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Nama Tempat Kerja</label>';
        html += '<input placeholder="Nama tempat kerja" value="' + data.nama_perusahaan + '" type="text" class="form-control update_nama_perusahaan_' + id + '">';
        html += '</div>';

        html += '<div class="box_card">';
        html += '<label class="form-label">Alamat Tempat Kerja</label>';
        html += '<input placeholder="Alamat tempat kerja" value="' + data.alamat_perusahaan + '" type="text" class="form-control update_alamat_perusahaan_' + id + '">';
        html += '</div>';


        if (role == 'Root' || controller == 'region') {
            html += '<div class="d-grid"><button data-id="' + id + '" data-cols="bidang_pekerjaan,jabatan_pekerjaan,nama_perusahaan,alamat_perusahaan" data-order="Contact" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';

        } else {
            if (data.region == '') {
                html += '<div class="d-grid"><button data-id="' + id + '" data-cols="bidang_pekerjaan,jabatan_pekerjaan,nama_perusahaan,alamat_perusahaan" data-order="Contact" class="btn_update_identitas btn_main" style="border-radius:5px" type="button"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>';

            } else {
                html += '<h6 style="font-style:italic;color:#C51605">*Hanya bisa diupdate oleh Admin Region!.</h6>';
            }
        }
        $('.content_detail_identitas').html(html);

    }

    function Riwayat(id, order, data, data2) {

        html = '';
        html += '<div class="box_card">';
        html += '<label class="form-label">Tempat, Tanggal Lahir</label>';
        html += '<input value="' + (data.ttl == '' || data.ttl == 0 ? '-' : data.ttl) + '" type="text" class="form-control" readonly>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Alamat Lengkap</label>';
        html += '<textarea type="text" class="form-control" readonly>' + (data.alamat_lengkap == '' || data.alamat_lengkap == 0 ? '-' : data.alamat_lengkap) + '</textarea>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Tahun Masuk</label>';
        html += '<input value="' + (data.tahun_masuk == '' || data.tahun_masuk == 0 ? '-' : data.tahun_masuk) + '" type="text" class="form-control" readonly>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Tahun Lulus</label>';
        html += '<input value="' + (data.tahun_keluar == '' || data.tahun_keluar == 0 ? '-' : data.tahun_keluar) + '" type="text" class="form-control" readonly>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Pondok</label>';
        html += '<input value="' + (data.pondok == '' || data.pondok == 0 ? '-' : data.pondok) + '" type="text" class="form-control" readonly>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Sekolah Asal</label>';
        html += '<input value="' + (data.sekolah_asal == '' || data.sekolah_asal == 0 ? '-' : data.sekolah_asal) + '" type="text" class="form-control" readonly>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Nama Ayah</label>';
        html += '<input value="' + (data.nama_ayah == '' || data.nama_ayah == 0 ? '-' : data.nama_ayah) + '" type="text" class="form-control" readonly>';
        html += '</div>';
        html += '<div class="box_card">';
        html += '<label class="form-label">Nama Ibu</label>';
        html += '<input value="' + (data.nama_ibu == '' || data.nama_ibu == 0 ? '-' : data.nama_ibu) + '" type="text" class="form-control" readonly>';
        html += '</div>';

        $('.content_detail_identitas').html(html);

    }

    const content_detail_identitas = (id, santri_id, judul = "Identitas") => {

        post(controller + '/detail', {
            judul,
            santri_id,
            id
        }).then(res => {
            if (res.status == '200') {
                window[judul](id, judul, res.data, res.data2);
                if (res.data[controller] !== '' && judul !== 'Riwayat') {
                    $('.judul_modal_detail_identitas').text(upper_first(controller) + ' ' + res.data[controller]);
                }
                let myModal = document.getElementById('modal_detail_identitas');
                let modal = bootstrap.Modal.getOrCreateInstance(myModal)
                modal.show();
            } else {
                gagal_with_button(res.message);
            }
        })

    }

    let id_detail_alumni;
    let santri_id_detail_alumni;

    $(document).on('click', '.btn_detail_identitas', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let santri_id = $(this).data('santri_id');
        let judul = 'Identitas';
        let navs = document.querySelectorAll('.nav-link');
        id_detail_alumni = id;
        santri_id_detail_alumni = santri_id;

        navs.forEach((e, i) => {
            if (e.dataset.judul == judul) {
                e.classList.add('active');
            } else {
                e.classList.remove('active');
            }
        })
        content_detail_identitas(id, santri_id, judul);
    })

    $(document).on('click', '.nav-link', function(e) {
        e.preventDefault();
        let id = id_detail_alumni;
        let santri_id = santri_id_detail_alumni;
        let judul = $(this).data('judul');
        let navs = document.querySelectorAll('.nav-link');

        navs.forEach((e, i) => {
            if (e.dataset.judul == judul) {
                e.classList.add('active');
            } else {
                e.classList.remove('active');
            }
        })
        content_detail_identitas(id, santri_id, judul);
    })

    $(document).on('click', '.btn_daerah', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let tabel = $(this).data('tabel');
        let target = $(this).data('target');

        if (tabel == 'provinsi' && $('.update_alamat_domisili_' + id).val() == '') {
            gagal_js('Alamat harus diisi!.');
            return false;
        }
        if (tabel == 'kabupaten' && $('.update_provinsi_domisili_' + id).val() == '') {
            gagal_js('Provinsi harus diisi!.');
            return false;
        }
        if (tabel == 'kecamatan') {
            if ($('.update_provinsi_domisili_' + id).val() == '' || $('.update_kabupaten_domisili_' + id).val() == '') {
                gagal_js('Provinsi dan Kabupaten harus diisi!.');
                return false;
            }
        }

        if (tabel == 'kelurahan') {
            if ($('.update_provinsi_domisili_' + id).val() == '' || $('.update_kabupaten_domisili_' + id).val() == '' || $('.update_kecamatan_domisili_' + id).val() == '') {
                gagal_js('Provinsi, Kabupaten, dan Kecamatan harus diisi!.');
                return false;
            }
        }

        let html = ' <input type="text" data-id="' + id + '" data-tabel="' + tabel + '" data-target="' + target + '" class="form-control mb-2 input_daerah" placeholder="Text" autofocus>';
        html += '<div class="lists_daerah"></div>';

        $('.body_daerah').html(html);
        $('.div_body_daerah').fadeIn();

    })



    $(document).on('keyup', '.input_daerah', function(e) {
        e.preventDefault();
        let tabel = $(this).data('tabel');
        let target = $(this).data('target');
        let id = $(this).data('id');
        let provinsi = $('.update_provinsi_domisili_' + id).val();
        let kabupaten = $('.update_kabupaten_domisili_' + id).val();
        let kecamatan = $('.update_kecamatan_domisili_' + id).val();

        let value = $(this).val();
        let data = {
            tabel,
            value,
            provinsi,
            kabupaten,
            kecamatan
        };

        post('cari_daerah_db', {
            data
        }).then(res => {
            if (res.status == '200') {
                let html = '';
                if (res.data.length == 0) {
                    html += '<div style="display: block;border-radius:4px" class="btn_main_inactive"><i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.</div>';
                } else {
                    res.data.forEach((el, idx) => {
                        html += '<a data-tabel="' + tabel + '" data-target="' + target + '" href="" style="display: block;border-radius:4px" class="btn_main_inactive select_daerah">' + el.name + '</a>';
                    })

                }
                $('.lists_daerah').html(html);

            } else {
                gagal_js(res.message);
            }
        })

    })

    $(document).on('click', '.btn_close_div_daerah', function(e) {
        e.preventDefault();
        $('.div_body_daerah').fadeOut();
        $('.input_daerah').val('');
        $('.lists_daerah').html('');
    })

    $(document).on('click', '.select_daerah', function(e) {
        e.preventDefault();
        let tabel = $(this).data('tabel');
        let target = $(this).data('target');
        let value = $(this).text();

        $('.div_body_daerah').fadeOut();
        $('.input_daerah').val('');
        $('.lists_daerah').html('');
        $('.' + target).val(value);

    })

    $(document).on('click', '.btn_update_identitas', function(e) {
        e.preventDefault();
        let cols = $(this).data('cols');
        let id = $(this).data('id');
        let order = $(this).data('order');

        let arr_cols = cols.split(",");
        let data = {
            cols,
            id
        };

        arr_cols.forEach((e, i) => {
            data[e] = $('.update_' + e + '_' + id).val();
        })

        post(controller + '/update', data).then(res => {
            if (res.status == '200') {
                sukses_js(res.message);
            } else {
                gagal_with_button(res.message);
            }
        })

    })
    $(document).on('click', '.confirm_del', function(e) {
        e.preventDefault();
        let col = $(this).data('col');
        let id = $(this).data('id');

        let html = '';
        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:1px solid red;border-radius:8px;padding:10px 20px;background-color:#f8e3e5;color:#810810">';
        html += '<div>Yakin hapus data ini?</div>';
        html += '<div class="d-flex gap-1">';
        html += '<a class="cancel_confirm_clear text-dark" href=""><i class="fa-solid fa-circle-xmark" style="font-size:large"></i></a>';
        html += '<a class="clear_execute text-success" data-id="' + id + '" data-col="' + col + '" href=""><i class="fa-regular fa-circle-check" style="font-size:large"></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $('.box_warning').html(html);
        $('.box_warning').fadeIn();
    })

    $(document).on('click', '.cancel_confirm_clear', function(e) {
        e.preventDefault();
        $('.box_warning').fadeOut();
        setTimeout(() => {
            $('.box_warning').html('');
        }, 1500);
    })

    $(document).on('click', '.clear_execute', function(e) {
        e.preventDefault();
        let col = $(this).data('col');
        let id = $(this).data('id');

        post(controller + '/delete', {
            col,
            id
        }).then(res => {
            if (res.status == '200') {
                sukses_js(res.message);
                setTimeout(() => {
                    window.location.reload();
                }, 1300);
            } else {
                gagal_with_button(res.message);
            }
        })
    })
</script>