<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class Tanah_baru extends BaseController
{

    public function index()
    {
        sukses_js("Ok", ["tes" => "tes"]);
    }
    public function add_rfid_santri()
    {
        $jwt = $this->request->getVar('jwt');
        $decode = decode_jwt($jwt, 'finger');
        $rfid = $decode['uid'];

        $db = db('rfid', 'santri');
        $q = $db->get()->getRowArray();

        if (!$q) {
            if ($db->insert(['rfid' => $rfid])) {
                sukses_js("Insert rfid berhasil.");
            } else {
                sukses_js("Insert rfid gagal!.");
            }
        }

        $q['rfid'] = $rfid;
        $db->where('id', $q['id']);
        if ($db->update($q)) {
            sukses_js("Update rfid berhasil.");
        } else {
            gagal_js("Update rfid gagal!.");
        }
    }
}
