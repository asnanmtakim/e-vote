<?php

namespace App\Controllers;

use App\Models\CalonModel;
use App\Models\VoteModel;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home',
        ];
        // dd($data);
        $this->data_view = array_merge($this->data_view, $data);
        return view('home/index', $this->data_view);
    }
}
