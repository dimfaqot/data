<?php


namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Lpk extends BaseController
{

    public function index()
    {
        return view('lpk/landing', ['judul' => 'Lpk Jepang Walisongo']);
    }
}
