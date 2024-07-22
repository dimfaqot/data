<?php


namespace App\Controllers\Public;

use App\Controllers\BaseController;


class Auth extends BaseController
{

    public function index($jwt)
    {

        $decode = decode_jwt($jwt);

        if (session('id')) {
            sukses(base_url('home'), 'Login sukses.');
        }
        $data = [
            'id' => $decode['id'],
            'username' => '',
            'gender' => $decode['gender'],
            'no_id' => $decode['id'],
            'section' => $decode['section'],
            'role' => $decode['role'],
            'nama' => $decode['nama']
        ];
        if (array_key_exists('info', $decode)) {
            $data['info'] = $decode['info'];
        }
        session()->set($data);
        sukses(base_url('home'), 'Login sukses.');
    }
}
