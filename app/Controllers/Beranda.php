<?php

namespace App\Controllers;

class Beranda extends BaseController
{
    public function getIndex(): string
    {
        if (auth()->loggedIn()) {
            $users = auth()->user();
            $data['pengguna'] = $users;
            d($data);
            return view('dashboard', $data);
        } else {
            return view('beranda');
        }
    }
}
