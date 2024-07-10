<?php

namespace App\Models;

class DataModel
{

    public function allData($asc = null)
    {
        $exp = [];
        if ($asc == null) {
            $exp = ['id', 'ASC'];
        } else {
            $exp = explode("=", $asc);
        }

        $db = db(menu()['tabel'], get_db(menu()['tabel']));
        $q = $db->orderBy($exp[0], $exp[1])->get()->getResultArray();

        return $q;
    }
    public function allDataJoin($tabel_join, $select, $asc = null, $tabel = null)
    {
        $exp = [];
        if ($asc == null) {
            $exp = ['id', 'ASC'];
        } else {
            $exp = explode("=", $asc);
        }

        $db = db(($tabel == null ? menu()['tabel'] : $tabel), get_db($tabel == null ? menu()['tabel'] : $tabel));

        $q = $db->select($select)->join('siswa', $tabel_join . '_id=' . $tabel_join . '.id')->orderBy($exp[0], $exp[1])->get()->getResultArray();

        return $q;
    }
    public function singleData($where)
    {

        $exp = [];

        $exp = explode("=", $where);

        $db = db(menu()['tabel'], get_db(menu()['tabel']));
        $q = $db->where($exp[0], $exp[1])->get()->getRowArray();

        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }

        return $q;
    }
    public function add($data, $tabel = null)
    {
        $db = db(($tabel == null ? menu()['tabel'] : $tabel), get_db($tabel == null ? menu()['tabel'] : $tabel));

        if ($db->insert($data)) {
            sukses(base_url(menu()['controller']), 'Data sukses disimpan.');
        } else {
            gagal(base_url(menu()['controller']), 'Data gagal disimpan!.');
        }
    }

    public function addWithFile($data, $files)
    {
        $db = db(menu()['tabel'], get_db(menu()['tabel']));

        $gagal = [];
        foreach ($files as $i) {
            if ($i['file']['error'] == 4) {
                $data[$i['col']] = 'file_not_found.jpg';
            } else {
                $randomname = get_db(menu()['tabel']) . '_' . $i['col'] . '_' . str_replace(" ", "_", str_replace("'", "_", $data['nama'])) . '_' . time();
                if ($i['file']['error'] == 0) {
                    $size = $i['file']['size'];

                    if ($size > 2000000) {
                        $gagal[] = 'Ukuran file ' . $i['col'] . ' melebihi 2 MB.';
                        $data[$i['col']] = 'file_not_found.jpg';
                        continue;
                    }

                    $ext = ['jpg', 'jpeg', 'png'];

                    $exp = explode(".", $i['file']['name']);
                    $exe = strtolower(end($exp));

                    if (array_search($exe, $ext) === false) {
                        $gagal[] = 'Format file ' . $i['col'] . ' harus ' . implode(", ", $ext) . '.';
                        $data[$i['col']] = 'file_not_found.jpg';
                        continue;
                    }

                    $dir = 'berkas/' . get_db(menu()['controller']) . '/';

                    $upload = $dir . $randomname . '.' . $exe;

                    if (!move_uploaded_file($i['file']['tmp_name'], $upload)) {
                        $gagal[] = 'File ' . $i['col'] . ' gagal diupload.';
                        $data[$i['col']] = 'file_not_found.jpg';
                        continue;
                    } else {
                        $data[$i['col']] = $randomname . '.' . $exe;
                    }
                }
            }
        }

        if (count($gagal) > 0) {
            $db->insert($data);
            gagal(base_url(menu()['controller']), implode(" | ", $gagal));
        } else {
            if ($db->insert($data)) {
                sukses(base_url(menu()['controller']), 'Data sukses disimpan.');
            } else {
                gagal(base_url(menu()['controller']), 'Data gagal disimpan!.');
            }
        }
    }

    public function update($id, $data)
    {
        $db = db(menu()['tabel'], get_db(menu()['tabel']));

        $db->where('id', $id);
        if ($db->update($data)) {
            sukses(base_url(menu()['controller']), 'Data sukses disimpan.');
        } else {
            gagal(base_url(menu()['controller']), 'Data gagal disimpan!.');
        }
    }

    public function updateWithFile($data, $files)
    {
        $db = db(menu()['tabel'], get_db(menu()['tabel']));

        $gagal = [];
        foreach ($files as $i) {
            if ($i['file']['error'] !== 4) {

                $randomname = get_db(menu()['tabel']) . '_' . $i['col'] . '_' . str_replace(" ", "_", str_replace("'", "_", $data['nama'])) . '_' . time();

                if ($i['file']['error'] == 0) {
                    $size = $i['file']['size'];

                    if ($size > 2000000) {
                        $gagal[] = 'Ukuran file ' . $i['col'] . ' melebihi 2 MB.';
                        continue;
                    }

                    $ext = ['jpg', 'jpeg', 'png'];

                    $exp = explode(".", $i['file']['name']);
                    $exe = strtolower(end($exp));

                    if (array_search($exe, $ext) === false) {
                        $gagal[] = 'Format file ' . $i['col'] . ' harus ' . implode(", ", $ext) . '.';
                        continue;
                    }

                    $dir = 'berkas/' . get_db(menu()['controller']) . '/';

                    $upload = $dir . $randomname . '.' . $exe;

                    if (!move_uploaded_file($i['file']['tmp_name'], $upload)) {
                        $gagal[] = 'File ' . $i['col'] . ' gagal diupload.';
                        continue;
                    } else {
                        if ($data[$i['col']] !== 'file_not_found.jpg') {
                            if (!unlink($dir . $data[$i['col']])) {
                                $gagal[] = 'File lama gagal dihapus.';
                                continue;
                            }
                        }
                        $data[$i['col']] = $randomname . '.' . $exe;
                    }
                }
            }
        }

        if (count($gagal) > 0) {
            $db->where('id', $data['id']);
            $db->update($data);
            gagal(base_url(menu()['controller']), implode(" | ", $gagal));
        } else {
            $db->where('id', $data['id']);
            if ($db->update($data)) {
                sukses(base_url(menu()['controller']), 'Data sukses diupdate.');
            } else {
                gagal(base_url(menu()['controller']), 'Data gagal diupdate!.');
            }
        }
    }

    public function delete($id)
    {
        $db = db(menu()['tabel'], get_db(menu()['tabel']));

        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal_js('No. id tidak ada!.');
        }

        $db->where('id', $id);
        if ($db->delete()) {
            sukses_js('Data berhasil dihapus.');
        } else {
            gagal_js('Data gagal dihapus!.');
        }
    }

    public function deleteWithFile($id, $files)
    {
        $db = db(menu()['tabel'], get_db(menu()['tabel']));

        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal_js('No. id tidak ada!.');
        }

        $dir = 'berkas/' . get_db(menu()['controller']) . '/';
        foreach ($files as $i) {
            $file = $q[$i];
            if ($file !== 'file_not_found.jpg') {
                unlink($dir . $file);
            }
        }

        $db->where('id', $id);
        if ($db->delete()) {
            sukses_js('Data berhasil dihapus.');
        } else {
            gagal_js('Data gagal dihapus!.');
        }
    }

    public function no_id_lpk()
    {
        $th = substr(date('Y'), -2);

        $db = db(menu()['tabel'], get_db(menu()['tabel']));
        $no_id = $th . '001';
        $q = $db->where('id', $no_id)->get()->getRowArray();

        if ($q) {
            for ($i = 1; $i < 100; $i++) {
                if (strlen($i) == 1) {
                    $no = substr(date('Y'), -2) . '00' . $i;
                }
                if (strlen($i) == 2) {
                    $no = substr(date('Y'), -2) . '0' . $i;
                }
                if (strlen($i) == 3) {
                    $no = substr(date('Y'), -2) . $i;
                }

                $n = $db->where('id', $no)->get()->getRowArray();
                if (!$n) {
                    $no_id = $no;
                    break;
                }
            }
        }

        return $no_id;
    }

    public function no_nota_lpk($tgl, $siswa_id, $jenis_siswa)
    {
        $no_nota =  '0001/' . $siswa_id . '/' . $jenis_siswa . '/' . bulan(date('m', $tgl))['romawi'] . '/' . date('Y', $tgl);

        $db = db('nota_lpk', 'lpk');
        $q = $db->where('no_nota', $no_nota)->get()->getRowArray();

        if ($q) {
            for ($i = 1; $i < 100; $i++) {

                if (strlen($i) == 1) {
                    $no = '000' . $i;
                }
                if (strlen($i) == 2) {
                    $no = '00' . $i;
                }
                if (strlen($i) == 3) {
                    $no = '0' . $i;
                }
                if (strlen($i) == 4) {
                    $no = $i;
                }
                $nn = $no . '/' . $siswa_id . '/' . $jenis_siswa . '/' . bulan(date('m', $tgl))['romawi'] . '/' . date('Y', $tgl);

                $exist = $db->where('no_nota', $nn)->get()->getRowArray();
                if (!$exist) {
                    $no_nota = $nn;
                    break;
                }
            }
        }

        return $no_nota;
    }

    public function no_id_alumni($siswa_id)
    {
        $db = db('santri', 'santri');
        $santri = $db->where('no_id', $siswa_id)->get()->getRowArray();

        $alumni_id = '9' . substr($santri['tahun_keluar'], -2) . '000000001';

        $dba = db('identitas', 'alumni');
        $q = $dba->where('alumni_id', $alumni_id)->get()->getRowArray();

        if ($q) {
            for ($i = 1; $i < 100000000; $i++) {

                if (strlen($i) == 1) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '00000000' . $i;
                }
                if (strlen($i) == 2) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '0000000' . $i;
                }
                if (strlen($i) == 3) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '000000' . $i;
                }
                if (strlen($i) == 4) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '00000' . $i;
                }

                if (strlen($i) == 5) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '0000' . $i;
                }
                if (strlen($i) == 6) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '000' . $i;
                }
                if (strlen($i) == 7) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '00' . $i;
                }
                if (strlen($i) == 8) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . '0' . $i;
                }
                if (strlen($i) == 9) {
                    $no = '9' . substr($santri['tahun_keluar'], -2) . $i;
                }


                $exist = $dba->where('alumni_id', $no)->get()->getRowArray();
                if (!$exist) {
                    $alumni_id = $no;
                    break;
                }
            }
        }

        return $alumni_id;
    }
}
