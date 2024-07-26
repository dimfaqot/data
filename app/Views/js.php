<script>
    <?php if (panduan() == 1) : ?>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    <?php endif; ?>


    const wa = () => {
        let cols = ['hp', 'hp_ayah', 'hp_ibu', 'hp_wali'];
        let controller = '<?= get_db(menu()['tabel']); ?>';
        let nama;
        let no;
        let text;
        for (let i = 0; i < cols.length; i++) {

            nama = $('.wa_' + cols[i]).data('nama');
            no = $('.wa_' + cols[i]).data('no');

            if (no == '' || no == undefined) {
                continue;
            }

            if (no.length < 10) {
                continue;
            }

            no = '+62' + no.slice(1);

            let = sapaan = '';
            if (controller == 'santri') {
                if (cols[i] == 'hp') {
                    sapaan = 'Ananda';
                }
                if (cols[i] == 'hp_ayah') {
                    sapaan = 'Ayahanda'
                }
                if (cols[i] == 'hp_ibu') {
                    sapaan = 'Ibunda';
                }
                if (cols[i] == 'hp_wali') {
                    sapaan = 'Wali';
                }
            } else {
                if ($('.check_gender').val() == 'L') {
                    sapaan = 'Bapak';
                } else {
                    sapaan = 'Ibu';
                }
            }

            $('.body_wa_' + cols[i]).html('<a href="" class="bubble send_wa" data-sapaan="' + sapaan + '" data-col="' + cols[i] + '" data-nama="' + nama + '" data-no="' + no + '"><i class="fa-brands fa-whatsapp"></i></a>');

        }
    }

    <?php if (url() !== 'identitas') : ?>
        wa();

    <?php endif; ?>

    const loading = (req = true) => {
        if (req === true) {
            $('.waiting').show()
        } else {
            $('.waiting').fadeOut()
        }
    }


    async function getApi(url = '') {
        loading(true);
        const response = await fetch(url);
        const movies = await response.json();
        loading(false);
        return movies;
    }

    async function post(url = '', data = {}) {
        loading(true);
        const response = await fetch("<?= base_url(); ?>" + url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        loading(false);
        return response.json(); // parses JSON response into native JavaScript objects
    }
    const str_replace = (search, replace, subject) => {
        return subject.split(search).join(replace);
    }

    const upper_first = (str) => {
        let arr = str.split(" ");
        for (var i = 0; i < arr.length; i++) {
            arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

        }

        let res = arr.join(" ");

        return res;
    }

    $(".btnclose").click(function() {
        $('.gagal').hide();
    })

    setTimeout(() => {
        $('.sukses').fadeOut();
    }, 1200);

    const sukses = () => {
        $('.sukses').show();
        setTimeout(() => {
            $('.sukses').fadeOut();
        }, 1200);
    }

    const gagal = (alert) => {
        $('.textGagal').text(alert);
        $('.gagal').fadeIn();
    }

    const validateEmail = (email) => {
        let res = String(email)
            .toLowerCase()
            .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );

        if (res == null) {
            return false;
        } else {
            let host = res[5].split('.');
            if (host[0] !== 'gmail' && host[0] !== 'yahoo' && host[0] !== 'hotmail' && host[0] !== 'outlook' && host[0] !== 'proton' && host[0] !== 'zoho') {
                return false;
            } else {
                return true;
            }
        }
    };

    const rupiah = (angka, prefix) => {

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        return prefix == undefined ? 'Rp. ' + rupiah : prefix + ' ' + rupiah;
    }



    const tgl_lahir = (tgl_lahir) => {
        let exp = tgl_lahir.split('/');
        if (exp.length >= 3) {
            return exp[2] + '/' + exp[1] + '/' + exp[0];
        } else {
            return tgl_lahir;
        }

    }

    let start = 0;
    let end = 0;
    let text = '';
    let name_class = '';
    let mySelection = function(element) {
        let startPos = element.selectionStart;
        let endPos = element.selectionEnd;
        let col = element.getAttribute('data-class');
        let selectedText = element.value.substring(startPos, endPos);

        if (selectedText.length <= 0) {
            return; // stop here if selection length is <= 0
        }

        // log the selection
        // console.log("startPos: " + startPos, " | endPos: " + endPos);
        // console.log("selectedText: " + selectedText);

        $('.text_selected').val(selectedText);
        start = startPos;
        end = endPos - 1;
        text = selectedText;
        cls = col;
    };

    let textAreaElements = document.getElementsByClassName('selection');
    [...textAreaElements].forEach(function(element) {
        // register "mouseup" event for the mouse
        element.addEventListener('mouseup', function() {
            mySelection(element)
        });

        // register "keyup" event for the keyboard
        element.addEventListener('keyup', function(event) {
            // assuming we need CTRL, SHIFT or CMD key to select text
            // only listen for those keyup events
            if (event.keyCode == 16 || event.keyCode == 17 || event.metaKey) {
                mySelection(element)
            }
        });
    });


    let cols_selection = ['miring', 'tebal', 'enter'];

    for (let i = 0; i < cols_selection.length; i++) {
        $(document).on('click', '.' + cols_selection[i], function(e) {
            e.preventDefault();

            let all_text = $('.selection_' + cls).val();
            let arr = all_text.split('');

            let texts = '';
            for (let t = 0; t < arr.length; t++) {
                if (t == start) {
                    if (cols_selection[i] == 'miring') {
                        texts += '_' + arr[t];
                    }
                    if (cols_selection[i] == 'tebal') {
                        texts += '*' + arr[t];
                    }
                    if (cols_selection[i] == 'enter') {
                        texts += arr[t];
                    }
                } else if (t == end) {
                    if (cols_selection[i] == 'miring') {
                        texts += arr[t] + '_';
                    }
                    if (cols_selection[i] == 'tebal') {
                        texts += arr[t] + '*';
                    }
                    if (cols_selection[i] == 'enter') {
                        texts += arr[t] + '%0a';
                    }
                } else {
                    texts += arr[t];
                }
            }

            $('.selection_' + cls).val(texts);

        });
    }

    $(document).on('click', '.send_wa', function() {

        let controller = '<?= url(); ?>';
        let no = $(this).data('no');
        // let no = '+62895346286566';
        let nama = $(this).data('nama');
        let sapaan = $(this).data('sapaan');
        let col = $(this).data('col');

        let text = "Assalamualaikum wr. wb.";

        if (controller == 'santri' || controller == 'ppdb') {
            if (col == 'hp') {
                text += "%0aYth: " + sapaan + ' ' + nama + '%0a';
            } else {
                text += "%0aYth: " + sapaan + ' dari Ananda ' + nama + '%0a';
            }

        } else {
            text += "%0aYth: " + ($(".radio_sapaan").prop("checked") ? sapaan : '') + ' ' + nama + '%0a';

        }

        $('input[name="text_wa"]:checked').each(function() {
            let label = 'Tanggal    :';
            if (this.value == 'jam') {
                label = 'Pukul   :';
            }
            if (this.value == 'tempat') {
                label = 'Tempat   :';
            }
            if (this.value == 'acara') {
                label = 'Acara   :';
            }

            text += (this.value == 'tgl' || this.value == 'jam' || this.value == 'tempat' || this.value == 'acara' ? label + ' ' : '') + $('.selection_' + this.value).val() + '%0a';
        });

        $(this).attr('href', 'whatsapp://send/?phone=' + no + '&text=' + text);

        $(this).trigger('click');
    });



    const sukses_check = (cls, message) => {
        $('.check_' + cls).removeClass('is-invalid');
        $('.check_' + cls).addClass('is-valid');

        $(".body_feedback_" + cls).removeClass('invalid-feedback');
        $(".body_feedback_" + cls).addClass('valid-feedback');
        $(".body_feedback_" + cls).html('<small class="text-success">' + (message == '' ? '' : '<i class="fa-solid fa-circle-check"></i>') + ' ' + message + '</small>');

    }
    const gagal_check = (cls, message) => {
        $('.check_' + cls).removeClass('is-valid');
        $('.check_' + cls).addClass('is-invalid');

        $(".body_feedback_" + cls).removeClass('valid-feedback');
        $(".body_feedback_" + cls).addClass('invalid-feedback');
        $(".body_feedback_" + cls).html('<small class="text-danger">' + (message == '' ? '' : '<i class="fa-solid fa-circle-exclamation"></i>') + ' ' + message + '</small>');
        $('.btn_check').attr('type', 'button');
    }

    const default_check = (cls) => {
        $(".body_feedback_" + cls).html('');
        $(".check_" + cls).removeClass('is-invalid');
        $(".check_" + cls).removeClass('is-valid');
    }

    function get_file(filePath, order) {
        let file = filePath.substr(filePath.lastIndexOf('\\') + 1);
        let arr = file.split(".");

        let hasil = '';
        let last = arr.length - 1;
        if (order == 'nama') {
            for (let i = 0; i < arr.length; i++) {
                if (i !== last) {
                    hasil += (i > 0 ? '.' : '') + arr[i];
                }
            }
        }
        if (order == 'exe') {
            for (let i = 0; i < arr.length; i++) {
                if (i == last) {
                    hasil = arr[i];
                }
            }
        }

        return hasil.toLocaleLowerCase();
    }

    const check_tahun = (col, val, tahun_masuk = undefined) => {

        let tahun_now = <?= date('Y'); ?>;
        let x = 0;
        if (val == '') {
            gagal_check(col, 'Tahun tidak boleh kosong!. Contoh yang benar: <span style="font-weight:bold">2023</span>');
            x = 1;
        }

        if (col == 'tahun_masuk') {
            if (val < 1990) {
                gagal_check(col, 'Tahun paling lama 1990.');
                x = 1;
            }

        }
        if (val > tahun_now) {
            gagal_check(col, 'Tahun harus lebih kecil atau sama dengan tahun sekarang.');
            x = 1;
        }
        if (col == 'tahun_keluar') {

            if (parseInt(val) < tahun_masuk) {
                gagal_check(col, 'Tahun keluar tidak boleh lebih kecil dari tahun masuk.');
                x = 1
            }

        }
        return x;
    }

    const remove_array_by_value = (arr, cols) => {
        let res = [];
        for (let i = 0; i < arr.length; i++) {
            if (!cols.includes(arr[i])) {
                res.push(arr[i]);
            }
        }

        return res;
    }


    $(document).on('keyup', '.cari', function(e) {
        e.preventDefault();
        let value = $(this).val().toLowerCase();
        console.log(value);

        $('.tabel_search tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

    });

    $(document).on('click', '.zoom', function(e) {
        e.preventDefault();
        let url = $(this).data('url');

        let html = '';
        html += '<button type="button" class="btn-sm btn_main_inactive" data-bs-dismiss="modal">Close</button>';
        html += '<a href="' + url + '" type="button" class="btn-sm btn_main" download>Download</a>';
        $('.download_footer').html(html);

        let img = '';
        img += '<img src="' + url + '" class="img-fluid" alt="File">';
        $('.body_download').html(img);

        let myModal = document.getElementById('modal_zoom');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show()
    });

    $(document).on('keyup', '.uang', function(e) {
        e.preventDefault();
        let val = $(this).val();
        $(this).val(rupiah(val));
    });

    $(document).on('click', '.confirm', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let order = $(this).data('order');
        let method = $(this).data('method');
        let status = $(this).data('status');
        if (order == 'next') {
            order = 'peserta ini ke tahap berikutnya?';
        } else if (order == 'back') {
            order = 'kembali ke sebelumnya?';
        } else if (order == 'gagal') {
            order = 'peserta ini tidak diterima?';
        } else {
            order = order + ' data ini?';
        }

        let controller = "<?= menu()['controller']; ?>";

        $('#' + controller + '_' + id).modal('hide');


        let html = '';
        html += '<div class="middlecenter">';
        html += '<div class="d-flex justify-content-between shadow shadow-lg bg-white px-1" style="border:1px solid #dad8d8;border-radius: 10px;width:300px;font-size:12px;">';

        html += '<div class="toast-body p-2 text-danger alert_message" style="border-radius: 10px; font-size:12px;">';
        if (controller == 'ppdb' && status == 'Interview' && method == 'next') {
            html += '<div class="form-check form-switch">';
            html += '<input class="form-check-input ppdb_bersyarat" type="checkbox" role="switch">';
            html += '<label class="form-check-label">Bersyarat</label>'
            html += '</div>';
        }
        html += '<i class="fa-solid fa-triangle-exclamation text-warning"></i> Yakin ' + order + (order == 'insert' ? ' Setelah diinsert data ini akan dihapus!.' : '') + '</div>';
        html += '<div class="d-flex justify-content-center body_btn_confirm">';
        html += '<button data-id="' + id + '" type="button" class="btn btn-sm m-auto bg-white text-secondary cancel_confirm"><i class="fa-solid fa-xmark"></i></button>';
        html += '<button data-method="' + method + '" data-id="' + id + '" type="button" class="btn btn-sm m-auto bg-white text-success delete" data-col="delete"><i class="fa-regular fa-circle-check"></i></button>';
        html += '</div>';

        html += '</div>';
        html += '</div>';
        $('.modal_confirm').html(html);
        $('.modal_confirm').show();
    });

    $(document).on('click', '.cancel_confirm', function(e) {
        e.preventDefault();
        $('.modal_confirm').hide();
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('.modal_confirm').hide();
        let id = $(this).data('id');
        let method = $(this).data('method');
        let ppdb_bersyarat = ($(".ppdb_bersyarat").prop("checked") ? 'Bersyarat' : 'Lulus');
        let tabel = '<?= (url(6) == '' ? 'Bus' : url(6)); ?>';

        post('<?= url(); ?>/' + method, {
                id,
                ppdb_bersyarat,
                tabel
            })
            .then(res => {
                if (res.status == '200') {
                    sukses();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                } else {
                    gagal(res.message);
                }

            })


    });

    $(document).on('click', '.modal_cari_db', function(e) {
        e.preventDefault();
        let myModal = document.getElementById('body_modal_cari_db');

        // let tabels = ['karyawan', 'recruitment', 'santri', 'ppdb'];

        let id = $(this).data('id');
        let order = $(this).data('order');
        let ekstra = $(this).data('ekstra');


        let html = '<input data-id="' + id + '" data-order="' + order + '" data-ekstra="' + ekstra + '" type="text" style="font-size: small;" class="form-control cari_db" placeholder="Cari nama..." autofocus>';

        // let html2 = '';

        // for (let i = 0; i < tabels.length; i++) {
        //     html2 += '<div class="form-check form-check-inline" style="font-size:12px;">';
        //     html2 += '<input class="form-check-input" type="radio" name="tabel_db" value="' + tabels[i] + '">';
        //     html2 += '<label class="form-check-label">' + upper_first(tabels[i]) + '</label>';
        //     html2 += '</div>';

        // }


        // if ('' !== 'sk') {
        //     $('.body_tabel_api').html(html2);
        // }
        $('.body_modal_cari_db').html(html);

        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();

    });




    $(document).on('keyup', '.cari_db', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let ekstra = $(this).data('ekstra');
        let col = 'nama';
        let text = $(this).val();
        let tahun = '<?= url(4); ?>';
        let kategori = '<?= url(7); ?>';

        let controller = '<?= url(); ?>';

        let order = $('.filter_by').val();

        if (controller == 'piagam') {
            order = $(this).data('order');
        }
        if (controller == 'nilai' || controller == 'calon') {
            order = 'santri';
        }
        if (controller == 'pemilih') {
            if (tahun == 'All') {
                gagal('Tahun tidak boleh All');
                return false;
            }
            if (kategori == 'All') {
                gagal('Kategori tidak boleh All');
                return false;
            }

            if (kategori == 'Santri') {
                order = 'Santri';
            } else {
                order = 'Karyawan';
            }
        }

        let tabel_db = (controller == 'sk' || controller == 'piagam' ? 'karyawan' : order.toLowerCase());

        post("search_by_text", {
            tabel_db,
            col,
            text,
            ekstra,
            tahun,
            kategori
        }).then((res) => {
            if (res.status == '200') {
                hasil_cari_db(tabel_db, col, res.data, order, id, controller, ekstra, tahun, kategori);

            } else {
                gagal(res.message);
            }

        });
    });

    const clear_nama = (order, id) => {
        console.log('.' + order + '_body_search_nama' + (order == 'update' ? '_' + id : ''));
        $('.' + order + '_body_search_nama' + (order == 'update' ? '_' + id : '')).html('');
        $('.' + order + '_body_search_nama' + (order == 'update' ? '_' + id : '')).addClass('d-none');
        $('.' + order + '_body_search_nama' + (order == 'update' ? '_' + id : '')).removeClass('d-block');
    }
    const show_nama = (order, id, html) => {
        $('.' + order + '_body_search_nama' + (order == 'update' ? '_' + id : '')).html(html);
        $('.' + order + '_body_search_nama' + (order == 'update' ? '_' + id : '')).addClass('d-block');
        $('.' + order + '_body_search_nama' + (order == 'update' ? '_' + id : '')).removeClass('d-none');
    }

    const hasil_cari_db = (tabel_db, col, data, order, id, controller, ekstra, tahun, kategori) => {
        let html = '';

        if (controller == 'piagam') {
            let html = '';

            html += '<li class="text-center text-dark" style="border-bottom:1px solid black;"><a class="dropdown-item clear_search_nama" data-id="' + id + '" data-order="' + order + '" href="#"><i class="fa-solid fa-xmark"></i> Cancel</a></li>'
            if (data.length == 0) {
                html += '<li class="text-danger" style="font-style:italic;"><i class="fa-solid fa-circle-exclamation"></i> Data tidak ditemukan!</li>';
            } else {
                for (let d = 0; d < data.length; d++) {
                    html += '<li><a class="dropdown-item insert_hasil_cari_db" data-no_id="' + data[d].no_id + '" data-id="' + id + '" data-order="' + order + '" href="#">' + data[d].nama + '</a></li>';
                };
            }

            show_nama(order, id, html);

        } else {
            if (data.length == 0) {
                html += '<button style="font-size: small;" type="button" class="list-group-item list-group-item-action"><i class="fa-solid fa-triangle-exclamation text-danger"></i> Data tidak ditemukan!.</button>';

            } else {
                for (let i = 0; i < data.length; i++) {
                    html += '<button style="font-size: small;" data-tahun="' + tahun + '" data-kategori="' + kategori + '" type="button" data-id="' + data[i].no_id + '" data-order="' + order + '" data-ekstra="' + ekstra + '" data-tabel_db="' + tabel_db + '" data-no_id="' + data[i].no_id + '" data-nama="' + data[i].nama + '" class="list-group-item list-group-item-action insert_hasil_cari_db">' + data[i][col] + '</button>';
                }
            }
            $('.body_hasil_cari_db').html(html);

        }
    }



    $(document).on('click', '.insert_hasil_cari_db', function(e) {
        e.preventDefault();
        let no_id = $(this).data('no_id');
        let kategori = $(this).data('kategori');
        let id = $(this).data('id');
        let order = $(this).data('order');
        let nama = $(this).text();
        let tabel_db = $(this).data('tabel_db');
        let ekstra = $(this).data('ekstra');
        let tahun = $('.filter_by_tahun').val();
        let controller = '<?= url(); ?>';

        if (controller == 'nilai') {
            tahun = '<?= url(4); ?>';
        }
        if (controller == 'pemilih') {
            tahun = $(this).data('tahun');
        }

        if (controller == 'piagam') {
            $('.' + order + '_nama' + (order == 'update' ? '_' + id : '')).val(nama);
            $('.' + order + '_no_id' + (order == 'update' ? '_' + id : '')).html('<input type="hidden" name="no_id" value="' + no_id + '">');

            clear_nama(order, id);

        } else {
            post("add_data_from_db", {
                no_id,
                id,
                tabel_db,
                tahun,
                controller,
                kategori,
                ekstra
            }).then((res) => {
                if (res.status == '200') {

                    sukses();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);


                } else {
                    gagal(res.message);
                }
            })

        }
    });


    $(document).on('click', '.clear_search_nama', function(e) {
        e.preventDefault();
        let order = $(this).data('order');
        let id = $(this).data('id');
        clear_nama(order, id);
    })


    // menu ----------------------------------------------------------------------------------------------------
    $(document).on('change', '.filter_by', function(e) {
        e.preventDefault();
        let val = $(this).val();
        <?php if (url() == 'karyawan' || url() == 'recruitment') : ?>
            location.href = "<?= base_url(menu()['controller']); ?>" + '/' + val + '/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>';
        <?php elseif (url() == 'santri' || url() == 'ppdb') : ?>
            location.href = "<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/" + val + "/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>/<?= url(11); ?>";
        <?php else : ?>
            location.href = "<?= base_url(menu()['controller']); ?>" + '/' + val
        <?php endif; ?>
    });

    $(document).on('click', '.copy_menu', function(e) {
        e.preventDefault();
        let sections = <?= json_encode(options('Section')); ?>;
        let role = <?= json_encode(options('role')); ?>;
        let html = '';
        let id = $(this).data('id');

        html += '<form action="<?= base_url(menu()['controller']); ?>/copy" method="post">';
        html += '<input type="hidden" name="id" value="' + id + '">';
        html += '<input type="hidden" name="section_now" value="<?= url(4); ?>">';
        html += '<div class="d-flex">';
        html += '<div class="p-2 w-100">';
        html += '<div class="d-flex gap-2">';
        html += '<select class="form-select form-select-sm" name="section">';
        html += '<option>Sections</option>';
        for (let i = 0; i < sections.length; i++) {
            html += '<option value="' + sections[i].value + '">' + sections[i].value + '</option>';
        }
        html += '</select>';
        html += '<select class="form-select form-select-sm" name="role">';
        html += '<option>Roles</option>';
        for (let i = 0; i < role.length; i++) {
            html += '<option value="' + role[i].value + '">' + role[i].value + '</option>';
        }
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="p-2 flex-shrink-1">';
        html += '<button type="submit" href="" class="btn-sm btn_main" style="font-size:15px;"><i class="fa-regular fa-floppy-disk"></i></button>';
        html += '</div>';
        html += '</div>';
        html += '</form>';
        $('.body_modal_copy_menu').html(html);

        let myModal = document.getElementById('copy_menu');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();
    });

    $(document).on('click', '.copy_menu', function(e) {
        e.preventDefault();
        let sections = <?= json_encode(options('Section')); ?>;
        let role = <?= json_encode(options('role')); ?>;
        let html = '';
        let id = $(this).data('id');

        html += '<form action="<?= base_url(menu()['controller']); ?>/copy" method="post">';
        html += '<input type="hidden" name="id" value="' + id + '">';
        html += '<input type="hidden" name="section_now" value="<?= url(4); ?>">';
        html += '<div class="d-flex">';
        html += '<div class="p-2 w-100">';
        html += '<div class="d-flex gap-2">';
        html += '<select class="form-select form-select-sm" name="section">';
        html += '<option>Sections</option>';
        for (let i = 0; i < sections.length; i++) {
            html += '<option value="' + sections[i].value + '">' + sections[i].value + '</option>';
        }
        html += '</select>';
        html += '<select class="form-select form-select-sm" name="role">';
        html += '<option>Roles</option>';
        for (let i = 0; i < role.length; i++) {
            html += '<option value="' + role[i].value + '">' + role[i].value + '</option>';
        }
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="p-2 flex-shrink-1">';
        html += '<button type="submit" href="" class="btn-sm btn_main" style="font-size:15px;"><i class="fa-regular fa-floppy-disk"></i></button>';
        html += '</div>';
        html += '</div>';
        html += '</form>';
        $('.body_modal_copy_menu').html(html);

        let myModal = document.getElementById('copy_menu');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();
    });



    // karyawan
    $(document).on('change', '.filter_by_status', function(e) {
        e.preventDefault();
        let val = $(this).val();
        <?php if (url() == 'karyawan' || url() == 'recruitment') : ?>
            location.href = "<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/" + val + "/<?= url(10); ?>";
        <?php elseif (url() == 'santri' || url() == 'ppdb') : ?>
            location.href = "<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/" + val + "/<?= url(11); ?>";
        <?php endif; ?>
    });

    // santri
    $(document).on('change', '.filter_by_tahun', function(e) {
        e.preventDefault();
        let val = $(this).val();
        <?php if (url() == 'santri' || url() == 'ppdb') : ?>
            location.href = "<?= base_url(menu()['controller']); ?>/" + val + "/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>/<?= url(8); ?>/<?= url(9); ?>/<?= url(10); ?>/<?= url(11); ?>";
        <?php elseif (url() == 'sk') : ?>
            location.href = "<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/" + val + "/<?= url(6); ?>/<?= url(7); ?>";
        <?php endif; ?>
    });

    // sk
    $(document).on('change', '.filter_by_sub', function(e) {
        e.preventDefault();
        let val = $(this).val();
        location.href = "<?= base_url(menu()['controller']); ?>/" + val + "/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>";
    });

    // cetak check
    $(document).on('change', '.cetak_check', function(e) {
        e.preventDefault();

        let x = 0;
        $('input[name="cetak_check"]:checked').each(function() {
            x++;
        });

        if (x == 0) {
            $('.print_sk_by_check').addClass('d-none');
        } else {
            $('.print_sk_by_check').removeClass('d-none');
        }

    });

    $(document).on('click', '.check_all', function(e) {
        e.preventDefault();
        if ($(this).hasClass('btn_main_inactive')) {
            $('input[name="cetak_check"]').prop('checked', true);
            $(this).removeClass('btn_main_inactive');
            $(this).addClass('btn_main');
        } else {
            $('input[name="cetak_check"]').prop('checked', false);
            $(this).addClass('btn_main_inactive');
            $(this).removeClass('btn_main');
            $('.print_sk_by_check').addClass('d-none');
        }

    });
    $(document).on('click', '.cetak', function(e) {
        e.preventDefault();
        let controller = $(this).data('controller');
        let order = $(this).data('order');
        let id = $(this).data('id');
        let ttd = ($('.ttd').prop('checked') == true ? 2 : 1);

        let data = [];

        if (controller == 'dtl') {
            data.push(id);
            order = 'detail' + order;
        } else {
            if (order == 'single') {
                data.push(id);
            } else {
                $('input[name="cetak_check"]:checked').each(function() {
                    data.push(this.value);
                });
            }

        }
        if (controller == undefined) {
            controller = '<?= url(); ?>'
        }


        post("encode", {
            data,
            ttd
        }).then((res) => {
            if (res.status == '200') {
                if (controller == 'sk' || controller == 'piagam') {
                    window.open('<?= base_url(); ?><?= menu()['controller']; ?>/cetak/' + order + '/' + ttd + '/' + res.data, '_blank');
                } else if (controller == 'nilai') {
                    window.open('<?= base_url(); ?>ekstra/cetak/' + order + '/' + res.data, '_blank');
                } else {
                    window.open('<?= base_url(); ?><?= menu()['controller']; ?>/cetak/' + order + '/' + res.data, '_blank');
                }
            } else {
                gagal(res.message);
            }
        })
    });



    // copy
    $(document).on('click', '.copy_sk', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let controller = "<?= menu()['controller']; ?>";

        let html = '';
        if (controller == 'sk') {
            html += '<form method="post" action="<?= base_url('sk'); ?>/copy">';
            html += '<input type="hidden" name="controller" value="' + controller + '">';
            html += '<input type="hidden" name="url" value="<?= base_url(menu()['controller']); ?>/<?= url(4); ?>/<?= url(5); ?>/<?= url(6); ?>/<?= url(7); ?>">';
            html += '<input type="hidden" name="id" value="' + id + '">';
            html += '<div class="form-floating mb-3">';
            html += '<input type="number" name="tahun" class="form-control" placeholder="tahun">';
            html += '<label>Tahun</label>';
            html += '</div>';
            html += '<div class="d-grid">';
            html += '<button class="btn_main" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>';
            html += '</div>';
            html += '</form>';
        }

        $('.body_copy').html(html);
        let myModal = document.getElementById('copy');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();

    });

    $(document).on('click', '.panduan', function(e) {
        e.preventDefault();

        post("panduan", {
            id: 0
        }).then((res) => {
            if (res.status == '200') {
                sukses();
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                gagal(res.message);
            }
        })
    });



    // kop

    $(document).on('click', '.kop', function(e) {
        e.preventDefault();
        let order = $(this).data('order');
        let id = $(this).data('id');

        let data = ['2006.jpg', '2013.jpg', '2021.jpg'];

        let html = "";
        html += '<div class="card shadow shadow-sm" style="width:100%;">';
        html += '<div class="card-body">';
        for (let i = 0; i < data.length; i++) {
            html += '<div class="mb-2 border-top" style="border-top:5px;"><a href="" class="insert_kop" ' + (order == 'add' ? "" : 'data-id="' + id + '"') + ' data-order="' + order + '" data-value="' + data[i] + '"><img style="width:100%;" src="<?= base_url(); ?>berkas/kop/' + data[i] + '"></a></div>';
        }
        html += '<div class="d-grid">';
        html += '<button type="button" class="btn_main_inactive cancel_kop"><i class="fa-solid fa-ban"></i> Cancel</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        console.log((order == 'add' ? order : order + '_' + id));
        $('.body_kop_' + (order == 'add' ? order : order + '_' + id)).html(html);

    });
    $(document).on('click', '.cancel_kop', function(e) {
        e.preventDefault();
        $('.body_kop').html('');
    });
    $(document).on('click', '.insert_kop', function(e) {
        e.preventDefault();
        let value = $(this).data('value');
        let order = $(this).data('order');
        let id = $(this).data('id');
        if (order == 'add') {
            $('.' + order + '_kop').val(value);
        } else if (order == 'update') {
            $('.' + order + '_kop_' + id).val(value);
        } else {
            let html = '';
            html += '<a data-order="' + order + '" data-id="' + id + '" class="kop" href="">' + value + '</a>';
            html += '<div class="modal-body position-absolute top-50 start-50 translate-middle body_kop_' + order + '_' + id + ' body_kop" style="z-index: 999;">';
            html += '</div>';
            $('.update_' + order + '_kop_' + id).html(html);
        }
        $('.body_kop').html('');
    });

    $(document).on('click', '.update_tahun', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let tahun = $('.update_tahun_tahun_' + id).text();
        let rapat = $('.update_tahun_rapat_' + id).text();
        let penetapan = $('.update_tahun_penetapan_' + id).text();
        let ketua_ypp = $('.update_tahun_ketua_ypp_' + id).text();
        let kop = $('.update_tahun_kop_' + id).text();

        post("tahun/update", {
            id,
            tahun,
            rapat,
            penetapan,
            ketua_ypp,
            kop
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                gagal(res.message);
            }

        });

    });

    // piagam
    $(document).on('blur', '.update', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let col = $(this).data('col');
        let db = $(this).data('db');
        let tabel = $(this).data('tabel');
        let val = $(this).text();
        let controller = '<?= url(); ?>';

        post(controller + "/update_blur", {
            id,
            col,
            db,
            tabel,
            val
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
                if (controller == 'jariyah') {
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            } else {
                gagal(res.message);
            }

        });

    });

    // jariyah
    $(document).on('blur', '.add', function(e) {
        e.preventDefault();
        let col = $(this).data('col');
        let key = $(this).data('key');
        let tabel = $(this).data('tabel');
        let db = $(this).data('db');
        let val = $(this).text();
        let controller = '<?= url(); ?>';

        if (val == '') {
            return false;
        }

        post(controller + "/add_blur", {
            col,
            key,
            tabel,
            db,
            val
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                gagal(res.message);
            }

        });

    });
    // nilai ekstra
    $(document).on('click', '.detail', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let controller = '<?= url(); ?>';


        post(controller + "/detail_js", {
            id
        }).then((res) => {
            if (res.status == '200') {

                let html = '';
                for (let i = 0; i < res.data.length; i++) {
                    html += '<div class="form-floating mb-2">';
                    html += '<input type="number" class="form-control update_nilai" data-id="' + res.data[i].id + '" value="' + res.data[i].nilai + '" name="nilai" placeholder="' + res.data[i].mapel + '" required>';
                    html += '<label>' + res.data[i].mapel + '</label>';
                    html += '</div>';
                }
                $('.body_detail').html(html);
                let myModal = document.getElementById('detail');
                let modal = bootstrap.Modal.getOrCreateInstance(myModal)
                modal.show()
            } else {
                gagal(res.message);
            }

        });

    });

    // ekstra
    $(document).on('blur', '.update_nilai', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let val = $(this).val();
        let controller = '<?= url(); ?>';


        post(controller + "/update_nilai", {
            id,
            val
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
            } else {
                gagal(res.message);
            }

        });

    });
    // update_ket pilangsari
    $(document).on('change', '.update_pilangsari', function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        $('.label_ket_' + id).text(($(this).prop("checked") ? 'Lunas' : 'Belum'));

        post("pilangsari/update_ket", {
            id
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
            } else {
                gagal(res.message);
            }

        });

    });

    // laporan
    $(document).on('click', '.laporan', function(e) {
        e.preventDefault();

        let myModal = document.getElementById('laporan');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal);

        post("pilangsari/laporan", {
            id: ''
        }).then((res) => {
            console.log(res.data);
            if (res.status == '200') {
                let html = '';

                let jenis = ['SSJ', 'NONSSJ', 'Kosong'];

                for (let j = 0; j < jenis.length; j++) {
                    html += '<div class="btn_main">' + jenis[j] + '</div>';
                    html += '<table class="table table-sm table-striped">';
                    html += '<thead>';
                    html += '<tr>';
                    html += '<th scope="col" style="text-align:center;">#</th>';
                    html += '<th scope="col" style="text-align:center;">Kategori</th>';
                    if (jenis[j] == 'SSJ') {
                        html += '<th scope="col" style="text-align:center;">Belum</th>';
                        html += '<th scope="col" style="text-align:center;">Belum (Rp)</th>';
                        html += '<th scope="col" style="text-align:center;">Lunas</th>';
                        html += '<th scope="col" style="text-align:center;">Lunas (Rp)</th>';

                    } else {
                        html += '<th scope="col" style="text-align:center;">Jumlah</th>';
                        html += '<th scope="col" style="text-align:center;">Total</th>';

                    }
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';


                    let total = 0;
                    let jml = 0;
                    let jml_belum = 0;
                    let jml_belum_rp = 0;
                    let jml_lunas = 0;
                    let jml_lunas_rp = 0;

                    for (let i = 0; i < res.data.length; i++) {

                        if (res.data[i].jenis == jenis[j]) {
                            total += res.data[i].total;
                            jml += res.data[i].jumlah;
                            html += '<tr>';
                            html += '<th scope="row">' + (i + 1) + '</th>';
                            html += '<td>' + res.data[i].kategori + '</td>';
                            if (jenis[j] == 'SSJ') {
                                jml_belum += res.data[i].jml_belum;
                                jml_belum_rp += (res.data[i].jml_belum * 350000);
                                jml_lunas += res.data[i].jml_lunas;
                                jml_lunas_rp += (res.data[i].jml_lunas * 350000);
                                html += '<td style="text-align:right;">' + res.data[i].jml_belum + '</td>';
                                let blm = res.data[i].jml_belum * 350000;
                                html += '<td style="text-align:right;">' + rupiah(blm.toString()) + '</td>';
                                html += '<td style="text-align:right;">' + res.data[i].jml_lunas + '</td>';
                                let lns = res.data[i].jml_lunas * 350000
                                html += '<td style="text-align:right;">' + rupiah(lns.toString()) + '</td>';

                            } else {
                                html += '<td style="text-align:right;">' + res.data[i].jumlah + '</td>';
                                html += '<td style="text-align:right;">' + res.data[i].total_rp + '</td>';

                            }
                            html += '</tr>';
                        }
                    }


                    if (jenis[j] == 'SSJ') {
                        html += '<tr>';
                        html += '<td colspan="2" style="font-weight:bold;">TOTAL</td>';
                        html += '<td style="text-align:right;font-weight:bold;">' + jml_belum + '</td>';
                        html += '<td style="text-align:right;font-weight:bold;">' + rupiah(jml_belum_rp.toString()) + '</td>';
                        html += '<td style="text-align:right;font-weight:bold;">' + jml_lunas + '</td>';
                        html += '<td style="text-align:right;font-weight:bold;">' + rupiah(jml_lunas_rp.toString()) + '</td>';
                        html += '</tr>';
                    } else {

                        html += '<tr><td colspan="2" style="font-weight:bold;">TOTAL</td><td style="text-align:right;font-weight:bold;"></td><td style="text-align:right;font-weight:bold;">' + rupiah(total.toString()) + '</td></tr>';
                    }

                    html += '</tbody>';
                    html += '</table>';

                }


                $('.body_laporan').html(html);
                modal.show()
            } else {
                gagal(res.message);
            }

        });


    });

    $(document).on('change', '.update_kategori', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let val = $(this).val();

        post("pilangsari/update_kategori", {
            id,
            val
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                gagal(res.message);
            }

        });

    });

    // update checkbox
    $(document).on('change', '.update_checkbox', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let col = $(this).data('col');
        let tabel = $(this).data('tabel');
        let db = $(this).data('db');
        let controller = '<?= url(); ?>';

        post("/update_checkbox", {
            id,
            col,
            tabel,
            db
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                gagal(res.message);
            }

        });

    });

    // pemilu

    $(document).on('click', '.confirm_vote', function(e) {
        e.preventDefault();
        let message = $(this).data('message');
        let id_calon = $(this).data('id_calon');
        let id_pemilih = $(this).data('id_pemilih');
        let url = $(this).data('url');

        if (message == '' || id_calon == '' || id_pemilih == '' || url == '') {
            gagal('Gagal!. Ada data yang kosong.');

            return false;
        }

        let html = '';
        html += '<h6 class="text-center"><i class="fa-solid fa-triangle-exclamation text-danger"></i> ' + message + '</h6>';
        html += '<hr>';
        html += '<div class="d-flex justify-content-center gap-2">';
        html += '<button data-bs-dismiss="modal" aria-label="Close" type="button" class="btn-sm btn_main_inactive"><i class="fa-solid fa-xmark"></i> Cancel</button>';
        html += '<form action="<?= base_url(); ?>vote" method="post">';
        html += '<input type="hidden" name="url" value="' + url + '">';
        html += '<input type="hidden" name="id_calon" value="' + id_calon + '">';
        html += '<input type="hidden" name="id_pemilih" value="' + id_pemilih + '">';
        html += '<button type="submit" class="btn-sm btn_main"><i class="fa-regular fa-circle-check"></i> Yakin</button>';
        html += '</form>';
        html += '</div>'
        $('.body_confirm_vote').html(html);

        let myModal = document.getElementById('confirm_vote');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show();
    });


    $(document).on('click', '.confirm_delete_file', function(e) {
        e.preventDefault();

        let i = $(this).data('i');

        $('.message_confirm_' + i).removeClass('d-none');

    });
    $(document).on('click', '.cancel_delete_file', function(e) {
        e.preventDefault();
        let i = $(this).data('i');

        $('.message_confirm_' + i).addClass('d-none');

    });
    $(document).on('click', '.delete_file', function(e) {
        e.preventDefault();
        let i = $(this).data('i');
        let dir = $(this).data('dir');

        post("<?= url(); ?>/delete_file", {
            dir
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                gagal(res.message);
            }

        });


    });

    // auth url
    $(document).on('click', '.auth_url', function(e) {
        e.preventDefault();

        let tabel = $(this).data('tabel');
        let id = $(this).data('id');
        let section = $(this).data('section');
        let gender = $(this).data('gender');
        let nama = $(this).data('nama');
        let role = $(this).data('role');
        let no = $(this).data('no');
        post("auth_url", {
            tabel,
            id,
            section,
            gender,
            nama,
            role,
            info: ''
        }).then((res) => {
            if (res.status == '200') {
                let html = '<div>' + res.data + ' <a href="" data-no="' + no + '" data-nama="' + nama + '" data-link="' + res.data + '" class="btn_send_wa_with_link"><i class="fa-brands fa-whatsapp"></i></a></div>';
                $('.body_auth_url').html(html);
                let myModal = document.getElementById('modal_auth_url');
                let modal = bootstrap.Modal.getOrCreateInstance(myModal)
                modal.show();

            } else {
                gagal(res.message);
            }

        });


    });


    $(document).on('click', '.btn_send_wa_with_link', function(e) {
        e.preventDefault();

        let link = $(this).data('link');
        let nama = $(this).data('nama');
        let no = $(this).data('no');

        let text = 'Assalamualaikum wr.wb%0a';
        text += 'Yth: ' + nama + '%0a%0a';
        text += 'Silahkan kunjungi link di bawah ini:%0a%0a';
        text += link;
        text += '%0a%0aKemudian isi seluruh data dengan lengkap!.%0a';
        text += '*KAMI HANYA MEMPROSES DATA YANG SUDAH DIISI LENGKAP!.*%0a';
        text += '%0aJika Menggunakan HP:';
        text += '%0aKlik icon menu di pojok kanan atas lalu klik profile lalu isi semua data!!.%0a';
        text += '%0aNB:%0a';
        text += '*_JANGAN BAGIKAN LINK TERSEBUT KEPADA SIAPAPUN!_*%0a';
        text += '%0a%0a%0aTTD%0a%0a';
        text += 'PANITIA';

        window.location.href = 'whatsapp://send/?phone=' + no + '&text=' + text; //Will take you to Google.

    })



    $(document).on('change', '.change_status', function(e) {
        e.preventDefault();
        let tabel = $(this).data('tabel');
        let id = $(this).data('id');
        let col = $(this).data('col');
        let val = $(this).val();

        post("change_status", {
            tabel,
            id,
            val,
            col
        }).then((res) => {
            if (res.status == '200') {
                sukses(res.message);
            } else {
                gagal(res.message);
            }

        });


    });

    // ppdb

    $(document).on('click', '.cetak_kuitansi_ppdb', function(e) {
        e.preventDefault();
        let url = $(this).data('url');
        let no_id = $(this).data('no_id');
        let data = {
            url,
            no_id
        };
        post("encode", {
            data
        }).then((res) => {
            if (res.status == '200') {
                window.open('<?= base_url('public/ppdb/kuitansi/'); ?>' + res.data, '_blank');
            } else {
                gagal(res.message);
            }
        })
    })
    $(document).on('click', '.pembagian_ruang_seleksi_ppdb', function(e) {
        e.preventDefault();
        let tahun = $(this).data('tahun');

        post("ppdb/pembagian_ruang_seleksi_ppdb", {
            tahun
        }).then((res) => {
            if (res.status == '200') {

                let html = '';
                for (let i = 0; i < res.data.length; i++) {
                    let data = res.data[i];
                    html += '<tr class="row_' + i + '">';
                    html += '<th scope="row">' + (i + 1) + '</th>';
                    html += '<td>' + data.no_id + '</td>';
                    html += '<td>' + data.nama + '</td>';
                    html += '<td>' + data.sub + '</td>';
                    // html += '<td>' + (data.kabupaten !== '' && data.kecamatan !== '' ? data.kecamatan + '/' + data.kabupaten : (data.kabupaten !== '' ? data.kabupaten : (data.kecamatan !== '' ? data.kecamatan : '-'))) + '</td>';
                    html += '<td><a data-index="' + i + '" style="font-size:medium" data-no_id="' + data.no_id + '" data-nama="' + data.nama + '" data-sub="' + data.sub + '" data-daerah="' + (data.kabupaten !== '' && data.kecamatan !== '' ? data.kecamatan + '/' + data.kabupaten : (data.kabupaten !== '' ? data.kabupaten : (data.kecamatan !== '' ? data.kecamatan : '-'))) + '" href="" class="masukkan_data_pembagian_ruang"><i class="fa-solid fa-circle-arrow-up"></i></a></td>';
                    html += '</tr>';
                }
                $('.body_pembagian_ruang').html(html);

                let html_penguji = '';
                for (let x = 0; x < res.data2.length; x++) {
                    let datax = res.data2[x];
                    html_penguji += '<a href="#" data-tahun="<?= url(4); ?>" class="list-group-item list-group-item-action btn_canvas_penguji" data-penguji="' + datax.penguji + '">' + datax.penguji + '</a>';
                }
                $('.canvas_body_penguji').html(html_penguji);

                let myModal = document.getElementById('modal_pembagian_ruang');
                let modal = bootstrap.Modal.getOrCreateInstance(myModal)
                modal.show();
            } else {
                gagal(res.message);
            }
        })
    })

    // $(document).on('keyup', '.cari_nama_pembagian_ruang', function(e) {
    //     e.preventDefault();

    //     let value = $(this).val().toLowerCase();

    //     $('.body_pembagian_ruang tr').filter(function() {
    //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    //     });

    // });
    $(document).on('click', '.masukkan_data_pembagian_ruang', function(e) {
        e.preventDefault();

        let exist = $('.name_listed').length;
        let no_id = $(this).data('no_id');
        let nama = $(this).data('nama');
        let sub = $(this).data('sub');
        let daerah = $(this).data('daerah');
        let idx = $(this).data('index');

        let datas = [];
        $('.name_listed').each(function() {
            let index = $(this).data('index');
            let no_id_exist = $('.no_id_' + index).text();
            if (no_id == no_id_exist) {
                let html = '';
                html += '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                html += '<strong>Nama sudah ada!.</strong>';
                html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                html += '</div>';
                $('.warning_pembagian_kamar').html(html);
                return false;
            } else {
                datas.push({
                    nama: $('.nama_' + index).text(),
                    no_id: no_id_exist,
                    sub: $('.sub_' + index).text()
                });

            }
        })

        datas.push({
            no_id,
            nama,
            sub
        })

        let html = '';
        html += '<table class="table">';
        html += '<tbody>';
        for (let i = 0; i < datas.length; i++) {
            html += '<tr class="name_listed row_name_listed_' + i + '" data-index="' + i + '">';
            html += '<td>' + (i + 1) + '</td>';
            html += '<td class="no_id_' + i + '">' + datas[i].no_id + '</td>';
            html += '<td class="nama_' + i + '">' + datas[i].nama + '</td>';
            html += '<td class="sub_' + i + '">' + datas[i].sub + '</td>';
            html += '<td><a data-index="' + i + '" class="del_list_pembagian_kamar" href="" data-idx="' + idx + '"><i class="fa-solid fa-xmark text-danger"></i></a></td>';
            html += '</tr>';
        }

        html += '</tbody>';
        html += '</table>';

        html += '<div class="d-grid mb-2">';
        html += '<button data-count="' + datas.length + '" class="btn_main save_pembagian_ruang">Save</button>';
        html += '</div>';

        $('.body_name_listed').html(html);

        $('.row_' + idx).hide();

    });

    $(document).on('click', '.del_list_pembagian_kamar', function(e) {
        e.preventDefault();

        let idx = $(this).data('idx');
        let index = $(this).data('index');

        $('.row_' + idx).show();
        $('.row_name_listed_' + index).remove();

    });
    $(document).on('click', '.btn_canvas_penguji', function(e) {
        e.preventDefault();
        let penguji = $(this).data('penguji');
        let tahun = $(this).data('tahun');
        if (tahun == 'All') {
            gagal('Tahun tidak boleh All!.');
            return false;
        }
        post("ppdb/daftar_capel_by_penguji", {
            tahun,
            penguji
        }).then((res) => {
            if (res.status == '200') {

                let html = '';
                html += '<div style="font-size:large;font-weight:bold;">Penguji: ' + penguji + '</div>';
                html += '<div style="font-size:medium;">Daftar Calon Santri Ruang ' + res.data[0].ruang + '</div>';
                html += '<table class="table tabel_daftar_capel">';
                for (let i = 0; i < res.data.length; i++) {
                    let data = res.data[i];
                    html += '<tr class="row_' + i + '">';
                    html += '<th scope="row">' + (i + 1) + '</th>';
                    html += '<td>' + data.no_id + '</td>';
                    html += '<td>' + data.nama + '</td>';
                    html += '<td>' + data.sub + '</td>';
                    html += '<td><a style="font-size:medium" data-id="' + data.id + '" href="" data-penguji="' + penguji + '" class="del_daftar_capel"><i class="fa-solid fa-trash text-danger"></i></a></td>';
                    html += '</tr>';
                }
                html += '</table>';

                html += '<div class="d-grid mt-2">';
                html += '<button data-penguji="' + penguji + '" data-ruang="' + res.data[0].ruang + '" class="btn_bright_sm tambah_data_peserta_seleksi py-1"><i class="fa-solid fa-square-plus"></i> Tambah Data</button>'
                html += '</div>';

                $('.btn_canvas_penguji').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');

                $('.canvas_body_daftar_capel_by_penguji').html(html);

                let canvas = document.getElementById('offcanvasPenguji');
                let myCanvas = new bootstrap.Offcanvas(canvas);
                myCanvas.show();




            } else {
                gagal(res.message);
            }
        })


    });
    $(document).on('click', '.save_pembagian_ruang', function(e) {
        e.preventDefault();
        let ruang = $('.ruang').val();
        let penguji = $('.penguji').val();
        let tahun = "<?= url(4); ?>";
        let count = $(this).data('count');

        if (count == 0) {
            gagal('Daftar masih kosong!.');
            return false;
        }
        if (ruang == '') {
            gagal('Ruang harus diisi!.');
            return false;
        }
        if (penguji == '') {
            gagal('Penguji harus diisi!.');
            return false;
        }
        if (tahun == 'All') {
            gagal('Tahun tidak boleh All!.');
            return false;
        }
        let datas = [];


        for (let i = 0; i < count; i++) {

            let no_id = $('.no_id_' + i).text();

            let nama = $('.nama_' + i).text();
            let sub = $('.sub_' + i).text();
            datas.push({
                no_id,
                nama,
                sub
            });
        }

        post("ppdb/save_pembagian_ruang", {
            tahun,
            penguji,
            ruang,
            datas
        }).then((res) => {
            if (res.status == '200') {
                location.reload();

            } else {
                gagal(res.message);
            }
        })


    });
    $(document).on('click', '.del_daftar_capel', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let penguji = $(this).data('penguji');
        let tahun = "<?= url(4); ?>";

        post("ppdb/del_daftar_capel", {
            id,
            penguji,
            tahun
        }).then((res) => {
            if (res.status == '200') {
                let html = "";
                html += '<tbody>';
                for (let i = 0; i < res.data.length; i++) {
                    let data = res.data[i];
                    html += '<tr class="row_' + i + '">';
                    html += '<th scope="row">' + (i + 1) + '</th>';
                    html += '<td>' + data.no_id + '</td>';
                    html += '<td>' + data.nama + '</td>';
                    html += '<td>' + data.sub + '</td>';
                    html += '<td><a style="font-size:medium" data-id="' + data.id + '" data-penguji="' + penguji + '" href="" class="del_daftar_capel"><i class="fa-solid fa-trash text-danger"></i></a></td>';
                    html += '</tr>';
                }
                html += '</tbody>';
                $('.tabel_daftar_capel').html(html);

                let html2 = '';
                for (let i = 0; i < res.data2.length; i++) {
                    let data = res.data2[i];
                    html2 += '<tr class="row_' + i + '">';
                    html2 += '<th scope="row">' + (i + 1) + '</th>';
                    html2 += '<td>' + data.no_id + '</td>';
                    html2 += '<td>' + data.nama + '</td>';
                    html2 += '<td>' + data.sub + '</td>';
                    // html2 += '<td>' + (data.kabupaten !== '' && data.kecamatan !== '' ? data.kecamatan + '/' + data.kabupaten : (data.kabupaten !== '' ? data.kabupaten : (data.kecamatan !== '' ? data.kecamatan : '-'))) + '</td>';
                    html2 += '<td><a data-index="' + i + '" style="font-size:medium" data-no_id="' + data.no_id + '" data-nama="' + data.nama + '" data-sub="' + data.sub + '" data-daerah="' + (data.kabupaten !== '' && data.kecamatan !== '' ? data.kecamatan + '/' + data.kabupaten : (data.kabupaten !== '' ? data.kabupaten : (data.kecamatan !== '' ? data.kecamatan : '-'))) + '" href="" class="masukkan_data_pembagian_ruang"><i class="fa-solid fa-circle-arrow-up"></i></a></td>';
                    html2 += '</tr>';
                }
                $('.body_pembagian_ruang').html(html2);

            } else {
                gagal(res.message);
            }
        })


    });
    $(document).on('click', '.tambah_data_peserta_seleksi', function(e) {
        e.preventDefault();
        let ruang = $(this).data('ruang');
        let penguji = $(this).data('penguji');

        $('.ruang').val(ruang);
        $('.penguji').val(penguji);

        const myOffcanvas = document.getElementById('offcanvasPenguji')
        myOffcanvas.addEventListener('hidden.bs.offcanvas', event => {
            // do something...
        })

        // const bsOffcanvas = new bootstrap.Offcanvas('#offcanvasPenguji');
        let myCanvas = document.getElementById('offcanvasPenguji');
        let canvas = bootstrap.Offcanvas.getOrCreateInstance(myCanvas)
        canvas.hide();
    });


    // lpk
    const gagal_js = (alert) => {
        let html = '';
        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:2px solid #FF9FA1;border-radius:8px;padding:5px;background-color:#FFC9C9;color:#A90020">';
        html += '<div class="px-2"><i class="fa-solid fa-circle-xmark"></i> ' + alert + '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('.box_warning').html(html)
        $('.box_warning').fadeIn();
        $('.box_confirm').fadeOut();

        setTimeout(() => {
            $('.box_warning').fadeOut();
        }, 1000);

    }

    const gagal_with_button = (alert) => {
        let html = '';
        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:2px solid #FF9FA1;border-radius:8px;padding:5px;background-color:#FFC9C9;color:#A90020">';
        html += '<div class="d-flex">';
        html += '<div class="px-2"><i class="fa-solid fa-triangle-exclamation" style="color: #cc0000;"></i> ' + alert + '</div>';
        html += '<a class="btn_close_warning" style="text-decoration: none;color:#A90020" href=""><i class="fa-solid fa-circle-xmark"></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('.box_warning_with_button').html(html);

        $('.box_warning_with_button').show();

        $(document).on('click', '.btn_close_warning', function(e) {
            e.preventDefault();
            $('.box_warning_with_button').fadeOut();
        });

    }

    $(document).on('click', '.btn_close_warning', function(e) {
        e.preventDefault();
        $('.box_warning_with_button').fadeOut();
    });


    const object_to_array = (obj) => {

        let data = [];
        for (const [key, value] of Object.entries(obj)) {
            data.push({
                key,
                value
            });
        }

        return data;
    }

    const confirm = (obj) => {
        let args = object_to_array(obj);
        let args_values = '';
        let alert = '';
        args.forEach(elm => {
            args_values += 'data-' + elm.key + '="' + elm.value + '" ';
            if (elm.key == 'alert') {
                alert = elm.value;
            }
        });

        let html = '';
        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:2px solid #ff9933;border-radius:8px;padding:5px;background-color:#ffe6cc;color:#cc6600">';
        html += '<div class="d-flex gap-2">';
        html += '<div class="px-2" style="font-weight: 700;"><i class="fa-solid fa-triangle-exclamation" style="color: #ff9933;"></i> ' + alert + '</div>';
        html += '<a class="btn_close_confirm" style="text-decoration: none;color:#ff8000" href=""><i class="fa-solid fa-circle-xmark"></i></a>';
        html += '<a class="btn_execute_confirm" ' + args_values + ' style="text-decoration: none;color:green" href=""><i class="fa-solid fa-circle-check"></i></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('.box_confirm').html(html);

        $('.box_confirm').show();

        $(document).on('click', '.btn_close_confirm', function(e) {
            e.preventDefault();
            $('.box_confirm').fadeOut();
        });


    }

    $(document).on('click', '.btn_execute_confirm', function(e) {
        e.preventDefault();
        let data = $(this).data();
        $('.box_confirm').fadeOut();
        if (data.tabel == 'pembayaran') {
            delete_tabel_pembayaran(data);
            return false;
        }
        post(data.url, {
                data
            })
            .then(res => {
                if (res.status == '200') {
                    sukses_js(res.message);

                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    gagal_with_button(res.message);
                }

            })

    });

    $(document).on('click', '.btn_confirm', function(e) {
        e.preventDefault();
        confirm($(this).data());
    });




    const sukses_js = (alert) => {
        let html = '';
        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:2px solid #9fffc4;border-radius:8px;padding:5px;background-color:#c9ffde;color:#00a939">';
        html += '<div class="px-2"><i class="fa-solid fa-circle-check"></i> ' + alert + '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('.box_warning').html(html)
        $('.box_warning').fadeIn();
        $('.box_confirm').fadeOut();

        setTimeout(() => {
            $('.box_warning').fadeOut();
        }, 1000);

    }

    <?php if (session()->getFlashdata('sukses')) : ?>

        let msg = '<?= session()->getFlashdata('sukses'); ?>';
        sukses_js(msg);

    <?php endif; ?>

    <?php if (session()->getFlashdata('gagal')) : ?>
        let msg = '<?= session()->getFlashdata('gagal'); ?>';
        gagal_js(msg);

    <?php endif; ?>

    <?php if (session()->getFlashdata('gagal_with_button')) : ?>

        let msg = '<?= session()->getFlashdata('gagal_with_button'); ?>';
        gagal_with_button(msg);

    <?php endif; ?>

    const body_warning = (warning_text, url, id, order, table) => {
        let html = '';

        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:1px solid red;border-radius:8px;padding:10px 20px;background-color:#eee">';
        html += '<div>' + warning_text + '</div>';
        html += '<div><a class="del_execute text_success" data-id="' + id + '" data-url="' + url + '" data-order="' + order + '" data-table="' + table + '" href=""><i class="fa-regular fa-circle-check" style="font-size:large"></i></a></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        return html;
    }

    $(document).on('click', '.warning', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = $(this).data('url');
        let tabel = $(this).data('tabel');
        let order = $(this).data('order');

        $('.box_warning').html(body_warning('Are you sure to <b class="text_danger">' + order + '</b> this data!.', url, id, order, tabel));


    });
    $(document).on('click', '.del_execute', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = $(this).data('url');
        let table = $(this).data('table');

        $('.box_warning').html('');
        post(url, {
                id,
                table
            })
            .then(res => {
                if (res.status == '200') {
                    location.reload();
                } else {
                    gagal_js(res.message);
                }

            })

    });
</script>