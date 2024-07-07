<script>
    $(".input_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format(this.getAttribute("data-date-format"))
        )

    }).trigger("change");



    const show_modal_daerah = (tabel, target, id) => {
        let html = '<input ' + (id !== null ? 'data-id="' + id + '"' : '') + ' data-tabel="' + tabel + '" data-target="' + target + '" type="text" class="form-control input_daerah" placeholder="' + upper_first(tabel) + '" autofocus>';
        html += '<div style="position:absolute;" class="body_daerah_dari_db"></div>';
        $('.body_modal_daerah').html(html);
        let myModal = document.getElementById('modal_daerah');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    }


    let daerahs = document.querySelectorAll('.btn_daerah');

    daerahs.forEach((e, i) => {
        e.addEventListener('click', function() {
            $('.body_modal_daerah').html('');
            let tabel = e.getAttribute('data-tabel');
            let target = e.getAttribute('data-target');
            let id = e.getAttribute('data-id');
            show_modal_daerah(tabel, target, id);
        })

    })

    $(document).on('keyup', '.input_daerah', function(e) {
        e.preventDefault();
        let tabel = $(this).data('tabel');
        let target = $(this).data('target');
        let id = $(this).data('id');
        let value = $(this).val();
        let data = {};

        daerahs.forEach(element => {
            let ide = element.getAttribute('data-id');
            if (id == ide) {
                data[element.name] = element.value;

            }
        })

        data['tabel'] = tabel;
        data['value'] = value;

        post('cari_daerah_db', {
            data
        }).then(res => {
            if (res.status == '200') {
                let html = '<a href="" style="display: block;border-radius:4px" class="btn_main_inactive cancel_daerah"><i class="fa-solid fa-circle-xmark"></i> Cancel</a>';
                if (res.data.length == 0) {
                    html += '<div style="display: block;border-radius:4px" class="btn_main_inactive"><i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.</div>';
                } else {
                    res.data.forEach((el, idx) => {
                        html += '<a data-tabel="' + tabel + '" data-target="' + target + '" href="" style="display: block;border-radius:4px" class="btn_main_inactive select_daerah">' + el.name + '</a>';
                    })

                }
                $('.body_daerah_dari_db').html(html);

            } else {
                gagal_js(res.message);
            }
        })

    })

    $(document).on('click', '.cancel_daerah', function(e) {
        e.preventDefault();
        $('.body_daerah_dari_db').html('');
    })

    $(document).on('click', '.select_daerah', function(e) {
        e.preventDefault();
        let tabel = $(this).data('tabel');
        let target = $(this).data('target');
        let value = $(this).text();

        $('.' + target).val(value);

        $('.body_daerah_dari_db').html('');
        let myModal = document.getElementById('modal_daerah');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.hide();

    })

    $(document).on('click', '.zoom_image', function(e) {
        e.preventDefault();
        let url = $(this).attr('src');
        let html = '';
        html = '<div class="d-flex justify-content-center">';
        html += '<div class="card" style="max-width:70%">';
        html += '<div class="card-body">';
        html += '<img src="' + url + '" class="img-fluid" alt="image">';
        html += '</div>';
        html += '</div>';
        html += '<div style="position:absolute;font-size:medium;top:10px" class="btn_bright_sm"><a class="btn_close_zoom_image text-danger" href=""><i class="fa-solid fa-circle-xmark"></i></a> <a href="' + url + '" download><i class="fa-solid fa-circle-down"></i></a></div>';
        html += '</div>';

        $('.box_zoom_image').html(html);
        $('.box_zoom_image').fadeIn();
    })
    $(document).on('click', '.btn_close_zoom_image', function(e) {
        e.preventDefault();
        $('.box_zoom_image').fadeOut();
        $('.box_zoom_image').html('');
    })
    $(document).on('keyup', '.input_search_db', function(e) {
        e.preventDefault();
        let col = $(this).data('col');
        let target = $(this).data('target');
        let tabel = $(this).data('tabel');
        let target_jml_pembayaran = $(this).data('target_jml_pembayaran');
        let value = $(this).val();

        post('cari_lpk_db', {
            col,
            tabel,
            value
        }).then(res => {
            if (res.status == '200') {
                let html = '';
                html += '<a href="" data-target="' + target + '" style="display: block;border-radius:4px" class="btn_main_inactive cancel_search_lpk_db"><i class="fa-solid fa-circle-xmark"></i> Cancel</a>';
                if (res.data.length == 0) {
                    html += '<div style="display: block;border-radius:4px" class="btn_main_inactive"><i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.</div>';
                } else {
                    res.data.forEach((el, idx) => {
                        html += '<a data-target_jml_pembayaran="' + target_jml_pembayaran + '" data-jml_pembayaran="' + el.jml_biaya + '" data-tabel="' + tabel + '" data-target="' + target + '" data-id="' + el.id + '" href="" style="display: block;border-radius:4px" class="btn_main_inactive select_search_lpk_db">' + el[col] + '</a>';
                    })

                }

                $('.body_' + target).html(html);
            } else {
                gagal_with_button(res.message);
            }
        })
    })

    $(document).on('click', '.cancel_search_lpk_db', function(e) {
        e.preventDefault();
        $('.body_' + $(this).data('target')).html('');
    })

    $(document).on('click', '.select_search_lpk_db', function(e) {
        e.preventDefault();
        let target = $(this).data('target');
        let tabel = $(this).data('tabel');
        let val = $(this).data('id');

        if (tabel !== 'siswa') {
            val = $(this).text();
        }

        $('.' + target).val(val);

        if (tabel == 'biaya') {
            let target_jml_pembayaran = $(this).data('target_jml_pembayaran');
            let jml_pembayaran = $(this).data('jml_pembayaran');
            $('.' + target_jml_pembayaran).val(rupiah(jml_pembayaran.toString()));
        }

        $('.body_' + target).html('');
    })


    const rincian_pembayaran = (data, nota_id) => {
        let total = 0;
        let html = '';
        data.forEach((e, i) => {
            total += parseInt(e.jml_pembayaran);
            html += '<tr>';
            html += '<td><input type="date" style="height:30px;" data-date="' + e.tgl_pembayaran_new + '" class="input_date form-control form-control-sm tgl_pembayaran_' + nota_id + '_' + e.id + '" name="tgl_pembayaran" data-date-format="DD/MM/YYYY" value="' + e.tgl_pembayaran_new + '"></td>';
            html += '<td>';
            html += '<input value="' + e.nama_pembayaran + '" type="text" name="nama_pembayaran_' + nota_id + '_' + e.id + '" data-tabel="biaya" data-col="nama_biaya" data-target_jml_pembayaran="update_jml_pembayaran_' + nota_id + '_' + e.id + '" data-target="update_nama_pembayaran_' + nota_id + '_' + e.id + '" class="form-control form-control-sm input_search_db update_nama_pembayaran_' + nota_id + '_' + e.id + '" placeholder="Nama pembayaran" required>';
            html += '<div style="position:absolute;" class="body_update_nama_pembayaran_' + nota_id + '_' + e.id + '"></div>';
            html += '</td>';
            html += '<td><input type="text" name="jml_pembayaran" value="' + rupiah(e.jml_pembayaran.toString()) + '" class="form-control form-control-sm uang update_jml_pembayaran_' + nota_id + '_' + e.id + '" placeholder="Jml. pembayaran" required></td>';
            html += '<td>';
            html += '<textarea class="form-control update_catatan_pembayaran_' + nota_id + '_' + e.id + '" name="catatan_pembayaran" placeholder="Catatan" rows="2">' + e.catatan_pembayaran + '</textarea>';
            html += '</td>';

            html += '<td>';
            html += '<a href type="button" class="btn_update_pembayaran" data-id_nota="' + nota_id + '" data-id="' + e.id + '"><i style="font-size: medium;" class="fa-solid fa-circle-check"></i></a>';
            html += ' <a data-id="' + e.id + '" data-nota_id="' + nota_id + '" data-alert="Yakin hapus data ini?" data-tabel="<?= menu()['tabel']; ?>" data-url="<?= menu()['controller']; ?>/delete" class="btn_confirm text-danger" href=""><i style="font-size: medium;" class="fa-regular fa-circle-xmark"></i>';
            html += '</a>';
            html += '</td>';
            html += '</tr>';

        })

        $('.total_pembayaran').text('TOTAL ' + rupiah(total.toString()));
        $('.body_pembayaran_' + nota_id).html(html);
    }
    $(document).on('click', '.btn_pembayaran', function(e) {
        e.preventDefault();
        let nota_id = $(this).data('id');
        let tgl_pembayaran = $('.p_tgl_pembayaran').val();
        let nama_pembayaran = $('.p_nama_pembayaran').val();
        let jml_pembayaran = $('.p_jml_pembayaran').val();
        let catatan_pembayaran = $('.p_catatan_pembayaran').val();

        post('pembayaran/add_rincian_pembayaran', {
            nota_id,
            tgl_pembayaran,
            nama_pembayaran,
            jml_pembayaran,
            catatan_pembayaran
        }).then(res => {
            if (res.status == '200') {
                rincian_pembayaran(res.data, nota_id);
                sukses_js(res.message);
            } else {
                gagal_with_button(res.message);
            }
        })

    })

    $(document).on('click', '.btn_update_nota_lpk', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = $(this).data('url');
        let tabel = $(this).data('tabel');
        let jenis_siswa = $('.jenis_siswa_' + id).is(':checked');
        let catatan_siswa = $('.catatan_siswa_' + id).val();

        post(url, {
            id,
            tabel,
            jenis_siswa,
            catatan_siswa
        }).then(res => {
            if (res.status == '200') {
                sukses_js(res.message);
            } else {
                gagal_with_button(res.message);
            }
        })
    })
    $(document).on('click', '.btn_update_pembayaran', function(e) {
        e.preventDefault();
        let id_nota = $(this).data('id_nota');
        let id = $(this).data('id');

        let tgl_pembayaran = $('.tgl_pembayaran_' + id_nota + '_' + id).val();
        let nama_pembayaran = $('.update_nama_pembayaran_' + id_nota + '_' + id).val();
        let jml_pembayaran = $('.update_jml_pembayaran_' + id_nota + '_' + id).val();
        let catatan_pembayaran = $('.update_catatan_pembayaran_' + id_nota + '_' + id).val();

        post('pembayaran/update', {
            id,
            tgl_pembayaran,
            jml_pembayaran,
            nama_pembayaran,
            catatan_pembayaran

        }).then(res => {
            if (res.status = '200') {

            } else {
                gagal_with_button(res.message);
            }
        })
    })

    const delete_tabel_pembayaran = (data) => {
        post(data.url, {
            id: data.id,
            nota_id: data.nota_id
        }).then(res => {
            if (res.status == '200') {
                rincian_pembayaran(res.data, data.nota_id);
                sukses_js(res.message);
            } else {
                gagal_with_button(res.message);
            }
        })
    }

    const update_setoran = (data) => {
        post('setoran/update', data).then(res => {
            if (res.status == '200') {
                $('.total_' + data.tahun).text(res.data);
                sukses_js(res.message);
                setTimeout(() => {
                    window.location.reload();
                }, 1000);

            } else {
                gagal_with_button(res.message);
            }
        })
    }

    $(document).on('change', '.date_setoran', function(e) {
        let id = $(this).data('id');
        let order = 'add';
        let tgl_tf = $(this).val();
        let jml_tf = $('.jml_tf').val();
        let tahun = $(this).data('tahun');
        let bulan = $(this).data('bulan');
        let pemberangkatan_id = $(this).data('pemberangkatan_id');
        let col = 'tgl_tf';

        if (id !== '') {
            order = 'update';
            jml_tf = $('.jml_tf_' + id).val();
        }
        update_setoran({
            order,
            pemberangkatan_id,
            id,
            tgl_tf,
            jml_tf,
            tahun,
            bulan,
            col,
            value: tgl_tf
        });
    })
    $(document).on('change', '.btn_setoran', function(e) {
        let id = $(this).data('id');
        let order = 'add';
        let tgl_tf = $('.date_setoran').val();
        let jml_tf = $('.jml_tf').val();
        let tahun = $(this).data('tahun');
        let bulan = $(this).data('bulan');
        let pemberangkatan_id = $(this).data('pemberangkatan_id');


        if (id !== '') {
            order = 'delete';
            tgl_tf = $('.tgl_tf_' + id).val();
            jml_tf = $('.jml_tf_' + id).val();
        }
        update_setoran({
            order,
            pemberangkatan_id,
            id,
            tgl_tf,
            jml_tf,
            tahun,
            bulan,
            col: '',
            value: ''
        });
    })
    $(document).on('blur', '.jml_tf', function(e) {
        let id = $(this).data('id');
        let order = 'add';
        let tgl_tf = $('.date_setoran').val();
        let jml_tf = $(this).val();
        let pemberangkatan_id = $(this).data('pemberangkatan_id');
        let tahun = $(this).data('tahun');
        let bulan = $(this).data('bulan');
        let col = 'jml_tf';

        if (id !== '') {
            order = 'update';
            tgl_tf = $('.tgl_tf_' + id).val();
            jml_tf = $(this).val();
        }
        update_setoran({
            order,
            pemberangkatan_id,
            id,
            tgl_tf,
            jml_tf,
            tahun,
            bulan,
            col,
            value: jml_tf
        });
    })
</script>